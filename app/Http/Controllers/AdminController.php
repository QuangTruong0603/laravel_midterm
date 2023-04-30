<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Exception;
use App\Http\Controllers\Controller;
use App\Models\User;
class AdminController extends Controller{
    public function adminHome()
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }
        $admin = Auth::user();
        $data = User::getAllData($admin->id);
        return view('adminHome', compact('data', 'admin'));
    }
    public function addUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            "email"=> 'required|email',
            'password' => 'required|string',
            'userType' => 'required',
        ]);

        try {
            $user = User::addData($request->name, $request->email, $request->password,$request->userType);
            return redirect()->back()->with('success', 'User record added successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error adding User record: ' . $e->getMessage());
        }
    }


    public function editUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            "email"=> 'required|email',
            'userType' => 'required',
        ]);

        try {
            $user = User::updateData($request->id,$request->name, $request->email,$request->userType);
            return redirect()->back()->with('success', 'User record updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error updated user record: ' . $e->getMessage());
        }


    }

    public function removeUser(Request $request)
    {
        try {
            $sleepRecord = User::deleteData($request->id);
            return redirect()->back()->with('success', 'User record removed successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error removed user record: ' . $e->getMessage());
        }
    }
}
?>