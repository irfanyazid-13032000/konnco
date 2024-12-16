<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\OrderDetail;
use App\Models\Order;
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
            // Ambil user yang sedang login
            $customer = Auth::guard('customers')->user();
    
            // Simpan full_name ke dalam session
            $request->session()->put('full_name', $customer->full_name);
            $request->session()->put('customer_login_id', $customer->id);
    
            return redirect()->route('shop.index');
        }
    
        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }
    

    public function checkout()
    {
       
    }

    public function logout()
    {
        Auth::guard('customers')->logout();
        session()->flush();
        return redirect()->route('shop.index');
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
        'address' => 'required',
    ]);


    $customer = Customer::create([
        'full_name' => $validated['full_name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
        'address' => $validated['address'],
    ]);


    return redirect()->route('shop.index');
}

}
