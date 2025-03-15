<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ClinicController extends Controller



{


    public function index()
    {
        // Récupère toutes les cliniques approuvées
        $clinics = User::where('role', 'clinic')->where('approved', true)->get();

        // Retourne la vue avec les cliniques
        return view('clinics.index', compact('clinics'));
    }
    public function services()
    {
        $clinic = Auth::user()->clinic;
        return view('clinics.services', compact('clinic'));
    }

    public function updateServices(Request $request)
    {
        $request->validate([
            'services' => 'required|array',
        ]);

        $clinic = Auth::user()->clinic;
        $clinic->update(['services' => json_encode($request->services)]);

        return redirect()->route('clinics.services')->with('success', 'Services mis à jour !');
    }

    public function profile()
    {
        $clinic = Auth::user()->clinic;
        return view('clinics.profile', compact('clinic'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        $clinic = Auth::user()->clinic;
        $clinic->update([
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        return redirect()->route('clinics.profile')->with('success', 'Profil mis à jour !');
    }
}
