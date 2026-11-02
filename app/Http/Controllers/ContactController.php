<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMessageMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function show(): View
    {
        return view('pages.contact');
    }

    public function store(ContactRequest $request): JsonResponse|RedirectResponse
    {
        if ($request->filled('website')) {
            return $request->expectsJson()
                ? response()->json(['ok' => true, 'message' => 'Ви благодариме.'])
                : redirect()->route('contact')->with('status', 'Ви благодариме.');
        }

        $data = $request->safe()->only(['name', 'phone', 'email', 'subject', 'message']);

        Mail::to(config('services.school.mail_to'))->send(new ContactMessageMail($data));

        $message = 'Вашата порака е испратена. Ќе ве контактираме наскоро.';

        return $request->expectsJson()
            ? response()->json(['ok' => true, 'message' => $message])
            : redirect()->route('contact')->with('status', $message);
    }
}
