<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Clinic;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $clinics = User::where('role', 'clinic')->with(['clinic', 'subscription'])->get();
        $pendingClinics = $clinics->where('approved', false);
        return view('admin.users', compact('clinics', 'pendingClinics'));
    }

    public function approve($id)
    {
        $user = User::findOrFail($id);
        if ($user->role === 'clinic') {
            $user->update(['approved' => true]);
            if (! $user->clinic) {
                Clinic::create(['user_id' => $user->id, 'name' => $user->name]);
            }
        }
        return redirect()->route('admin.users.index')->with('success', 'Clinique approuvée.');
    }

    public function subscribe(Request $request, $id)
    {
        $request->validate([
            'plan' => 'required|in:monthly,yearly',
            'amount' => 'required|numeric|min:0',
        ]);

        $user = User::findOrFail($id);
        $endDate = $request->plan === 'monthly' ? now()->addMonth() : now()->addYear();

        $user->subscription()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'plan' => $request->plan,
                'amount' => $request->amount,
                'start_date' => now(),
                'end_date' => $endDate,
                'is_active' => true,
            ]
        );

        return redirect()->route('admin.users.index')->with('success', 'Abonnement ajouté.');
    }

    public function deactivateSubscription($id)
    {
        $user = User::findOrFail($id);
        if ($user->subscription) {
            $user->subscription->update(['is_active' => false]);
        }
        return redirect()->route('admin.users.index')->with('success', 'Abonnement désactivé.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Clinique supprimée.');
    }
}

?>