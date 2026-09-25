@extends('layouts.app')

@section('content')
<div class="page-header" style="background-image: url('{{  $sections['faq_banner']->image ? asset('storage/'.$sections['faq_banner']->image) : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=1920' }}'); min-height: 350px; background-size: cover; background-position: center; position: relative; display: flex; align-items: center;">
    <div class="container text-center position-relative" style="z-index: 2; padding-top: 80px;">
        <span class="badge mb-3 px-3 py-2 rounded-pill text-uppercase ls-1 text-white" style="background:#C90000;">FAQ</span>
        <h1 class="display-3 fw-bold text-white mb-2">{{  $sections['faq_banner']->title ?? '' }}</h1>
        <div class="lead text-white opacity-90 max-w-700 mx-auto">{!! $sections['faq_banner']->description ?? '' !!}</div>
    </div>
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(11,34,64,0.8) 0%, rgba(11,34,64,0.95) 100%);"></div>
</div>

<div class="container py-5 my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="accordion shadow-premium rounded-4 overflow-hidden border-0" id="faqAccordion">
                @forelse($faqs as $faq)
                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header" id="heading{{ $faq->id }}">
                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }} py-4 px-4 fw-bold" style="color: #0B2240;" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapse{{ $faq->id }}">
                            {{ $faq->question }}
                        </button>
                    </h2>
                    <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#faqAccordion">
                        <div class="accordion-body p-4 text-muted border-top bg-light">
                            {!! $faq->answer !!}
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-5">
                    <i class="bi bi-question-circle display-1 text-muted opacity-25 mb-4 d-block"></i>
                    <h3 class="fw-bold" style="color: #0B2240;">No FAQs available yet.</h3>
                    <p class="text-muted">Please check back later or contact us directly.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<style>
.accordion-button:not(.collapsed) {
    background-color: rgba(201, 0, 0, 0.08) !important;
    color: #0B2240 !important;
    box-shadow: none;
}
.accordion-button:focus {
    box-shadow: none;
    border-color: rgba(0,0,0,.125);
}
.accordion-button::after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%230B2240'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e") !important;
}
.shadow-premium { box-shadow: 0 1rem 3rem rgba(11,34,64,0.08) !important; }
</style>
@endsection
