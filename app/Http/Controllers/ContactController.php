<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMessageMail;
use App\Services\ContactChallenge;
use App\Services\ContactSpamFilter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function show(ContactChallenge $challenge): View
    {
        return view('pages.contact', [
            'humanChallenge' => $challenge->issue(),
        ]);
    }

    public function refresh(ContactChallenge $challenge): JsonResponse
    {
        return response()->json([
            'ok' => true,
            'challenge' => $challenge->issue(),
        ]);
    }

    public function store(ContactRequest $request, ContactChallenge $challenge, ContactSpamFilter $spam): JsonResponse|RedirectResponse
    {
        $data = [
            'name' => $request->string('name')->toString(),
            'phone' => $request->string('phone')->toString(),
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'message' => $request->string('message')->toString(),
        ];

        Mail::to(config('services.school.mail_to'))->send(new ContactMessageMail($data));

        $challenge->forget();
        $spam->remember($data['message']);

        $message = 'Вашата порака е испратена. Ќе ве контактираме наскоро.';
        $next = $challenge->issue();

        return $request->expectsJson()
            ? response()->json(['ok' => true, 'message' => $message, 'challenge' => $next])
            : redirect()->route('contact')->with('status', $message);
    }
}
