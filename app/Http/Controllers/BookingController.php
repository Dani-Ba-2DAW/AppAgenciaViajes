<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Vacation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('store');
        $this->middleware('verified')->only('store');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'vacation_id' => 'required|exists:vacations,id',
        ]);

        $user = auth()->user();

        // Comprobación EXTRA de seguridad
        $alreadyBooked = Booking::where('user_id', $user->id)
            ->where('vacation_id', $request->vacation_id)
            ->exists();

        if ($alreadyBooked) {
            return back()->withErrors([
                'booking' => 'Ya has reservado esta vacación.'
            ]);
        }

        Booking::create([
            'user_id' => $user->id,
            'vacation_id' => $request->vacation_id,
        ]);

        return back()->with([
            'booking' => 'Reserva realizada correctamente.'
        ]);
    }

    public function destroy(Booking $booking): RedirectResponse
    {
        $user = auth()->user();

        // Seguridad: solo el dueño puede cancelar
        if ($booking->user_id !== $user->id) {
            abort(403);
        }

        $booking->delete();

        return back()->with([
            'booking' => 'Reserva cancelada correctamente.'
        ]);
    }
}
