<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SleepTracker;
class HomeController extends Controller{
    public function index(){
        $data = SleepTracker::getData();
        $user = auth()->user();
        return view('home', compact('data', 'user'));
    }
    public function data(){
        $data = SleepTracker::getData();
        $user = auth()->user();
        return response()->json($data);
    }
    public function history(){
        $data = SleepTracker::getData();
        $user = auth()->user();
        return view('history', compact('data', 'user'));
    }
    public function statistic(){
        $data = SleepTracker::getData();
        $user = auth()->user();
        return view('statistic', compact('data', 'user'));
    }
}
?>