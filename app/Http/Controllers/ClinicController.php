<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class ClinicController extends Controller
{
    public function index()
    {
        $clinics = User::where('role', 'clinic')->where('approved', true)->get();
        return view('clinics.index', compact('clinics'));
    }

    public function services()
    {
        $clinic = Auth::user();
        return view('clinics.services', compact('clinic'));
    }

    public function updateServices(Request $request): RedirectResponse
    {
        $request->validate([
            'services' => 'required|array',
            'services.*' => 'in:Dépistage,Consultation,Suivi',
        ]);

        $clinic = Auth::user();
        if (!$clinic instanceof User) {
            throw new \Exception('L’utilisateur connecté n’est pas une instance de User');
        }
        $clinic->update([
            'services' => $request->services,
        ]);

        return redirect()->route('clinics.services')->with('success', 'Services mis à jour.');
    }

    public function profile()
    {
        $clinic = Auth::user();
        return view('clinics.profile', compact('clinic'));
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        $clinic = Auth::user();
        if (!$clinic instanceof User) {
            throw new \Exception('L’utilisateur connecté n’est pas une instance de User');
        }
        $clinic->update([
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        return redirect()->route('clinics.profile')->with('success', 'Profil mis à jour !');
    }
}




