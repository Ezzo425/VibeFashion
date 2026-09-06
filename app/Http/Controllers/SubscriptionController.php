<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeSubscriber;
use App\Models\Subscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscriptionController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(['email' => ['required', 'email', 'max:255']]);
        $subscriber = Subscriber::updateOrCreate(
            ['email' => $validated['email']],
            ['subscribed_at' => now()]
        );

        Mail::to($subscriber->email)->send(new WelcomeSubscriber($subscriber->email));

        return back()->with('success', 'You are subscribed. Check your inbox for a welcome email.');
    }
}
