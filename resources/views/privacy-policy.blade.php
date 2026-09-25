@extends('layouts.app')

@section('content')
<div class="page-header" style="background-image: url('{{  $sections['privacy_banner']->image ? asset('storage/'.$sections['privacy_banner']->image) : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=1920' }}'); min-height: 300px; background-size: cover; background-position: center; position: relative;">
    <div class="container py-5 text-center position-relative" style="z-index: 2;">
        <h1 class="display-4 fw-bold animate__animated animate__fadeInDown text-white family-serif">Privacy Policy</h1>
        <p class="lead opacity-75 animate__animated animate__fadeInUp text-white-50">How we handle and protect your personal information.</p>
    </div>
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-navy opacity-50"></div>
</div>

<div class="container py-5 my-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card border-0 shadow-premium p-4 p-md-5 rounded-4 bg-white">
               {!! $sections['content']->description ?? '' !!}
            </div>
        </div>
    </div>
</div>

<style>
.shadow-premium { box-shadow: 0 1rem 3rem rgba(0,0,0,0.05) !important; }
h2 { border-left: 4px solid #c5a059; padding-left: 15px; }
</style>
@endsection
