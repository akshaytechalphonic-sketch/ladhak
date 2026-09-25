@extends('layouts.app')

@section('content')

<div class="page-header" style="background-image: url('{{ $sections->first() ? asset('storage/' . $sections->first()->image) : '' }}');">
    <div class="container text-center py-5">
        <h1 class="display-3 fw-bold animate__animated animate__fadeInDown text-white">{{ $sections->first()->title ?? 'Guest Experiences' }}</h1>
        <div class="lead opacity-75 animate__animated animate__fadeInUp text-white-50">{!! $sections->first()->description ?? 'Real stories from our esteemed guests worldwide.' !!}</div>
    </div>
</div>

<div class="container py-5 mt-5">
    <div class="row g-5">
        @forelse($testimonials as $testimony)
        <div class="col-lg-4 animate__animated animate__fadeInUp">
            <div class="card border-0 shadow-premium p-4 rounded-4 h-100 position-relative d-flex flex-column text-center">
                <i class="bi bi-quote fs-1 opacity-25" style="position: absolute; top: 10px; right: 20px; color: var(--secondary-blue);"></i>
                <div class="mb-4 d-flex justify-content-center">
                    <img src="{{ $testimony->image ? asset('storage/'.$testimony->image) : 'https://ui-avatars.com/api/?name='.urlencode($testimony->name).'&background=0B2240&color=C90000' }}" class="rounded-circle shadow-sm border border-2" width="100" height="100" style="object-fit: cover; border-color: var(--secondary-blue) !important;" alt="Guest">
                </div>
                <p class="text-muted italic mb-4">"{{ $testimony->content }}"</p>
                <div class="mt-auto">
                    <h5 class="fw-bold text-navy mb-0">{{ $testimony->name }}</h5>
                    <p class="small fw-bold mb-1" style="color: var(--secondary-blue);">{{ $testimony->role ?? 'Verified Guest' }}</p>
                    <div class="text-warning">
                        @for($i=1; $i<=5; $i++)
                            <i class="bi bi-star{{ $i <= $testimony->rating ? '-fill' : '' }}"></i>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted py-5">No guest experiences shared yet. Your feedback could be the first!</div>
        @endforelse
    </div>
    
    
</div>
@endsection
