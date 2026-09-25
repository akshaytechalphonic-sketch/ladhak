@extends('layouts.app')

@section('content')

<section class="py-5" style="background:#f5f7fb;min-height:80vh;display:flex;align-items:center;">

<div class="container">

<div class="row justify-content-center">

<div class="col-lg-8">

<div class="card shadow-lg border-0 rounded-4">

<div class="card-body text-center p-5">

{{-- <div style="width:100px;height:100px;background:#28a745;border-radius:50%;margin:auto;display:flex;align-items:center;justify-content:center;">

<i class="fa fa-check text-white" style="font-size:50px;"></i>

</div> --}}

<h1 class="mt-4 fw-bold">

Thank You!

</h1>

<h4 class="text-success">

Payment Successful

</h4>

<p class="text-muted mt-3">

Your booking has been confirmed successfully.

Our travel team will contact you shortly to verify your booking and share the complete itinerary and travel details.

</p>

<hr>

<div class="row text-start">

<div class="col-md-6">

<p>

<strong>✔ Secure Payment</strong>

</p>

<p>

<strong>✔ Instant Confirmation</strong>

</p>

</div>

<div class="col-md-6">

<p>

<strong>✔ 24×7 Travel Assistance</strong>

</p>

<p>

<strong>✔ Trusted Ladakh Experts</strong>

</p>

</div>

</div>

<div class="mt-4">

<a href="{{ url('/') }}" class="btn btn-primary px-4">

Back to Home

</a>

<a href="{{ url('/packages') }}" class="btn btn-warning px-4 ms-2">

Explore More Tours

</a>

</div>

</div>

</div>

</div>

</div>

</div>

</section>

@endsection