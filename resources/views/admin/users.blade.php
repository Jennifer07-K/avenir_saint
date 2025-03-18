@extends('layouts.app')

@section('title', 'Gestion des cliniques')

@section('content')
    <section class="container section clinic-management">
        <h2 class="clinic-management__title">Gestion des cliniques</h2>

        <div class="clinic-management__card">
            <div class="clinic-management__card-body">
                <h3 class="clinic-management__subtitle">Toutes les cliniques</h3>

                <table class="clinic-management__table">
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
                            <tr class="clinic-management__row">
                                <td>{{ $clinic->name }}</td>
                                <td>{{ $clinic->email }}</td>
                                <td>
                                    <span class="clinic-management__status {{ $clinic->approved ? 'clinic-management__status--approved' : 'clinic-management__status--pending' }}">
                                        {{ $clinic->approved ? 'Approuvée' : 'En attente' }}
                                    </span>
                                </td>
                                <td>
                                    @if ($clinic->subscription && $clinic->subscription->is_active)
                                        <span class="clinic-management__subscription">
                                            Plan {{ ucfirst($clinic->subscription->plan) }} jusqu’au {{ $clinic->subscription->end_date->format('d/m/Y') }}
                                        </span>
                                    @else
                                        <span class="clinic-management__subscription clinic-management__subscription--inactive">
                                            Non abonnée
                                        </span>
                                    @endif
                                </td>
                                <td class="clinic-management__actions">
                                    @if (!$clinic->approved)
                                        <form action="{{ route('admin.users.approve', $clinic->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success btn-sm clinic-management__btn">
                                                <i class="fas fa-check"></i> Approuver
                                            </button>
                                        </form>
                                    @endif
                                    @if (!$clinic->subscription || !$clinic->subscription->is_active)
                                        <button class="btn btn-primary btn-sm clinic-management__btn" data-bs-toggle="modal" data-bs-target="#subscribeModal{{ $clinic->id }}">
                                            <i class="fas fa-plus"></i> Abonner
                                        </button>
                                    @else
                                        <form action="{{ route('admin.users.deactivate', $clinic->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-warning btn-sm clinic-management__btn">
                                                <i class="fas fa-ban"></i> Désactiver
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.users.destroy', $clinic->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm clinic-management__btn" onclick="return confirm('Supprimer ?')">
                                            <i class="fas fa-trash"></i> Supprimer
                                        </button>
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
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="plan" class="form-label">Plan</label>
                                                    <select name="plan" id="plan" class="form-select" required>
                                                        <option value="monthly">Mensuel</option>
                                                        <option value="yearly">Annuel</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="amount" class="form-label">Montant (fcfa)</label>
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
                            <tr>
                                <td colspan="5" class="clinic-management__empty">Aucune clinique enregistrée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                {{-- @if ($clinics->hasPages())
                    <div class="clinic-management__pagination">
                        {{ $clinics->links() }}
                    </div>
                @endif --}}
            </div>
        </div>
    </section>
@endsection