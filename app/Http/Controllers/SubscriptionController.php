<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function index()
    {
        return view('subscription.index');
    }

    public function manage()
    {
        return view('subscription.manage');
    }

    public function upgrade(Request $request)
    {
        $plan = $request->input('plan');
        
        // Mock Payment Gateway Logic Here
        
        $user = Auth::user();
        $user->subscription_plan = $plan;
        $user->save();

        return redirect()->route('subscription.manage')->with('status', "Welcome to the {$plan} plan!");
    }

    public function cancel()
    {
        $user = Auth::user();
        $user->subscription_plan = 'free';
        $user->save();

        return redirect()->route('dashboard')->with('status', 'Subscription cancelled.');
    }
}
