@extends('layouts.app')

@section('title', $page->title . ' | HotelRes')

@section('content')
<div class="bg-primary text-white py-5 mb-5 shadow-sm">
    <div class="container text-center py-4">
        <h1 class="display-4 fw-bold mb-0">{{ $page->title }}</h1>
    </div>
</div>

<div class="container py-2 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0 rounded-4 p-4 p-md-5">
                <div class="page-content fs-5 text-muted lh-lg">
                    {!! nl2br($page->content) !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
