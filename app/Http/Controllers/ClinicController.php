<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClinicController extends Controller
{
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
