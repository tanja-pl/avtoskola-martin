<?php

namespace App\Http\Requests;

use App\Services\ContactChallenge;
use App\Services\ContactSpamFilter;
use Closure;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
{
    public const SUBJECTS = [
        'Запишување / Регистрација',
        'Информации за категории',
        'Ценовник и плаќање',
        'Е-Тест',
        'Друго прашање',
    ];

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $website = $this->input('website');
        if (is_array($website) || (is_string($website) && trim($website) !== '')) {
            throw new HttpResponseException($this->dropped());
        }

        $subject = trim((string) $this->input('subject', ''));
        $email = trim((string) $this->input('email', ''));

        $this->merge([
            'name' => trim((string) $this->input('name', '')),
            'phone' => trim((string) $this->input('phone', '')),
            'email' => $email === '' ? null : $email,
            'subject' => $subject === '' ? null : $subject,
            'message' => trim((string) $this->input('message', '')),
            'human_answer' => strtoupper((string) preg_replace('/[^A-Za-z0-9]/', '', (string) $this->input('human_answer', ''))),
            'consent' => $this->boolean('consent') ? '1' : '0',
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:80', 'regex:/^[\p{L} .\'’\-]+$/u'],
            'phone' => ['required', 'string', 'max:40', function (string $attribute, mixed $value, Closure $fail): void {
                $digits = preg_match_all('/\d/', (string) $value);
                if ($digits < 6 || $digits > 20 || preg_match('/^\+?[0-9\s().\-\/]+$/', (string) $value) !== 1) {
                    $fail('Внесете валиден телефонски број.');
                }
            }],
            'email' => ['nullable', 'email', 'max:120'],
            'subject' => ['nullable', 'string', 'max:80', Rule::in(self::SUBJECTS)],
            'message' => ['required', 'string', 'min:5', 'max:2000', function (string $attribute, mixed $value, Closure $fail): void {
                $reason = app(ContactSpamFilter::class)->rejection(
                    (string) $this->input('name', ''),
                    (string) $this->input('subject', ''),
                    (string) $value,
                );

                if ($reason !== null) {
                    $fail($reason);
                }
            }],
            'website' => ['nullable', 'string', 'max:200'],
            'human_token' => ['required', 'string', 'size:40', 'alpha_num'],
            'human_answer' => ['bail', 'required', 'string', 'min:4', 'max:8', function (string $attribute, mixed $value, Closure $fail): void {
                $result = app(ContactChallenge::class)->verify(
                    (string) $this->input('human_token', ''),
                    (string) $value,
                );

                if ($result === ContactChallenge::OK) {
                    return;
                }

                if ($result === ContactChallenge::TOO_FAST) {
                    $fail('Потврдата не успеа. Почекајте момент и обидете се повторно.');

                    return;
                }

                if ($result === ContactChallenge::WRONG) {
                    $fail('Потврдете дека сте човек. Кодот не е точен.');

                    return;
                }

                app(ContactChallenge::class)->rotate();
                $fail('Проверката истече. Внесете го новиот код.');
            }],
            'consent' => ['accepted'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Внесете име и презиме.',
            'name.min' => 'Името е прекратко.',
            'name.max' => 'Името е предолго.',
            'name.regex' => 'Името може да содржи само букви.',
            'phone.required' => 'Внесете телефонски број.',
            'phone.max' => 'Телефонскиот број е предолг.',
            'email.email' => 'Внесете валидна е-пошта.',
            'email.max' => 'Е-поштата е предолга.',
            'subject.in' => 'Изберете предмет од листата.',
            'subject.max' => 'Предметот е предолг.',
            'message.required' => 'Внесете порака.',
            'message.min' => 'Пораката е прекратка.',
            'message.max' => 'Пораката е предолга.',
            'consent.accepted' => 'Потребна е согласност за обработка на личните податоци.',
            'human_token.required' => 'Потврдете дека сте човек.',
            'human_token.size' => 'Потврдете дека сте човек.',
            'human_token.alpha_num' => 'Потврдете дека сте човек.',
            'human_answer.required' => 'Потврдете дека сте човек.',
            'human_answer.min' => 'Потврдете дека сте човек.',
            'human_answer.max' => 'Потврдете дека сте човек.',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $message = $validator->errors()->first();

        if ($this->expectsJson()) {
            throw new HttpResponseException(response()->json([
                'ok' => false,
                'message' => $message,
                'errors' => $validator->errors(),
                'challenge' => app(ContactChallenge::class)->pullRefresh(),
            ], 422));
        }

        parent::failedValidation($validator);
    }

    private function dropped(): JsonResponse|RedirectResponse
    {
        $message = 'Вашата порака е испратена. Ќе ве контактираме наскоро.';

        if ($this->expectsJson()) {
            return response()->json(['ok' => true, 'message' => $message]);
        }

        return redirect()->route('contact')->with('status', $message);
    }
}
