@extends('layouts.public')

@php
    $settings = \App\Models\Setting::current();
    $seoTitle = 'Contact Us | '.($settings->site_name ?? config('app.name'));
    $seoDescription = 'Get in touch with '.($settings->site_name ?? config('app.name')).' for Hajj and Umrah package enquiries.';
@endphp

@section('content')

    {{-- Page Hero --}}

    <x-page-hero image="public/contact/5-(2).png" title="Contact Us" />

    {{-- Contact Information --}}

<section class="contact-info-section">

    <div class="contact-info-container">

        <h2 class="contact-info-title">
            Contact Information
        </h2>

        <div class="contact-info-grid">

            {{-- Address --}}
            <div class="contact-info-card">

                <div class="contact-info-icon">
                    <svg width="30" height="30" viewBox="0 0 24 24"
                         fill="white" stroke="currentColor" stroke-width="2">
                        <path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z"/>
                        <circle cx="12" cy="10" r="2.5"/>
                    </svg>
                </div>

                <h3>Address</h3>

                <p>
                    <strong>Head Office</strong><br>
                    #151, Opp. Chichabas Taj, MM Road, Frazer Town,
                    Bangalore - 560005
                </p>

                <p>
                    <strong>Branch Office</strong><br>
                    85, 1st Floor, MM Road, opposite to Vijay
                    Lakshmi Hotel Pulikeshi Nagar, Bengaluru,
                    Karnataka 560005
                </p>

            </div>


            {{-- Phone --}}
            <div class="contact-info-card">

                <div class="contact-info-icon">
                    <svg width="30" height="30" viewBox="0 0 24 24"
                         fill="white" stroke="currentColor" stroke-width="2">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2
                        19.79 19.79 0 0 1-8.63-3.07
                        19.5 19.5 0 0 1-6-6
                        19.79 19.79 0 0 1-3.07-8.67
                        A2 2 0 0 1 4.11 2h3
                        a2 2 0 0 1 2 1.72
                        12.84 12.84 0 0 0 .7 2.81
                        2 2 0 0 1-.45 2.11L8.09 9.91
                        a16 16 0 0 0 6 6l1.27-1.27
                        a2 2 0 0 1 2.11-.45
                        12.84 12.84 0 0 0 2.81.7
                        A2 2 0 0 1 22 16.92z"/>
                    </svg>
                </div>

                <h3>Phone Numbers</h3>

                <p>
                    <a href="tel:+919998707032">+91 99987 07032</a><br>
                    <a href="tel:+919845030128">+91 98450 30128</a>
                </p>

                <h3 class="contact-subtitle">
                    Landline Numbers
                </h3>

                <p>
                    <a href="tel:08040641691">080 - 40641691</a><br>
                    <a href="tel:08041557422">080 - 41557422</a>
                </p>

            </div>


            {{-- Mail / Social --}}
            <div class="contact-info-card">

                <div class="contact-info-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24"
                         fill="white" stroke="white" stroke-width="2">
                        <circle cx="18" cy="5" r="3"/>
                        <circle cx="6" cy="12" r="3"/>
                        <circle cx="18" cy="19" r="3"/>
                        <path d="m8.6 13.5 6.8 4"/>
                        <path d="m15.4 6.5-6.8 4"/>
                    </svg>
                </div>

                <h3>Mail Us</h3>

                <p class="mail-address">
                    <svg width="18" height="18" viewBox="0 0 24 24"
                         fill="currentColor">
                        <path d="M20 4H4a2 2 0 0 0-2 2v1l10 6
                        10-6V6a2 2 0 0 0-2-2Z"/>
                        <path d="M2 9v9a2 2 0 0 0 2 2h16
                        a2 2 0 0 0 2-2V9l-10 6L2 9Z"/>
                    </svg>

                    <a href="mailto:info@albushratnt.in">info@albushratnt.in</a>
                </p>

                <h3 class="follow-title">
                    Follow Us
                </h3>

                <div class="social-links">

                    <a href="https://www.facebook.com/AlBushraToursAndTravelsOfficial" aria-label="Facebook">
                        f
                    </a>

                    <a href="https://www.instagram.com/albushra183/" aria-label="Instagram">
                        ◎
                    </a>

                    <a href="https://x.com/albushra_tours" aria-label="X">
                        X
                    </a>

                    <a href="https://www.youtube.com/@AlBushraTT" aria-label="YouTube">
                        ▶
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

    {{-- Contact Form Section --}}

<section class="contact-form-section">

    <div class="contact-form-container">

        {{-- LEFT IMAGE --}}
        <div class="contact-form-image">

            <img
                src="{{ \Illuminate\Support\Facades\Storage::url('public/contact/download-3-Photoroom-768x882-Photoroom.png') }}"
                alt="Madinah Green Dome"
            >

        </div>


        {{-- RIGHT FORM --}}
        <div class="contact-form-box">

            <h2>
                Contact Form
            </h2>


            {{-- Success Message --}}
            @if (session('success'))

                <div class="contact-form-success">
                    {{ session('success') }}
                </div>

            @endif


            {{-- Validation Errors --}}
            @if ($errors->any())

                <div class="contact-form-errors">

                    @foreach ($errors->all() as $error)

                        <div>
                            {{ $error }}
                        </div>

                    @endforeach

                </div>

            @endif


            <form
                method="POST"
                action="{{ route('contact.store') }}"
                class="contact-form"
            >

                @csrf

                @include('partials.honeypot')


                {{-- Name --}}
                <div class="contact-field">

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Your Name*"
                        required
                    >

                </div>


                {{-- Phone --}}
                <div class="contact-field">

                    <input
                        type="tel"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="Phone No*"
                        required
                    >

                </div>


                {{-- Email --}}
                <div class="contact-field">

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Your Email Address*"
                        required
                    >

                </div>


                {{-- Message --}}
                <div class="contact-field">

                    <textarea
                        name="message"
                        rows="5"
                        placeholder="Your Message*"
                        required
                    >{{ old('message') }}</textarea>

                </div>


                {{-- Submit --}}
                <button
                    type="submit"
                    class="contact-submit-btn"
                >
                    Send
                </button>

            </form>

        </div>
            </div>
        </div>
    </section>
    <section class="contact-map-section">
        @if ($settings->map_embed)
            <div class="contact-map">
                {!! $settings->map_embed !!}
            </div>
        @endif
    </section>
@endsection

<style>
    /* =========================================
   CONTACT INFORMATION
========================================= */

.contact-info-section {
    width: 100%;
    background: #ffffff;
    padding: 50px 0 60px;
}

.contact-info-container {
    width: 100%;
    /* max-width: 1150px; */
    margin: 0 auto;
    padding: 0 60px;
}


/* =========================================
   TITLE
========================================= */

.contact-info-title {
    font-family: "Poppins", Sans-serif;
    font-size: 36px;
    font-weight: 600;
    line-height: 45px;
    letter-spacing: -0.8px;
    color: #1A2B48;

    text-align: center;

    margin: 0 0 35px;
}


/* =========================================
   GRID
========================================= */

.contact-info-grid {
    display: grid;

    grid-template-columns: repeat(3, 1fr);

    gap: 16px;

    width: 100%;
}


/* =========================================
   CARD
========================================= */

.contact-info-card {
    background: #ffffff;

    border-radius: 14px;

    padding: 22px 26px;

    min-height: 265px;

    box-shadow:
        0 5px 15px rgba(0, 0, 0, 0.12);

    border: 1px solid #eeeeee;

    box-sizing: border-box;

    transition:
        transform 0.3s ease,
        box-shadow 0.3s ease;
}

.contact-info-card:hover {
    transform: translateY(-4px);

    box-shadow:
        0 10px 25px rgba(0, 0, 0, 0.15);
}


/* =========================================
   ICON
========================================= */

.contact-info-icon {
    width: 50px;
    height: 50px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #35bda9;

    color: #35bda9;

    border-radius: 9px;

    margin-bottom: 14px;
}


/* =========================================
   CARD HEADING
========================================= */

.contact-info-card h3 {
    color: #2e2e2e;

    font-size: 20px;
    line-height: 1.3;
    font-weight: 500;

    margin: 0 0 7px;
}


/* =========================================
   CARD TEXT
========================================= */

.contact-info-card p {
    color: #53627a;

    font-size: 15px;
    line-height: 1.7;

    margin: 0 0 17px;
}

.contact-info-card strong {
    color: #5e5e5e;
    font-weight: 700;
}


/* =========================================
   PHONE / LANDLINE
========================================= */

.contact-info-card .contact-subtitle {
    margin-top: 8px;
    margin-bottom: 7px;
    
}


/* =========================================
   EMAIL
========================================= */

.mail-address {
    display: flex;
    align-items: center;

    gap: 10px;

    color: #53627a !important;

    margin-bottom: 20px !important;
}

.mail-address svg {
    flex-shrink: 0;
    color: #3d3d3d;
}


/* =========================================
   FOLLOW US
========================================= */

.follow-title {
    margin-top: 5px !important;
    margin-bottom: 14px !important;
}


/* =========================================
   SOCIAL LINKS
========================================= */

.social-links {
    display: flex;
    align-items: center;
    gap: 12px;
}

.social-links a {
    width: 38px;
    height: 38px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #ffffff;

    color: #172f52;

    text-decoration: none;

    font-size: 20px;
    font-weight: 600;

    box-shadow:
        0 5px 15px rgba(0, 0, 0, 0.12);

    transition:
        transform 0.3s ease,
        background-color 0.3s ease,
        color 0.3s ease;
}

.social-links a:hover {
    background: #35bda9;
    color: #ffffff;

    transform: translateY(-3px);
}


/* =========================================
   TABLET
========================================= */

@media (max-width: 900px) {

    .contact-info-grid {
        grid-template-columns: 1fr 1fr;
    }

    .contact-info-card:last-child {
        grid-column: 1 / -1;
    }

}


/* =========================================
   MOBILE
========================================= */

@media (max-width: 600px) {

    .contact-info-section {
        padding: 40px 0 50px;
    }

    .contact-info-container {
        padding: 0 16px;
    }

    .contact-info-title {
        font-size: 28px;
        margin-bottom: 28px;
    }

    .contact-info-grid {
        grid-template-columns: 1fr;
        gap: 18px;
    }

    .contact-info-card:last-child {
        grid-column: auto;
    }

    .contact-info-card {
        min-height: auto;
        padding: 22px;
    }

}

/* =========================================
   CONTACT FORM SECTION
========================================= */

.contact-form-section {
    width: 100%;
    background: #ffffff;

    padding: 55px 0 70px;
}


/* =========================================
   MAIN CONTAINER
========================================= */

.contact-form-container {
    width: 100%;
    /* max-width: 1150px; */

    margin: 0 auto;
    padding: 0 60px;

    display: grid;
    grid-template-columns: 1fr 1fr;

    align-items: center;

    gap: 35px;
}


/* =========================================
   LEFT IMAGE
========================================= */

.contact-form-image {
    width: 100%;

    display: flex;
    align-items: flex-end;
    justify-content: center;

    overflow: hidden;
}

.contact-form-image img {
    display: block;
    padding: 30px 30px;
    width: 100%;
    /* max-width: 530px; */

    /* height: 480px; */

    object-fit: contain;
    object-position: center bottom;
}


/* =========================================
   FORM BOX
========================================= */

.contact-form-box {
    width: 100%;

    background: #35bda9;

    border-radius: 18px;

    padding: 32px 38px 40px;

    box-sizing: border-box;
}


/* =========================================
   FORM TITLE
========================================= */

.contact-form-box h2 {
    width: 100%;
    max-width: 100%;
    font-size: 36px;
    font-weight: 600;
    font-stretch: normal;
    font-style: normal;
    line-height: 30px;
    letter-spacing: normal;
    color: #fff;
    opacity: 1;
    padding-bottom: 20px;
}


/* =========================================
   SUCCESS MESSAGE
========================================= */

.contact-form-success {
    background: #e9f8ee;
    color: #1e7a46;

    border-radius: 10px;

    padding: 10px 14px;

    margin-bottom: 12px;

    font-size: 13px;
    line-height: 1.5;
}


/* =========================================
   ERROR MESSAGE
========================================= */

.contact-form-errors {
    background: #fbeae9;
    color: #b3261e;

    border-radius: 10px;

    padding: 10px 14px;

    margin-bottom: 12px;

    font-size: 13px;
    line-height: 1.5;
}


/* =========================================
   FORM
========================================= */

.contact-form {
    width: 100%;

    display: flex;
    flex-direction: column;

    gap: 11px;
}


/* =========================================
   INPUT WRAPPER
========================================= */

.contact-field {
    width: 100%;
}


/* =========================================
   INPUT + TEXTAREA
========================================= */

.contact-field input,
.contact-field textarea {
    width: 100%;
    border-radius: 24px;
    background-color: #26a68c;
    padding: 24px 24px 24px 24px;
    outline: none;
    margin-bottom: 16px;
    font-size: 18px;
    font-weight: 600;
    font-stretch: normal;
    font-style: normal;
    line-height: 1.5;
    letter-spacing: normal;
    color: rgba(255, 255, 255, 0.6);
    border: none;
    /* position: relative;
    z-index: 50; */
}


/* Input height */

.contact-field input {
    height: 37px;
}


/* Textarea */

.contact-field textarea {
    min-height: 90px;

    resize: vertical;

    border-radius: 16px;

    padding-top: 13px;
}


/* Placeholder */

.contact-field input::placeholder,
.contact-field textarea::placeholder {
    color: rgba(255, 255, 255, 0.75);

    opacity: 1;
}


/* Focus */

.contact-field input:focus,
.contact-field textarea:focus {
    background: #239e8b;

    box-shadow:
        0 0 0 2px rgba(255, 255, 255, 0.25);
}


/* =========================================
   SEND BUTTON
========================================= */

.contact-submit-btn {
    width: 100%;

    height: 45px;

    border: none;

    border-radius: 25px;

    background: #ef907d;

    color: #ffffff;

    font-family: inherit;

    font-size: 13px;
    font-weight: 600;

    cursor: pointer;

    box-shadow:
        0 4px 0 #d85e49;

    transition:
        transform 0.2s ease,
        background-color 0.2s ease,
        box-shadow 0.2s ease;
}


.contact-submit-btn:hover {
    background: #f19a88;

    transform: translateY(-2px);

    box-shadow:
        0 6px 0 #d85e49;
}


.contact-submit-btn:active {
    transform: translateY(2px);

    box-shadow:
        0 2px 0 #d85e49;
}


/* =========================================
   TABLET
========================================= */

@media (max-width: 900px) {

    .contact-form-container {
        grid-template-columns: 1fr 1fr;

        gap: 25px;

        padding: 0 20px;
    }

    .contact-form-image img {
        height: 420px;
    }

    .contact-form-box {
        padding: 28px 25px 32px;
    }

}


/* =========================================
   MOBILE
========================================= */

@media (max-width: 700px) {

    .contact-form-section {
        padding: 45px 0 55px;
    }

    .contact-form-container {
        display: flex;
        flex-direction: column;

        width: 100%;

        padding: 0 18px;

        gap: 25px;
    }


    /* Image */

    .contact-form-image {
        width: 100%;

        max-width: 500px;

        margin: 0 auto;
    }

    .contact-form-image img {
        width: 100%;

        height: 350px;

        object-fit: contain;
    }


    /* Form */

    .contact-form-box {
        width: 100%;

        max-width: 550px;

        margin: 0 auto;

        padding: 28px 22px 32px;

        border-radius: 16px;
    }

    .contact-form-box h2 {
        font-size: 24px;
    }

}


/* =========================================
   SMALL MOBILE
========================================= */

@media (max-width: 480px) {

    .contact-form-container {
        padding: 0 15px;
    }

    .contact-form-image img {
        height: 290px;
    }

    .contact-form-box {
        padding: 25px 18px 28px;
    }

    .contact-form-box h2 {
        font-size: 22px;
    }

    .contact-field input {
        height: 40px;
    }

    .contact-field input,
    .contact-field textarea {
        font-size: 13px;
    }

}

.contact-map {
    width: calc(100% - 120px) !important;
    max-width: none !important;

    margin: 0 60px 80px !important;
    padding: 0 !important;

    overflow: hidden;

    border-radius: 12px;
}

.contact-map iframe {
    display: block !important;

    width: 100% !important;
    height: 450px !important;

    margin: 0 !important;
    padding: 0 !important;

    border: 0 !important;

    border-radius: 12px;
}

@media (max-width: 900px) {
    .contact-map {
        width: calc(100% - 40px) !important;
        margin: 0 20px 60px !important;
    }

    .contact-map iframe {
        height: 350px !important;
    }
}

@media (max-width: 480px) {
    .contact-map {
        width: calc(100% - 24px) !important;
        margin: 0 12px 40px !important;
    }

    .contact-map iframe {
        height: 260px !important;
    }
}

</style>