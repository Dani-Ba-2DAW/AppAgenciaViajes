<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        $user = auth()->user();
        $bookings = $user->bookings;
        return view('home', compact('bookings'));
    }

    function edit(): View
    {
        return view('auth.edit');
    }

    function update(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $rules = [
            'current-password' => 'nullable|current_password',
            'email'            => 'required|max:255|email|unique:users,email,' . $user->id,
            'name'             => 'required|max:255',
            'password'         => 'nullable|min:8|confirmed',
        ];
        $messages = [
            'name.required'                     => 'Nombre obligatorio',
            'name.max'                          => 'Nombre maximo',
            'email.max'                         => 'Correo maximo',
            'email.unique'                      => 'Correo unico',
            'email.required'                    => 'Correo obligatorio',
            'email.email'                       => 'Correo email',
            'password.min'                      => 'Clave minimo',
            'password.confirmed'                => 'Clave confirmada',
            'current-password.current_password' => 'Clave actual'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        $user->name = $request->name;
        if ($user->email != $request->email) {
            $user->email_verified_at = null;
            $user->email = $request->email;
        }
        if ($request->filled('password') && $request->filled('current-password')) {
            $user->password = Hash::make($request->password);
        }
        try {
            $user->save();
            $message = 'Usuario guardado correctamente.';
        } catch (\Exception $e) {
            $message = 'Error al guardar.';
        }
        $messageArray = [
            'general' => $message
        ];
        return redirect()->route('home')->with($messageArray);
    }
}
