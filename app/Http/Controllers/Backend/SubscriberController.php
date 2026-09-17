<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index()
    {
        $subscribers = \App\Models\Subscriber::latest()->paginate(15);
        return view('backend.subscribers.index', compact('subscribers'));
    }

    public function destroy(\App\Models\Subscriber $subscriber)
    {
        $subscriber->delete();
        return redirect()->back()->with('success', 'Subscriber deleted successfully.');
    }
}
