@extends('layouts.public')

@php
    $settings = \App\Models\Setting::current();
    $siteName = $settings->site_name ?? config('app.name');
    $seoTitle = 'About Us | '.$siteName;
    $seoDescription = 'Learn about '.$siteName.' and our commitment to making every Hajj and Umrah journey meaningful, comfortable, and well supported.';
@endphp

@section('content')
    
    {{-- Contact Hero --}}

<section class="contact-hero">

    <img
        src="{{ \Illuminate\Support\Facades\Storage::url('public/about/5.png') }}"
        alt="Contact Us"
        class="contact-hero-image"
    >

    <div class="contact-hero-content">

        <div class="contact-breadcrumb">
            <a href="{{ url('/') }}">Home</a>
            <span>•</span>
            <span>About Us</span>
        </div>

        <h1>About Us</h1>

    </div>

</section>

{{-- About Us Intro Section --}}

<section class="about-intro-section">

    <div class="about-intro-container">

        {{-- LEFT CONTENT --}}
        <div class="about-intro-content">

            <p class="about-intro-eyebrow">
                About Us
            </p>

            <h2 class="about-intro-title">
                We Are The Best Partner For Your Hajj and Umrah
            </h2>

            <p class="about-intro-description">
                Al Bushra has been the leading Hajj and Umrah travel guide in India
                with honesty and assurance. We will be there with you every step of
                the way, from the moment you make your intention till the conclusion
                of your Hajj, Umrah, and Ziyarat.
            </p>


            {{-- FEATURES --}}
            <div class="about-feature-grid">

                {{-- Free Luggage --}}
                <div class="about-feature-card">

                    <div class="about-feature-icon">

                        <svg width="30" height="30"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2">
                            <rect x="5" y="6" width="14" height="15" rx="2"/>
                            <path d="M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2"/>
                            <path d="M9 11v5"/>
                            <path d="M15 11v5"/>
                        </svg>

                    </div>

                    <h3>
                        Free Luggage
                    </h3>

                    <p>
                        Enjoy the ease of travel with our complimentary
                        luggage service
                    </p>

                </div>


                {{-- 5 Star Hotel --}}
                <div class="about-feature-card">

                    <div class="about-feature-icon">

                        <svg width="30" height="30"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2">
                            <path d="M3 21h18"/>
                            <path d="M5 21V7l7-4 7 4v14"/>
                            <path d="M9 21v-5h6v5"/>
                            <path d="M8 10h1"/>
                            <path d="M15 10h1"/>
                            <path d="M8 13h1"/>
                            <path d="M15 13h1"/>
                        </svg>

                    </div>

                    <h3>
                        5 Star Hotel
                    </h3>

                    <p>
                        Indulge in luxury and comfort with our 5-star
                        hotel accommodations
                    </p>

                </div>


                {{-- Safe & Secure --}}
                <div class="about-feature-card">

                    <div class="about-feature-icon">

                        <svg width="30" height="30"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/>
                            <path d="m9 12 2 2 4-4"/>
                        </svg>

                    </div>

                    <h3>
                        Safe &amp; Secure
                    </h3>

                    <p>
                        Prioritizing your peace of mind, we ensure a
                        safe and secure pilgrimage
                    </p>

                </div>


                {{-- 24/7 Support --}}
                <div class="about-feature-card">

                    <div class="about-feature-icon">

                        <svg width="30" height="30"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2">
                            <path d="M4 12a8 8 0 0 1 16 0"/>
                            <path d="M4 12v4a2 2 0 0 0 2 2h2v-6H6a2 2 0 0 0-2 2Z"/>
                            <path d="M20 12v4a2 2 0 0 1-2 2h-2v-6h2a2 2 0 0 1 2 2Z"/>
                            <path d="M16 19c-.8 1-2.1 1.5-4 1.5"/>
                        </svg>

                    </div>

                    <h3>
                        24/7 Support
                    </h3>

                    <p>
                        Experience unwavering support around the clock
                        with our 24/7 assistance
                    </p>

                </div>

            </div>

        </div>


        {{-- RIGHT IMAGE --}}
        <div class="about-intro-image">

            <img
                src="{{ \Illuminate\Support\Facades\Storage::url('public/about/pexels-abu-aman-433296678-31805890-1536x1536.jpg') }}"
                alt="Al Bushra Hajj and Umrah"
            >

        </div>

    </div>

</section>

{{-- Vision & Mission Section --}}

<section class="vision-mission-section">

    <div class="vision-mission-container">

        {{-- Heading --}}
        <div class="vision-mission-heading">

            <p class="vision-eyebrow">
                What We Offer
            </p>

            <h2>
                Our Vision and Mission
            </h2>

        </div>


        {{-- Cards --}}
        <div class="vision-mission-grid">

            {{-- Card 1 --}}
            <div class="vision-card">

                <div class="vision-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#c0a150" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M12 20.5c-1.8-1.8-7-5.1-7-9.3A3.2 3.2 0 0 1 8.2 8c1.4 0 2.7.8 3.8 2 1.1-1.2 2.4-2 3.8-2a3.2 3.2 0 0 1 3.2 3.2c0 4.2-5.2 7.5-7 9.3Z"/>
                        <path d="M8.5 4.5 12 8l3.5-3.5"/>
                    </svg>
                </div>

                <h3>
                    Provide<br>
                    Spiritual Journey
                </h3>

                <p>
                    We offer meaningful Hajj and Umrah journeys with spiritual
                    depth and peace at every step of your way.
                </p>

            </div>


            {{-- Card 2 --}}
            <div class="vision-card">

                <div class="vision-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#c0a150" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="m5 13 4 4L19 7"/>
                    </svg>
                </div>

                <h3>
                    Professional<br>
                    Pilgrim's Guide
                </h3>

                <p>
                    Our trained guides offer insights, directions, and support
                    throughout your pilgrimage journey for full comfort.
                </p>

            </div>


            {{-- Card 3 --}}
            <div class="vision-card">

                <div class="vision-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#c0a150" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="m4 9 8-4 8 4-8 4-8-4Z"/>
                        <path d="M6 10.5v6l6 3 6-3v-6"/>
                        <path d="M9 11.5v6M15 11.5v6M4 9v6M20 9v6"/>
                        <path d="M10 8.5h4v2h-4z" fill="#c0a150" stroke="none"/>
                    </svg>
                </div>

                <h3>
                    We<br>
                    Support Pilgrims
                </h3>

                <p>
                    24/7 support for all pilgrims — from airport to Makkah and
                    Madinah, your care is our commitment.
                </p>

            </div>


            {{-- Card 4 --}}
            <div class="vision-card">

                <div class="vision-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#c0a150" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M4 20h16M6 20v-8h12v8M4 12h16"/>
                        <path d="M8 12V9a4 4 0 0 1 8 0v3M12 5V3M9 20v-4h6v4"/>
                        <path d="M3 12h18"/>
                    </svg>
                </div>

                <h3>
                    We Give<br>
                    Hassle-free Experience
                </h3>

                <p>
                    From ticketing to ziyarat, we manage everything smoothly
                    so you can focus only on your spiritual purpose.
                </p>

            </div>

        </div>

    </div>

</section>
{{-- Journey Section --}}

<section class="journey-section">

    <div class="journey-container">

        {{-- SINGLE IMAGE --}}
        <div class="journey-image">
            <img
                src="{{ \Illuminate\Support\Facades\Storage::url('public/about/Gulshan-tnt-website-images-3.png') }}"
                alt="A Journey of Submission"
            >
        </div>


        {{-- CONTENT --}}
        <div class="journey-content">

            <h2>
                A Journey of Submission, A Path to Purity
            </h2>

            <p>
                Hajj and Umrah are not ordinary travels — they are sacred calls
                from the House of Allah, answered by hearts longing for
                forgiveness, renewal, and divine closeness. At Al Bushra, we
                understand that this journey is once-in-a-lifetime for many and
                a lifelong prayer for others. That’s why our mission is simple
                yet deeply spiritual: to make every moment of your pilgrimage
                meaningful, comfortable, and guided with sincerity.
            </p>

            <p>
                Hajj and Umrah are not ordinary travels — they are sacred calls
                from the House of Allah, answered by hearts longing for
                forgiveness, renewal, and divine closeness. At Al Bushra, we
                understand that this journey is once-in-a-lifetime for many and
                a lifelong prayer for others. That’s why our mission is simple
                yet deeply spiritual: to make every moment of your pilgrimage
                meaningful, comfortable, and guided with sincerity.
            </p>

        </div>

    </div>

</section>

{{-- Meet Our Team --}}

<section class="team-section">

    <div class="team-container">

        <p class="team-eyebrow">
            Meet Our Team
        </p>

        <div class="team-grid">

            {{-- Mohammed Rafi Set --}}
            <div class="team-card">

                <div class="team-image">
                    <img
                        src="{{ \Illuminate\Support\Facades\Storage::url('public/about/al-bushra-tours-2.png') }}"
                        alt="Mohammed Rafi Set"
                    >
                </div>

                <div class="team-info">
                    <h3>Mohammed Rafi Set</h3>
                    <p>Partner</p>
                </div>

            </div>


            {{-- Ahmed Memon --}}
            <div class="team-card">

                <div class="team-image">
                    <img
                        src="{{ \Illuminate\Support\Facades\Storage::url('public/about/memon.png') }}"
                        alt="Ahmed Memon"
                    >
                </div>

                <div class="team-info">
                    <h3>Ahmed Memon</h3>
                    <p>Director</p>
                </div>

            </div>


            {{-- Shahrukh Hussain --}}
            <div class="team-card">

                <div class="team-image">
                    <img
                        src="{{ \Illuminate\Support\Facades\Storage::url('public/about/8.png') }}"
                        alt="Shahrukh Hussain"
                    >
                </div>

                <div class="team-info">
                    <h3>Shahrukh Hussain</h3>
                    <p>Sales Executive</p>
                </div>

            </div>


            {{-- Mohammad Irshad --}}
            <div class="team-card">

                <div class="team-image">
                    <img
                        src="{{ \Illuminate\Support\Facades\Storage::url('public/about/7.png') }}"
                        alt="Mohammad Irshad"
                    >
                </div>

                <div class="team-info">
                    <h3>Mohammad Irshad</h3>
                    <p>Senior Marketing Executive</p>
                </div>

            </div>


            {{-- Alia Safina --}}
            <div class="team-card">

                <div class="team-image">
                    <img
                        src="{{ \Illuminate\Support\Facades\Storage::url('public/about/9.png') }}"
                        alt="Alia Safina"
                    >
                </div>

                <div class="team-info">
                    <h3>Alia Safina</h3>
                    <p>Team Lead</p>
                </div>

            </div>


            {{-- Mehruz --}}
            <div class="team-card">

                <div class="team-image">
                    <img
                        src="{{ \Illuminate\Support\Facades\Storage::url('public/about/mahruz.png ') }}"
                        alt="Mehruz"
                    >
                </div>

                <div class="team-info">
                    <h3>Mehruz</h3>
                    <p>Sales Executive</p>
                </div>

            </div>

        </div>

    </div>

</section>


@endsection

<style>
    .contact-hero {
    position: relative;
    width: 100%;
    height: 355px;
    overflow: hidden;
}

.contact-hero-image {
    position: absolute;
    inset: 0;

    width: 100%;
    height: 100%;

    display: block;

    object-fit: cover;
    object-position: center;

    z-index: 1;
}

.contact-hero-content {
    position: relative;
    z-index: 2;

    width: 100%;
    height: 100%;

    max-width: 1350px;
    margin: 0 auto;
}

.contact-breadcrumb {
    position: absolute;

    top: 28px;
    left: 50px;

    display: flex;
    align-items: center;
    gap: 8px;

    font-size: 14px;
    color: #172f52;
}

.contact-breadcrumb a {
    color: #172f52;
    text-decoration: none;
}

.contact-hero-content h1 {
    position: absolute;

    left: 50px;
    top: 50%;

    transform: translateY(-50%);

    margin: 0;

    color: #229fe5;

    font-size: 40px;
    line-height: 1;
    font-weight: 700;
}


/* Mobile */

@media (max-width: 700px) {

    .contact-hero {
        height: 280px;
    }

    .contact-hero-image {
        object-position: center;
    }

    .contact-breadcrumb {
        top: 20px;
        left: 20px;
        font-size: 12px;
    }

    .contact-hero-content h1 {
        left: 20px;
        font-size: 30px;
    }
}

/* =========================================
   ABOUT US INTRO
========================================= */

.about-intro-section {
    width: 100%;
    background: #ffffff;

    padding: 55px 0 70px;
}


.about-intro-container {
    width: 100%;
    /* max-width: 1100px; */

    margin: 0 auto;
    padding: 0 60px;

    display: grid;
    grid-template-columns: 1fr 1fr;

    gap: 14px;

    align-items: center;
}


/* =========================================
   LEFT CONTENT
========================================= */

.about-intro-content {
    width: 100%;
}


.about-intro-eyebrow {
    color: #24b8a8;

    font-size: 16px;
    font-weight: 500;

    margin: 0 0 14px;
}


.about-intro-title {
    font-family: "Poppins", Sans-serif;
    font-size: 36px;
    font-weight: 600;
    line-height: 45px;
    letter-spacing: -0.8px;
    color: #1A2B48;

    margin: 0 0 16px;
}


.about-intro-description {
    color: #1A2B48;
    font-size: 16px;
    line-height: 1.55;
    margin: 0;
    max-width: 570px;
    font-weight: 400;
    padding-bottom: 30px;

    max-width: 500px;
}


/* =========================================
   FEATURE GRID
========================================= */

.about-feature-grid {
    display: grid;

    grid-template-columns: repeat(2, 1fr);

    gap: 14px;

    width: 100%;
}


/* =========================================
   FEATURE CARD
========================================= */

.about-feature-card {
    min-height: 145px;

    padding: 20px 16px;

    background: #ffffff;

    border: 1px solid #eeeeee;

    border-radius: 7px;

    box-sizing: border-box;

    text-align: center;

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;

    box-shadow:
        0 4px 12px rgba(0, 0, 0, 0.08);

    transition:
        transform 0.3s ease,
        box-shadow 0.3s ease,
        border-color 0.3s ease;
}


.about-feature-card:hover {
    transform: translateY(-5px);

    border-color: #35bda9;

    box-shadow:
        0 10px 22px rgba(0, 0, 0, 0.12);
}


/* =========================================
   ICON
========================================= */

.about-feature-icon {
    width: 60px;
    height: 60px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #35bda9;

    color: #ffffff;

    margin-bottom: 11px;

    flex-shrink: 0;

    transition:
        transform 0.3s ease,
        background-color 0.3s ease;
}


.about-feature-card:hover .about-feature-icon {
    transform: scale(1.08);

    background: #24aa98;
}


/* =========================================
   CARD TITLE
========================================= */

.about-feature-card h3 {
    color: #000;

    font-size: 20px;
    line-height: 1.3;

    font-weight: 600;

    margin: 0 0 9px;
}


/* =========================================
   CARD DESCRIPTION
========================================= */

.about-feature-card p {
    color: #172f52;

    font-size: 16px;
    line-height: 1.45;

    margin: 0;
}


/* =========================================
   RIGHT IMAGE
========================================= */

.about-intro-image {
    width: 100%;

    /* height: 435px; */

    overflow: hidden;

    border-radius: 8px;

    box-shadow:
        0 4px 14px rgba(0, 0, 0, 0.12);
}


.about-intro-image img {
    width: 100%;
    height: 100%;

    display: block;

    object-fit: cover;
    object-position: center;
}


/* =========================================
   TABLET
========================================= */

@media (max-width: 900px) {

    .about-intro-container {
        grid-template-columns: 1fr 1fr;

        padding: 0 20px;

        gap: 20px;
    }

    .about-intro-title {
        font-size: 23px;
    }

    .about-intro-description {
        font-size: 12px;
    }

    .about-intro-image {
        height: 400px;
    }

}


/* =========================================
   MOBILE
========================================= */

@media (max-width: 700px) {

    .about-intro-section {
        padding: 45px 0 55px;
    }

    .about-intro-container {
        display: flex;
        flex-direction: column;

        padding: 0 16px;

        gap: 25px;
    }


    .about-intro-content {
        width: 100%;
    }


    .about-intro-eyebrow {
        text-align: left;
    }


    .about-intro-title {
        font-size: 25px;
    }


    .about-intro-description {
        max-width: none;

        font-size: 13px;
    }


    .about-feature-grid {
        gap: 12px;
    }


    .about-feature-card {
        min-height: 150px;

        padding: 18px 12px;
    }


    .about-feature-card h3 {
        font-size: 14px;
    }


    .about-feature-card p {
        font-size: 11.5px;
    }


    .about-intro-image {
        width: 100%;
        height: 350px;

        order: 2;
    }

}


/* =========================================
   SMALL MOBILE
========================================= */

@media (max-width: 480px) {

    .about-intro-container {
        padding: 0 14px;
    }


    .about-intro-title {
        font-size: 22px;
    }


    .about-feature-grid {
        grid-template-columns: 1fr 1fr;
    }


    .about-feature-card {
        min-height: 145px;

        padding: 16px 10px;
    }


    .about-feature-icon {
        width: 42px;
        height: 42px;

        margin-bottom: 9px;
    }


    .about-intro-image {
        height: 300px;
    }

}
/* =========================================
   VISION & MISSION SECTION
========================================= */

.vision-mission-section {
    width: 100%;
    background: #ffffff;

    padding: 45px 0 55px;
}

.vision-mission-container {
    width: 100%;
    /* max-width: 1100px; */

    margin: 0 auto;
    padding: 0 60px;

    box-sizing: border-box;
}


/* =========================================
   HEADING
========================================= */

.vision-mission-heading {
    text-align: center;

    margin-bottom: 22px;
}

.vision-eyebrow {
    color: #172f52;

    font-size: 16px;
    font-weight: 500;

    margin: 0 0 17px;
}

.vision-mission-heading h2 {
    font-family: "Poppins", Sans-serif;
    font-size: 36px;
    font-weight: 600;
    line-height: 45px;
    letter-spacing: -0.8px;
    color: #1A2B48;

    font-weight: 700;

    margin: 0;
}


/* =========================================
   GRID
========================================= */

.vision-mission-grid {
    display: grid;

    grid-template-columns: repeat(4, 1fr);

    gap: 16px;

    width: 100%;
}


/* =========================================
   CARD
========================================= */

.vision-card {
    min-height: 275px;

    padding: 27px 20px 22px;

    background: #ffffff;

    border: 1px solid #eeeeee;

    border-radius: 7px;

    box-sizing: border-box;

    text-align: center;

    display: flex;
    flex-direction: column;
    align-items: center;

    box-shadow:
        0 3px 10px rgba(0, 0, 0, 0.10);

    transition:
        transform 0.3s ease,
        box-shadow 0.3s ease;
}


/* =========================================
   CARD HOVER
========================================= */

.vision-card:hover {
    transform: translateY(-6px);

    box-shadow:
        0 10px 22px rgba(0, 0, 0, 0.14);
}


/* =========================================
   ICON
========================================= */

.vision-icon {
    width: 63px;
    height: 63px;

    border-radius: 50%;

    background: #242424;

    display: flex;
    align-items: center;
    justify-content: center;

    margin-bottom: 16px;

    flex-shrink: 0;
}

.vision-icon span {
    color: #c89c3c;

    font-size: 27px;

    line-height: 1;
}


/* =========================================
   CARD TITLE
========================================= */

.vision-card h3 {
    color: #111111;

    font-size: 19px;
    line-height: 1.15;

    font-weight: 500;

    margin: 0 0 12px;
}


/* =========================================
   CARD TEXT
========================================= */

.vision-card p {
    color: #53627a;

    font-size: 16px;
    line-height: 1.4;

    margin: 0;

    max-width: 220px;
}


/* =========================================
   TABLET
========================================= */

@media (max-width: 1000px) {

    .vision-mission-container {
        padding: 0 20px;
    }

    .vision-mission-grid {
        grid-template-columns: repeat(2, 1fr);

        gap: 18px;
    }

    .vision-card {
        min-height: 250px;
    }

}


/* =========================================
   MOBILE
========================================= */

@media (max-width: 600px) {

    .vision-mission-section {
        padding: 40px 0 50px;
    }

    .vision-mission-container {
        padding: 0 15px;
    }

    .vision-mission-heading {
        margin-bottom: 25px;
    }

    .vision-eyebrow {
        font-size: 13px;
        margin-bottom: 10px;
    }

    .vision-mission-heading h2 {
        font-size: 27px;
    }

    .vision-mission-grid {
        grid-template-columns: 1fr 1fr;

        gap: 12px;
    }

    .vision-card {
        min-height: 245px;

        padding: 20px 12px;
    }

    .vision-icon {
        width: 55px;
        height: 55px;

        margin-bottom: 13px;
    }

    .vision-icon span {
        font-size: 23px;
    }

    .vision-card h3 {
        font-size: 16px;
    }

    .vision-card p {
        font-size: 12px;
    }

}


/* =========================================
   SMALL MOBILE
========================================= */

@media (max-width: 400px) {

    .vision-mission-grid {
        grid-template-columns: 1fr;
    }

    .vision-card {
        min-height: auto;

        padding: 25px 20px;
    }

    .vision-card p {
        max-width: 280px;
    }

}
/* =========================================
   JOURNEY SECTION
========================================= */

.journey-section {
    width: 100%;
    background: #ffffff;
    padding: 50px 0 65px;
}

.journey-container {
    width: 100%;
    /* max-width: 1100px; */

    margin: 0 auto;
    padding: 0 60px;

    display: grid;
    grid-template-columns: 1fr 1fr;

    gap: 18px;

    align-items: center;
}


/* =========================================
   SINGLE IMAGE
========================================= */

.journey-image {
    width: 100%;
    /* height: 425px; */

    overflow: hidden;
    border-radius: 9px;
}

.journey-image img {
    width: 100%;
    height: 100%;

    display: block;

    object-fit: cover;
    object-position: center;
}


/* =========================================
   CONTENT
========================================= */

.journey-content {
    width: 100%;
}

.journey-content h2 {
    font-family: "Poppins", Sans-serif;
    font-size: 36px;
    font-weight: 600;
    line-height: 45px;
    letter-spacing: -0.8px;
    color: #1A2B48;

    margin: 0 0 22px;
}

.journey-content p {
    color: #172f52;
    font-size: 18px;
    line-height: 1.55;
    margin: 0;
    max-width: 570px;
    font-weight: 400;

    text-align: justify;
}


/* =========================================
   TABLET
========================================= */

@media (max-width: 900px) {

    .journey-container {
        padding: 0 20px;
        gap: 20px;
    }

    .journey-image {
        height: 450px;
    }

    .journey-content h2 {
        font-size: 24px;
    }

    .journey-content p {
        font-size: 13px;
        line-height: 1.65;
    }
}


/* =========================================
   MOBILE
========================================= */

@media (max-width: 700px) {

    .journey-section {
        padding: 40px 0 55px;
    }

    .journey-container {
        display: flex;
        flex-direction: column;

        padding: 0 16px;

        gap: 30px;
    }

    .journey-image {
        width: 100%;
        height: auto;

        border-radius: 8px;
    }

    .journey-image img {
        width: 100%;
        height: auto;

        object-fit: contain;
    }

    .journey-content h2 {
        font-size: 24px;
        margin-bottom: 16px;
    }

    .journey-content p {
        font-size: 13px;
        line-height: 1.65;

        text-align: left;
    }
}


/* =========================================
   SMALL MOBILE
========================================= */

@media (max-width: 480px) {

    .journey-container {
        padding: 0 14px;
    }

    .journey-content h2 {
        font-size: 22px;
    }

    .journey-content p {
        font-size: 12.5px;
    }
}

/* =========================================
   TEAM SECTION
========================================= */

.team-section {
    width: 100%;

    background: #ffffff;

    padding: 10px 0 55px;
}


.team-container {
    width: 100%;
    /* max-width: 1100px; */

    margin: 0 auto;

    padding: 0 16px;

    box-sizing: border-box;
}


/* =========================================
   HEADING
========================================= */

.team-eyebrow {
    font-family: "Poppins", Sans-serif;
    font-size: 36px;
    font-weight: 600;
    line-height: 45px;
    letter-spacing: -0.8px;
    color: #1A2B48;
    padding-bottom: 20px;

    text-align: center;

    margin: 0 0 15px;
}


/* =========================================
   TEAM GRID
========================================= */

.team-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 8px;

    width: 100%;
    /* max-width: 950px; */

    margin: 0 auto;
    padding: 0 60px;
}


/* =========================================
   FIRST ROW - 2 CENTER CARDS
========================================= */

.team-card:nth-child(1) {
    grid-column: 2;
    grid-row: 1;
}

.team-card:nth-child(2) {
    grid-column: 3;
    grid-row: 1;
}


/* =========================================
   SECOND ROW - 4 CARDS
========================================= */

.team-card:nth-child(3) {
    grid-column: 1;
    grid-row: 2;
}

.team-card:nth-child(4) {
    grid-column: 2;
    grid-row: 2;
}

.team-card:nth-child(5) {
    grid-column: 3;
    grid-row: 2;
}

.team-card:nth-child(6) {
    grid-column: 4;
    grid-row: 2;
}


/* =========================================
   CARD
========================================= */

.team-card {
    width: 100%;

    background: #ffffff;

    border: 1px solid #eeeeee;
    border-radius: 5px;

    overflow: hidden;

    box-shadow: 0 3px 9px rgba(0, 0, 0, 0.12);

    transition: all 0.3s ease;
}

.team-card:hover {
    transform: translateY(-5px);

    box-shadow: 0 9px 20px rgba(0, 0, 0, 0.16);
}


/* =========================================
   IMAGE
========================================= */

.team-image {
    width: 100%;
    height: 380px;

    background: #f5ead2;

    overflow: hidden;
}

.team-image img {
    display: block;

    width: 100%;
    height: 100%;

    object-fit: cover;
    object-position: center;
}


/* =========================================
   INFO
========================================= */

.team-info {
    /* min-height: 58px; */

    padding: 10px 8px;

    text-align: center;

    background: #ffffff;
}

.team-info h3 {
    color: #000;

    font-size: 20px;
    line-height: 1.25;

    font-weight: 600;

    margin: 0 0 5px;
}

.team-info p {
    color: #172f52;

    font-size: 18px;
    line-height: 1.2;

    margin: 0;
}
@media (max-width: 650px) {

    .team-grid {
        grid-template-columns: repeat(2, 1fr);

        gap: 12px;

        max-width: 600px;
    }

    /* Reset desktop positioning */
    .team-card:nth-child(1),
    .team-card:nth-child(2),
    .team-card:nth-child(3),
    .team-card:nth-child(4),
    .team-card:nth-child(5),
    .team-card:nth-child(6) {
        grid-column: auto;
        grid-row: auto;
    }

    .team-image {
        height: 190px;
    }

    .team-info {
        min-height: 60px;
    }

    .team-info h3 {
        font-size: 13px;
    }

    .team-info p {
        font-size: 10px;
    }
}

</style>