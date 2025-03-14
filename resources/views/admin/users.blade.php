@extends('layouts.app')
@section('title', 'Gestion des cliniques')
@section('content')
    <section class="container section">
        <h2>Gestion des cliniques</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="card">
            <div class="card-body">
                <h3>Cliniques en attente</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pendingClinics as $clinic)
                            <tr>
                                <td>{{ $clinic->name }}</td>
                                <td>{{ $clinic->email }}</td>
                                <td>
                                    <form action="{{ route('admin.users.approve', $clinic->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm">Approuver</button>
                                    </form>
                                    <form action="{{ route('admin.users.destroy', $clinic->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3">Aucune clinique en attente.</td></tr>
                        @endforelse
                    </tbody>
                </table>

                <h3>Toutes les cliniques</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Statut</th>
                            <th>Abonnement</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($clinics as $clinic)
                            <tr>
                                <td>{{ $clinic->name }}</td>
                                <td>{{ $clinic->email }}</td>
                                <td>{{ $clinic->approved ? 'Approuvée' : 'En attente' }}</td>
                                <td>
                                    @if ($clinic->subscription && $clinic->subscription->is_active)
                                        {{ ucfirst($clinic->subscription->plan) }} jusqu’au {{ $clinic->subscription->end_date->format('d/m/Y') }}
                                    @else
                                        Non abonnée
                                    @endif
                                </td>
                                <td>
                                    @if (!$clinic->approved)
                                        <form action="{{ route('admin.users.approve', $clinic->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success btn-sm">Approuver</button>
                                        </form>
                                    @endif
                                    @if (!$clinic->subscription || !$clinic->subscription->is_active)
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#subscribeModal{{ $clinic->id }}">Abonner</button>
                                    @else
                                        <form action="{{ route('admin.users.deactivate', $clinic->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-warning btn-sm">Désactiver</button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.users.destroy', $clinic->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                            <!-- Modal pour abonnement -->
                            <div class="modal fade" id="subscribeModal{{ $clinic->id }}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Abonner {{ $clinic->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin.users.subscribe', $clinic->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="plan" class="form-label">Plan</label>
                                                    <select name="plan" id="plan" class="form-select" required>
                                                        <option value="monthly">Mensuel</option>
                                                        <option value="yearly">Annuel</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="amount" class="form-label">Montant (€)</label>
                                                    <input type="number" name="amount" id="amount" class="form-control" step="0.01" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-primary">Abonner</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr><td colspan="5">Aucune clinique enregistrée.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection