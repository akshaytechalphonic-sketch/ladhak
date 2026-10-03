@extends('layouts.app')

@section('content')
<div class="page-header" style="background-image: url('{{ isset($sections['cancellation_banner']) && $sections['cancellation_banner']->image ? asset('storage/'.$sections['cancellation_banner']->image) : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=1920' }}'); min-height: 300px; background-size: cover; background-position: center; position: relative;">
    <div class="container py-5 text-center position-relative" style="z-index: 2;">
        <h1 class="display-4 fw-bold animate__animated animate__fadeInDown text-white family-serif">Cancellation &amp; Refund Policy</h1>
        <p class="lead opacity-75 animate__animated animate__fadeInUp text-white-50">Clear guidelines on payments, cancellations, and refunds for Leh Ladakh Trips.</p>
    </div>
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-navy opacity-50"></div>
</div>

<div class="container py-5 my-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-premium p-4 p-md-5 rounded-4 bg-white">

                <!-- 1. Paying the Trip Fee -->
                <section class="mb-5">
                    <h3 class="fw-bold mb-3 section-heading">
                        <i class="bi bi-wallet2 me-2 text-primary"></i>1. Paying the Trip Fee
                    </h3>
                    <p class="text-muted leading-relaxed">
                        The fee can be paid by online transfer/Cash deposit. Instruction for payment will be forwarded along with your confirmation email. When your transfer is done, please e-mail us a confirmation mail with your transfer details, so that we can follow up your reservation efficiently.
                    </p>
                </section>

                <hr class="my-4 opacity-25">

                <!-- 2. Cancellation Terms -->
                <section class="mb-5">
                    <h3 class="fw-bold mb-3 section-heading">
                        <i class="bi bi-envelope-exclamation me-2 text-primary"></i>2. Cancellation Terms
                    </h3>
                    <p class="text-muted leading-relaxed">
                        For the cancellation of services due to any avoidable/unavoidable reasons, Leh Ladakh Trips must be notified of the same in writing at <a href="mailto:info@lehladakhtrips.com" class="text-primary fw-semibold">info@lehladakhtrips.com</a>. At the time we receive your written cancellation, refunds based on the total fare are as follows.
                    </p>
                </section>

                <hr class="my-4 opacity-25">

                <!-- 3. Confirmation Policy -->
                <section class="mb-5">
                    <h3 class="fw-bold mb-3 section-heading">
                        <i class="bi bi-check-circle me-2 text-primary"></i>3. Confirmation Policy
                    </h3>
                    <ul class="list-unstyled text-muted leading-relaxed mb-0">
                        <li class="mb-2 d-flex align-items-start">
                            <i class="bi bi-dot fs-4 text-primary lh-1 me-2"></i>
                            <span>Payments can be done in 3 parts.</span>
                        </li>
                        <li class="mb-2 d-flex align-items-start">
                            <i class="bi bi-dot fs-4 text-primary lh-1 me-2"></i>
                            <span>After processing the booking amount you will get an email confirmation.</span>
                        </li>
                        <li class="d-flex align-items-start">
                            <i class="bi bi-dot fs-4 text-primary lh-1 me-2"></i>
                            <span>Once you paid the 100% amount for your booking, you will get an invoice containing all the information about the trip.</span>
                        </li>
                    </ul>
                </section>

                <hr class="my-4 opacity-25">

                <!-- 4. Payment Terms Policy -->
                <section class="mb-5">
                    <h3 class="fw-bold mb-3 section-heading">
                        <i class="bi bi-calendar-check me-2 text-primary"></i>4. Payment Terms Policy
                    </h3>
                    <div class="bg-light p-3 p-md-4 rounded-3 border-start border-4 border-primary">
                        <ul class="list-unstyled text-dark mb-0">
                            <li class="mb-2">
                                <strong>Booking amount:</strong> ₹3,000/- <span class="badge bg-secondary ms-1">Non Refundable and Non Adjustable</span>
                            </li>
                            <li class="mb-2">
                                <strong>40 days before the trip departure:</strong> 60% of the total cost.
                            </li>
                            <li>
                                <strong>15 days before the trip departure:</strong> 100% of the total cost.
                            </li>
                        </ul>
                    </div>
                </section>

                <hr class="my-4 opacity-25">

                <!-- 5. Cancellation Policy -->
                <section class="mb-5">
                    <h3 class="fw-bold mb-3 section-heading">
                        <i class="bi bi-x-circle me-2 text-danger"></i>5. Cancellation Policy
                    </h3>
                    <div class="bg-light p-3 p-md-4 rounded-3 border-start border-4 border-danger mb-3">
                        <ul class="list-unstyled text-dark mb-0">
                            <li class="mb-2">
                                <strong>Cancellations made 35 to 15 days before the date of travel:</strong> 50% of the total trip will be charged.
                            </li>
                            <li>
                                <strong>Cancellations made between 0 to 10 days before the date of travel:</strong> 100% of the total trip will be charged.
                            </li>
                        </ul>
                    </div>

                    <!-- Clarification Note for Missing Intervals -->
                    <div class="alert alert-warning border-0 d-flex align-items-start rounded-3 mt-3 p-3">
                        <i class="bi bi-exclamation-triangle-fill fs-5 me-2 flex-shrink-0"></i>
                        <div>
                            <strong>Note regarding unspecified periods:</strong> The standard policy provided above does not explicitly mention cancellation charges for:
                            <ul class="mb-0 mt-1 ps-3">
                                <li><strong>31 to 34 days</strong> before travel</li>
                                <li><strong>11 to 14 days</strong> before travel</li>
                            </ul>
                            Please contact our support team at <a href="mailto:info@lehladakhtrips.com" class="text-dark fw-bold">info@lehladakhtrips.com</a> for explicit clarification regarding cancellations in these specific timelines.
                        </div>
                    </div>
                </section>

                <hr class="my-4 opacity-25">

                <!-- 6. Refund Policy -->
                <section>
                    <h3 class="fw-bold mb-3 section-heading">
                        <i class="bi bi-cash-stack me-2 text-success"></i>6. Refund Policy
                    </h3>
                    <ul class="list-unstyled text-muted leading-relaxed mb-0">
                        <li class="mb-2 d-flex align-items-start">
                            <i class="bi bi-arrow-right-short fs-5 text-success me-2"></i>
                            <span>Refund amount will be processed within 2 weeks of business days.</span>
                        </li>
                        <li class="d-flex align-items-start">
                            <i class="bi bi-arrow-right-short fs-5 text-success me-2"></i>
                            <span>All applicable refunds will be done to the traveller’s bank account through bank transfer only.</span>
                        </li>
                    </ul>
                </section>

            </div>
        </div>
    </div>
</div>

<style>
.shadow-premium { box-shadow: 0 1rem 3rem rgba(0,0,0,0.05) !important; }
.section-heading { border-left: 4px solid #c5a059; padding-left: 15px; }
.leading-relaxed { line-height: 1.8; }
.bg-navy { background-color: #061624; }
</style>
@endsection
