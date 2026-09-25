@extends('layouts.app')

@section('content')
<!-- Custom Styles for Payment Page -->
<style>
    .payment-banner {
        background-color: #fdecd2;
        padding: 30px 0;
        border-bottom: 1px solid #ebd8bd;
    }

    .payment-banner h1 {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        color: #3b3429;
        margin: 0;
        font-size: 32px;
        letter-spacing: 0.5px;
    }

    .payment-section {
        background-color: #eaeae9;
        padding: 50px 0 80px 0;
        min-height: calc(100vh - 200px);
    }

    .payment-card {
        background: #ffffff;
        border-radius: 6px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        border: 1px solid #e0e0e0;
        padding: 40px;
        max-width: 1000px;
        margin: 0 auto;
    }

    .payment-card-header {
        font-family: 'Poppins', sans-serif;
        font-size: 16px;
        font-weight: 700;
        color: #333333;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        padding-bottom: 15px;
        margin-bottom: 30px;
        border-bottom: 1px solid #e9e9e9;
    }

    .payment-form label {
        font-family: 'Inter', sans-serif;
        font-size: 14px;
        font-weight: 600;
        color: #333333;
        margin-bottom: 8px;
        display: block;
    }

    .payment-form label .style-strong {
        color: #c90000;
        margin-left: 2px;
        font-weight: bold;
    }

    .payment-form .form-control,
    .payment-form .form-select {
        font-family: 'Inter', sans-serif;
        height: 50px;
        border: 1px solid #cccccc;
        border-radius: 4px;
        padding: 10px 15px;
        font-size: 14px;
        color: #333333;
        background-color: #ffffff;
        box-shadow: none;
        transition: border-color 0.25s ease, box-shadow 0.25s ease;
    }

    .payment-form .form-control::placeholder {
        color: #999999;
    }

    .payment-form .form-control:focus,
    .payment-form .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
        outline: none;
    }

    .payment-form textarea.form-control {
        height: 100px;
        resize: none;
    }

    /* Pay Now Fieldset */
    .pay-now-fieldset {
        border: 1px solid #cccccc;
        border-radius: 4px;
        padding: 12px 20px;
        height: 100px;
        display: flex;
        align-items: center;
        margin-top: 5px;
    }

    .pay-now-legend {
        float: none;
        width: auto;
        padding: 0 10px;
        margin: 0;
        font-family: 'Inter', sans-serif;
        font-size: 14px;
        font-weight: 600;
        color: #333333;
    }

    .pay-now-logos {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        gap: 15px;
    }

    .pay-now-logos img.cards-img {
        height: 40px;
        object-fit: contain;
    }

    .pay-now-logos img.secure-img {
        height: 40px;
        object-fit: contain;
    }

    /* Continue to Payment Button */
    .btn-continue-payment {
        background: linear-gradient(90deg, #0091e6 0%, #1045b0 100%);
        color: #ffffff;
        border: none;
        border-radius: 4px;
        font-family: 'Poppins', sans-serif;
        font-size: 15px;
        font-weight: 600;
        padding: 14px 40px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: transform 0.2s ease, box-shadow 0.2s ease, opacity 0.2s ease;
        box-shadow: 0 4px 10px rgba(16, 69, 176, 0.2);
    }

    .btn-continue-payment:hover {
        opacity: 0.95;
        transform: translateY(-1px);
        box-shadow: 0 6px 15px rgba(16, 69, 176, 0.3);
        color: #ffffff;
    }

    .btn-continue-payment:active {
        transform: translateY(1px);
    }

    @media (max-width: 768px) {
        .payment-card {
            padding: 20px;
        }
        .pay-now-fieldset {
            height: auto;
            padding: 15px;
        }
        .pay-now-logos {
            flex-direction: column;
            gap: 15px;
            align-items: center;
        }
        .btn-continue-payment {
            width: 100%;
        }
    }
</style>

<!-- Banner section -->
<div class="payment-banner">
    <div class="container">
        <h1>Payment</h1>
    </div>
</div>

<!-- Main form section -->
<div class="payment-section">
    <div class="container">
        <div class="payment-card">
            <div class="payment-card-header">
                Payment Information
            </div>

            <form id="paymentForm" method="POST" class="payment-form">
                <!-- Hidden attributes for controllers compatibility -->
                <input name="orderId" value="1198719532" type="hidden">
                <input type="hidden" name="customercode" value="N/A">
                <input type="hidden" name="orderNote" id="orderNote">

                <div class="row g-4">
                    <!-- Row 1: Amount and Payment For -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ammount">Enter Amount <span class="style-strong">*</span></label>
                            <input type="number" class="form-control" name="orderAmount" id="ammount"
                                placeholder="Amount (INR)" required min="1"
                                oninvalid="this.setCustomValidity('Please Enter Amount')"
                                oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="payment_for">Payment For <span class="style-strong">*</span></label>
                            <select class="form-select" id="payment_for" required>
                                <option value="Tour Package" selected>Tour Package</option>
                                <option value="Hotel Booking">Hotel Booking</option>
                                <option value="Cab Booking">Cab Booking</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>

                    <!-- Row 2: Name and Email -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Enter Name <span class="style-strong">*</span></label>
                            <input type="text" class="form-control" name="customerName" id="name"
                                placeholder="Name" required oninvalid="this.setCustomValidity('Please Enter Name')"
                                oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="em">Enter Email Address <span class="style-strong">*</span></label>
                            <input type="email" class="form-control" name="customerEmail" id="em"
                                placeholder="email@domain.com" required
                                oninvalid="this.setCustomValidity('Please Enter Valid Email')"
                                oninput="setCustomValidity('')">
                        </div>
                    </div>

                    <!-- Row 3: Mobile and Country -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no">Enter Mobile Number <span class="style-strong">*</span></label>
                            <input type="tel" class="form-control" name="customerPhone" id="no"
                                placeholder="Contact number" required
                                oninvalid="this.setCustomValidity('Please Enter Contact')"
                                oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="country">Select Country</label>
                            <select class="form-select" name="customeraddress" id="country">
                                <option value="India" selected>India</option>
                                <option value="United States">United States</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="Canada">Canada</option>
                                <option value="Australia">Australia</option>
                                <option value="Germany">Germany</option>
                                <option value="France">France</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>

                    <!-- Row 4: Remarks and Pay Now -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="remarks">Remarks if any</label>
                            <textarea class="form-control" id="remarks" placeholder="Remarks if any"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <fieldset class="pay-now-fieldset">
                            <legend class="pay-now-legend">Pay Now</legend>
                            <div class="pay-now-logos">
                                <img src="{{ asset('/cards.png') }}" class="cards-img" alt="Cards Accepted">
                                <img src="{{ asset('/secure.png') }}" class="secure-img" alt="SSL Secure">
                            </div>
                        </fieldset>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-4">
                    <button type="submit" class="btn btn-continue-payment">
                        Continue to Payment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
    document.getElementById('paymentForm').addEventListener('submit', function(e) {
        e.preventDefault();

        let form = this;

        // Concatenate "Payment For" and "Remarks" into the orderNote field
        const paymentFor = document.getElementById('payment_for').value;
        const remarks = document.getElementById('remarks').value;
        form.orderNote.value = `Payment for: ${paymentFor}` + (remarks ? `. Remarks: ${remarks}` : '');

        fetch("{{ route('razorpay.createOrder') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json"
            },
            body: JSON.stringify({
                orderAmount: form.orderAmount.value
            })
        })
        .then(res => res.json())
        .then(data => {
            var options = {
                key: data.key,
                amount: form.orderAmount.value * 100,
                currency: "INR",
                name: "Ladakh Tourism",
                description: "Package Booking",
                order_id: data.order_id,
                prefill: {
                    name: form.customerName.value,
                    email: form.customerEmail.value,
                    contact: form.customerPhone.value
                },
                handler: function(response) {
                    fetch("{{ route('razorpay.success') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Accept": "application/json"
                        },
                        body: JSON.stringify({
                            razorpay_payment_id: response.razorpay_payment_id,
                            razorpay_order_id: response.razorpay_order_id,
                            razorpay_signature: response.razorpay_signature,
                            customerName: form.customerName.value,
                            customerEmail: form.customerEmail.value,
                            customerPhone: form.customerPhone.value,
                            customercode: form.customercode.value,
                            customeraddress: form.customeraddress.value,
                            orderAmount: form.orderAmount.value,
                            orderNote: form.orderNote.value
                        })
                    })
                    .then(res => res.json())
                    .then(result => {
                        window.location.href = "{{ url('/thank-you') }}";
                    });
                }
            };
            var rzp = new Razorpay(options);
            rzp.open();
        })
        .catch(err => console.log(err));
    });
</script>
@endsection
