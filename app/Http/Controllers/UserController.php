<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function welcomeETA()
    {
        return view('welcome');
    }

    public function loginETA()
    {
        return view('login');
    }

    // public function loginProcessETA(Request $request)
    // {

    //     $login_data = $request->validate([
    //         'Useremail' => 'required|email',
    //         'Password' => 'required',
    //     ]);

    //     if (Auth::attempt($login_data)) {

    //         $request->session()->regenerate();
    //         return redirect()->route('dashboardETA');

    //     } else {
    //         return back()->with('error', 'Invalid login details');
    //     }
    // }

    public function loginProcessETA(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);
        // dd($request->all());

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user(); // get logged-in user

            return redirect()->route('dashboardETA')->with([
                'user' => $user
            ]);
        } else {
            return back()->with('error', 'Not Match Username & Password details');
        }


        return back()->with('error', 'Invalid login details');
    }


    // ---------------- Registration Page -------------
    public function registerETA()
    {
        return view('registration');
    }


    // ---------------- Registration Process -------------

    public function registerProcessETA(Request $request)
    {
        $valodation = $request->validate([
            'Username' => 'required|unique:users,username',
            'Email' => 'required|email|unique:users,email',
            'Mobile' => 'required|max:10|min:10|unique:users,mobile',
            'Password' => 'required|max:6|min:6',
        ]);

        $registration = User::create([
            'Username' => $request->Username,
            'Email' => $request->Email,
            'Mobile' => $request->Mobile,
            'Password' => Hash::make($request->Password),
        ]);

        // dd($request->all());

        return redirect()->route('loginETA')->with('success', 'Regitration Successfully :)');
    }

    public function dashboardETA()
    {
        $userId = Auth::id(); // get logged-in user's ID
        // dd($userId);
        $expenseData = Expense::where('expenseuser_id', $userId)
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($item) {
                $item->formatted_created_at = Carbon::parse($item->created_at)->format('d-m-Y h:i A');
                return $item;
            });

        return view('dashboard', compact('expenseData'));
    }
    public function monthETA()
    {
        $userId = Auth::id(); // get the logged-in user's ID
        $expenseData = Expense::where('expenseuser_id', $userId)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('month', compact('expenseData'));
    }


    public function myaccountETA()
    {
        $userId = Auth::id();

        // Get logged in user details
        $user = User::select('id', 'Username', 'email', 'Mobile', 'budget', 'created_at', 'image')
            ->findOrFail($userId);

        // Get user expenses for this month
        $expenseData = Expense::where('expenseuser_id', $userId)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->get();

        // Financial Overview
        $monthlyBudget   = $user->budget ?? 0;
        $monthlySpending = $expenseData->sum('amount');
        $remaining       = $monthlyBudget - $monthlySpending;
        $expenseCount    = $expenseData->count();

        return view('myprofile', compact(
            'user',
            'expenseData',
            'monthlyBudget',
            'monthlySpending',
            'remaining',
            'expenseCount'
        ));
    }

    public function updateaccountETA()
    {
        $userId = Auth::id();
        $updateData = User::where('id', $userId)->first();

        return view('updateprofile', compact('updateData'));
    }

    public function saveaccountETA(Request $request)
    {
        $userId = Auth::id();
        $user = User::find($userId);

        $request->validate([
            'Username' => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $userId,
            'phone'    => 'nullable|string|max:15',
            'budget'   => 'nullable|numeric',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // ✅ fixed name
        ]);

        // update fields
        $user->Username = $request->Username;
        $user->email    = $request->email;
        $user->Mobile   = $request->phone;
        $user->budget   = $request->budget;

        // upload image if selected
        if ($request->hasFile('image')) { // ✅ fixed
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/profile'), $filename);

            // delete old image if exists
            if ($user->image && file_exists(public_path('uploads/profile/' . $user->image))) {
                unlink(public_path('uploads/profile/' . $user->image));
            }

            $user->image = $filename; // ✅ fixed
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }


    public function logout(Request $request)
    {
        Auth::logout();                       // Log out the user
        $request->session()->invalidate();     // Invalidate session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect()->route('loginETA');             // Redirect to login page
    }
}
