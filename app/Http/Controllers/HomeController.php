<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function addSleep(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'sleepTime' => 'required|date_format:H:i',
            'wakeTime' => 'required|date_format:H:i',
        ]);

        $sleepRecord = new SleepRecord([
            'user' => auth()->user()->id,
            'date' => $request->date,
            'sleepTime' => $request->sleepTime,
            'wakeTime' => $request->wakeTime,
        ]);

        $sleepRecord->save();

        return redirect()->back()->with('success', 'Sleep record added successfully!');
    }

    public function editSleep(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'sleepTime' => 'required|date_format:H:i',
            'wakeTime' => 'required|date_format:H:i',
        ]);

        $sleepRecord = SleepRecord::findOrFail($id);

        $sleepRecord->date = $request->date;
        $sleepRecord->sleepTime = $request->sleepTime;
        $sleepRecord->wakeTime = $request->wakeTime;

        $sleepRecord->save();

        return redirect()->back()->with('success', 'Sleep record updated successfully!');
    }

    public function removeSleep($id)
    {
        $sleepRecord = SleepRecord::findOrFail($id);

        $sleepRecord->delete();

        return redirect()->back()->with('success', 'Sleep record removed successfully!');
    }
}
?>