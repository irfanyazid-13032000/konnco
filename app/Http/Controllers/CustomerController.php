<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('customers')->attempt($credentials)) {
            return redirect()->route('checkout');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function checkout()
    {
        return view('checkout');
    }

    public function logout()
    {
        Auth::guard('customers')->logout();
        return redirect()->route('login.index');
    }

    public function showRegisterForm()
{
    return view('auth.register');
}

public function register(Request $request)
{
    $validated = $request->validate([
        'full_name'  => 'required',
        'email' => 'required|email|unique:customers,email',
        'password' => 'required',
    ]);


    $customer = Customer::create([
        'full_name' => $validated['full_name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
    ]);


    return redirect()->route('shop.index');
}

}
