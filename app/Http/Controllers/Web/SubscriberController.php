<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email'
        ]);

        \App\Models\Subscriber::create([
            'email' => $request->email
        ]);

        return redirect()->back()->with('success', 'You have successfully subscribed to our newsletter!');
    }
}
