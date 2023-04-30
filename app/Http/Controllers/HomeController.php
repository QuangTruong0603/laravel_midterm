<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\SleepTracker;

class HomeController extends Controller
{
    public function checkUserType()
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }
        if (Auth::user()->userType === 'ADM') {
            return redirect()->route('adminHome');
        }
        if (Auth::user()->userType === 'USR') {
            return redirect()->route('home');
        }
    }
    public function index()
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }
        $user = Auth::user();
        $data = SleepTracker::getData($user->id);
        return view('home', compact('data', 'user'));
    }
    public function data()
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }
        $user = Auth::user();
        $data = SleepTracker::getData($user->id);
        return response()->json($data);
    }
    public function history()
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }
        $user = Auth::user();
        $data = SleepTracker::getData($user->id);
        return view('history', compact('data', 'user'));
    }
    public function statistic()
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }
        $user = Auth::user();
        $data = SleepTracker::getData($user->id);
        return view('statistic', compact('data', 'user'));
    }
    public function addSleep(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'sleep_time' => 'required|date_format:H:i',
            'wake_time' => 'required|date_format:H:i',
        ]);

        $user_id = Auth::user()->id;

        try {
            $sleepRecord = SleepTracker::addData($user_id, $request->date, $request->sleep_time, $request->wake_time);
            return redirect()->back()->with('success', 'Sleep record added successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error adding sleep record: ' . $e->getMessage());
        }
    }


    public function editSleep(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'sleep_time' => 'required|date_format:H:i',
            'wake_time' => 'required|date_format:H:i',
        ]);

        try {
            $sleepRecord = SleepTracker::updateData($request->id, $request->date, $request->sleep_time, $request->wake_time);
            return redirect()->back()->with('success', 'Sleep record updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error updated sleep record: ' . $e->getMessage());
        }


    }

    public function removeSleep(Request $request)
    {
        try {
            $sleepRecord = SleepTracker::deleteData($request->id);
            return redirect()->back()->with('success', 'Sleep record removed successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error removed sleep record: ' . $e->getMessage());
        }
    }

}