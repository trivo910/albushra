@extends('layouts.public')

@php
    $settings = \App\Models\Setting::current();
    $siteName = $settings->site_name ?? config('app.name');
    $seoTitle = 'Hajj Packages from Bangalore 2027 | '.$siteName;
    $seoDescription = 'Explore Hajj packages from Bangalore for 2027 with Al Bushra Travel, including guidance, accommodation, transport, and support for your pilgrimage.';
@endphp

@section('content')
    {{-- Hajj Packages Banner --}}

<section class="hajj-banner-section">

    <div class="hajj-banner-container">

        <h1 class="hajj-banner-title">
            Hajj packages from Bangalore 2027
        </h1>

        <div class="hajj-banner-image">
            <img
                src="{{ \Illuminate\Support\Facades\Storage::url('public/banner/ChatGPT-Image-Jun-27-2026-03_09_18-PM.png') }}"
                alt="Hajj packages from Bangalore 2027"
            >
        </div>

    </div>

</section>

{{-- Why Choose Al Bushra --}}

<section class="why-albushra-section">

    <div class="why-albushra-container">

        {{-- TOP CONTENT --}}
        <div class="why-albushra-intro">

            <h2>
                Perform Hajj and Umrah with Al Bushra Tours and Travels.
                Find the Faithful Path
            </h2>

            <p>
                We blend our knowledge with our customer-first philosophy,
                offering customized
                <strong>Hajj packages from Bangalore 2027</strong>
                to ensure your journey is as smooth and memorable as it can be.
                If you’re making your own debut Umrah or a return trip,
                We are there to help you through every step of the journey.
                We at Al Bushra Tours and Travels, the
                <strong><a href="https://albushratnt.in/">best Umrah travel agency in Bangalore</a></strong>,
                ensure every element of your Umrah trip is flawlessly managed
                so you can concentrate on your spiritual journey.
            </p>

        </div>


        {{-- BOTTOM CONTENT --}}
        <div class="why-albushra-main">

            {{-- LEFT --}}
            <div class="why-albushra-content">

                <h2>
                    Why Choose Al Bushra Tours &amp; Travels
                </h2>


                <div class="why-point">

                    <h3>
                        Indian Buffet Meals
                    </h3>

                    <p>
                        Our Indian chefs cook delicious, fresh buffet meals
                        every day, serving familiar tastes and nutritious
                        choices to keep you going on the spiritual path.
                    </p>

                </div>


                <div class="why-point">

                    <h3>
                        24/7 Service Support
                    </h3>

                    <p>
                        Our team members located in India as well as Saudi Arabia
                        are available 24/7 to help you, making sure your trip
                        is easy as well as stress-free and supported throughout
                        the journey.
                    </p>

                </div>


                <div class="why-point">

                    <h3>
                        Transparent Pricing
                    </h3>

                    <p>
                        We offer upfront, clear pricing without hidden charges
                        to help you plan your trip without worrying about any
                        surprises or additional charges.
                    </p>

                </div>

            </div>


            {{-- RIGHT IMAGE --}}
            <div class="why-albushra-image">

                <img
                    src="{{ \Illuminate\Support\Facades\Storage::url('public/banner/295-x-460-04.jpg') }}"
                    alt="Al Bushra Tours and Travels"
                >

            </div>

        </div>

    </div>

</section>

{{-- Hajj & Umrah Packages Information --}}

<section class="package-info-section">

    <div class="package-info-container">

        {{-- Main Heading --}}
        <h2>
            Discover the Types of Hajj Packages from Bangalore 2027
        </h2>

        <p>
            We at Al Bushra Tours &amp; Travels understand that
            <strong><a href="/hajj-packages-from-bangalore-2027">Hajj packages from Bangalore 2027</a></strong>
            go beyond just a travel experience. They are a spiritual
            experience that will change your soul and heart.
        </p>

        <p>
            We will assist you with visa requirements, accommodation,
            guide services and anything else you may need for your Umrah
            tour. Partner with Al Bushra Travels and Tours to discover
            holy sites of Makkah and Madinah. Let us guide you along this
            sacred route.
        </p>


        {{-- Affordable & Luxurious --}}
        <div class="package-info-block">

            <h2>
                Affordable and Luxurious Umrah Packages
            </h2>

            <p>
                Al Bushra Tours and Travels offers a wide range of
                <strong><a href="/hajj-packages-from-bangalore-2027">Hajj packages from Bangalore 2027</a></strong>
                for all types of travelers. No matter if you're traveling
                with couples, as you are with your family, or as a group,
                our services are able to accommodate your individual
                requirements.
            </p>

        </div>


        {{-- Budget --}}
        <div class="package-info-block">

            <h2>
                Budget Umrah Packages
            </h2>

            <p>
                If you are looking for a low-cost experience, our affordable
                Umrah packages provide important services for an affordable
                price. It's the cheapest Umrah package available, and,
                despite that, we will maintain the highest quality and
                credibility that our name has earned. The hotels are
                comfortable and enjoy a convenient shuttle service for
                Mosi al-Haram and indulge in delicious food. It's a perfect
                combination of convenience and affordability and will provide
                a satisfying Umrah experience without sacrificing the quality.
            </p>

        </div>


        {{-- Silver --}}
        <div class="package-info-block">

            <h2>
                Silver Umrah Package:
            </h2>

            <p>
                The Silver Umrah package strikes the ideal balance between
                the comfort of a stay and affordability. It is designed for
                pilgrims who want more convenience without the high price.
                It offers a comfortable stay near Masjid al-Haram within
                walking distance and includes all transport &amp; delicious
                food. Opting for
                <strong><a href="/hajj-packages-from-bangalore-2027">Hajj packages from Bangalore 2027</a></strong>
                would give you a more insightful experience. Ideal if you
                are looking for a budget-friendly and inclusive Umrah package.
            </p>

        </div>


        {{-- Family --}}
        <div class="package-info-block">

            <h2>
                Family Umrah Packages:
            </h2>

            <p>
                We have an Umrah package for families designed to ensure the
                best family-friendly experience. We are aware of the specific
                requirements of families traveling together, and our packages
                will ensure that everyone is taken care of.
            </p>

            <p>
                The vacation Umrah package is your ideal choice. This is why
                your family will become a part of Islam within the most
                stunning surroundings and become visitors to Allah. We are
                Al- Bushra Tours and Travels. We provide special Umrah
                holidays that are designed to give your family an unforgettable
                experience, particularly during school breaks, such as
                Christmas, Diwali, and summer holidays. We will let Makkah and
                Madinah help your children get closer to Allah by revealing
                the splendor in Islam in a manner that no other destination
                could.
            </p>

        </div>

    </div>

</section>

{{-- FAQ Section --}}

<section class="faq-section">

    <div class="faq-container">

        <h2 class="faq-title">
            FAQs
        </h2>

        <div class="faq-list">

            {{-- FAQ 1 --}}
            <details class="faq-item">

                <summary class="faq-question">
                    <span>
                        If my visa is rejected, will the embassy and visa fees be refundable?
                    </span>

                    <span class="faq-icon">+</span>
                </summary>

                <div class="faq-answer">
                    The embassy and visa fees are only for applying for a visa,
                    not to issue visas; therefore, fees cannot be refunded.
                </div>

            </details>


            {{-- FAQ 2 --}}
            <details class="faq-item">

                <summary class="faq-question">
                    <span>
                        How far will the hotel be from the holy sites?
                    </span>

                    <span class="faq-icon">+</span>
                </summary>

                <div class="faq-answer">
                    The distance between Haram, Masjid an-Nabawi and hotel
                    will depend on the packages you select. Please discuss
                    with our experts.
                </div>

            </details>


            {{-- FAQ 3 --}}
            <details class="faq-item">

                <summary class="faq-question">
                    <span>
                        How can I Choose the Right Umrah Package in 2027?
                    </span>

                    <span class="faq-icon">+</span>
                </summary>

                <div class="faq-answer">
                    By considering your budget, compare the packages, know
                    your requirements and understand the price.
                </div>

            </details>

        </div>

    </div>

</section>

@endsection

<style>
    /* =========================================
   HAJJ PACKAGE BANNER
========================================= */

.hajj-banner-section {
    width: 100%;
    background: #ffffff;

    padding: 0 0 30px;
}

.hajj-banner-container {
    width: 100%;
    max-width: 1100px;

    margin: 0 auto;
    padding: 0 7px;

    box-sizing: border-box;
}


/* =========================================
   H1
========================================= */

.hajj-banner-title {
    font-family: "Poppins", Sans-serif;
    color: #172f52;

    font-size: 40px;
    line-height: 1.2;

    font-weight: 600;

    text-align: center;

    margin: 0 0 32px;
    padding-top: 30px;
}


/* =========================================
   BANNER IMAGE
========================================= */

.hajj-banner-image {
    width: 100%;

    overflow: hidden;

    border-radius: 12px;
    box-shadow: 6px 8px 0px 0px #EC927E;
}

.hajj-banner-image img {
    width: 100%;
    height: auto;

    display: block;

    object-fit: contain;
}


/* =========================================
   TABLET
========================================= */

@media (max-width: 900px) {

    .hajj-banner-container {
        padding: 0 15px;
    }

    .hajj-banner-title {
        font-size: 34px;

        margin-bottom: 25px;
    }

}


/* =========================================
   MOBILE
========================================= */

@media (max-width: 600px) {

    .hajj-banner-section {
        padding-bottom: 25px;
    }

    .hajj-banner-container {
        padding: 0 12px;
    }

    .hajj-banner-title {
        font-size: 27px;

        line-height: 1.25;

        margin-bottom: 18px;
    }

    .hajj-banner-image {
        border-radius: 8px;
    }

}


/* =========================================
   SMALL MOBILE
========================================= */

@media (max-width: 400px) {

    .hajj-banner-title {
        font-size: 24px;
    }

}

/* =========================================
   WHY AL BUSHRA SECTION
========================================= */

.why-albushra-section {
    width: 100%;
    background: #ffffff;

    padding: 35px 0 30px;
}


.why-albushra-container {
    width: 100%;
    max-width: 1100px;

    margin: 0 auto;
    padding: 0 10px;

    box-sizing: border-box;
}


/* =========================================
   TOP INTRO
========================================= */

.why-albushra-intro {
    width: 100%;
    margin-bottom: 30px;
}


.why-albushra-intro h2 {
    font-family: "Poppins", Sans-serif;
    font-size: 36px;
    /* font-weight: 600; */
    line-height: 45px;
    /* letter-spacing: -0.1px; */
    color: #1A2B48;

    /* max-width: 950px; */
}


.why-albushra-intro p {
    color: #172f52;
    font-size: 16px;
    line-height: 1.55;
    margin: 0;
    font-weight: 400;

    /* max-width: 1080px; */
}


.why-albushra-intro strong {
    font-weight: 700;
}


/* =========================================
   MAIN TWO COLUMN
========================================= */

.why-albushra-main {
    display: grid;

    grid-template-columns: 1.05fr 0.95fr;

    gap: 55px;

    align-items: center;
}


/* =========================================
   LEFT CONTENT
========================================= */

.why-albushra-content {
    width: 100%;
}


.why-albushra-content > h2 {
    font-family: "Poppins", Sans-serif;
    font-size: 36px;
    /* font-weight: 600; */
    line-height: 45px;
    /* letter-spacing: -0.8px; */
    color: #1A2B48;
}


/* =========================================
   POINT
========================================= */

.why-point {
    margin-bottom: 25px;
}


.why-point:last-child {
    margin-bottom: 0;
}


.why-point h3 {
    color: #172f52;

    font-size: 24px;
    line-height: 1.3;

    font-weight: 500;

    margin: 10px 0 11px;
}


.why-point p {
    color: #172f52;
    font-size: 16px;
    line-height: 1.55;
    margin: 0;
    /* max-width: 570px; */
    font-weight: 400;

    max-width: 550px;/
}


/* =========================================
   IMAGE
========================================= */

.why-albushra-image {
    width: 100%;

    max-width: 300px;

    height: 450px;

    margin: auto;

    position: relative;

    border-radius: 8px 150px 8px 8px;

    overflow: visible;
}


/* Offset background/shadow */

.why-albushra-image::before {
    content: "";

    position: absolute;

    left: -12px;
    top: 12px;

    width: 100%;
    height: 100%;

    background: #c9a87c;

    border-radius: 8px 150px 8px 8px;

    z-index: 0;
}


.why-albushra-image img {
    position: relative;

    width: 100%;
    height: 100%;

    display: block;

    object-fit: cover;
    object-position: center;

    border-radius: 8px 150px 8px 8px;

    z-index: 1;
}


/* =========================================
   TABLET
========================================= */

@media (max-width: 900px) {

    .why-albushra-container {
        padding: 0 20px;
    }

    .why-albushra-main {
        gap: 30px;
    }

    .why-albushra-intro h2 {
        font-size: 25px;
    }

    .why-albushra-content > h2 {
        font-size: 25px;
    }

    .why-albushra-image {
        height: 360px;
        max-width: 280px;
    }

}


/* =========================================
   MOBILE
========================================= */

@media (max-width: 700px) {

    .why-albushra-section {
        padding: 35px 0 50px;
    }

    .why-albushra-container {
        padding: 0 16px;
    }


    .why-albushra-intro {
        margin-bottom: 30px;
    }


    .why-albushra-intro h2 {
        font-size: 24px;
        line-height: 1.3;
    }


    .why-albushra-intro p {
        font-size: 13px;
        line-height: 1.6;
    }


    .why-albushra-main {
        display: flex;
        flex-direction: column;

        gap: 30px;
    }


    .why-albushra-content {
        width: 100%;
    }


    .why-albushra-content > h2 {
        font-size: 24px;
    }


    .why-point {
        margin-bottom: 22px;
    }


    .why-point h3 {
        font-size: 18px;
    }


    .why-point p {
        font-size: 13px;
    }


    .why-albushra-image {
        width: 80%;
        max-width: 300px;

        height: 370px;

        margin: 10px auto 0;
    }

}


/* =========================================
   SMALL MOBILE
========================================= */

@media (max-width: 480px) {

    .why-albushra-container {
        padding: 0 14px;
    }

    .why-albushra-intro h2 {
        font-size: 22px;
    }

    .why-albushra-content > h2 {
        font-size: 22px;
    }

    .why-albushra-image {
        width: 82%;
        height: 340px;
    }

}

/* =========================================
   PACKAGE INFORMATION SECTION
========================================= */

.package-info-section {
    width: 100%;

    background: #ffffff;

    padding: 35px 0 55px;
}


.package-info-container {
    width: 100%;
    max-width: 1100px;

    margin: 0 auto;
    padding: 0 10px;

    box-sizing: border-box;
}


/* =========================================
   MAIN H1
========================================= */

.package-info-container > h2 {
    font-family: "Poppins", Sans-serif;
    font-size: 36px;
    /* font-weight: 600; */
    line-height: 45px;
    letter-spacing: -0.1px;
    color: #1A2B48;
}


/* =========================================
   PARAGRAPHS
========================================= */

.package-info-container p {
    color: #172f52;
    font-size: 16px;
    line-height: 1.55;
    margin: 0;
    /* max-width: 570px; */
    font-weight: 400;
}


.package-info-container strong {
    color: #0878d1;

    font-weight: 700;
}


/* =========================================
   CONTENT BLOCKS
========================================= */

.package-info-block {
    margin-top: 28px;
}


.package-info-block h2 {
    font-family: "Poppins", Sans-serif;
    font-size: 36px;
    /* font-weight: 600; */
    line-height: 45px;
    letter-spacing: -0.1px;
    color: #1A2B48;
}


/* Last paragraph */

.package-info-block p:last-child {
    margin-bottom: 0;
}


/* =========================================
   TABLET
========================================= */

@media (max-width: 900px) {

    .package-info-container {
        padding: 0 20px;
    }

    .package-info-container > h2 {
        font-size: 26px;
    }

    .package-info-block h2 {
        font-size: 20px;
    }

    .package-info-container p {
        font-size: 12.5px;
    }

}


/* =========================================
   MOBILE
========================================= */

@media (max-width: 600px) {

    .package-info-section {
        padding: 30px 0 45px;
    }

    .package-info-container {
        padding: 0 15px;
    }

    .package-info-container > h2 {
        font-size: 23px;
        line-height: 1.3;

        margin-bottom: 16px;
    }

    .package-info-container p {
        font-size: 13px;
        line-height: 1.65;

        text-align: left;
    }

    .package-info-block {
        margin-top: 25px;
    }

    .package-info-block h2 {
        font-size: 20px;
        line-height: 1.3;

        margin-bottom: 10px;
    }

}


/* =========================================
   SMALL MOBILE
========================================= */

@media (max-width: 400px) {

    .package-info-container {
        padding: 0 13px;
    }

    .package-info-container > h2{
        font-size: 21px;
    }

    .package-info-block h2 {
        font-size: 19px;
    }

    .package-info-container p {
        font-size: 12.5px;
    }

}
/* =========================================
   FAQ SECTION
========================================= */

.faq-section {
    width: 100%;
    background: #ffffff;

    padding: 0 0 50px;
}

.faq-container {
    width: 100%;
    max-width: 950px;

    margin: 0 auto;
    padding: 0 8px;

    box-sizing: border-box;
}


/* =========================================
   FAQ TITLE
========================================= */

.faq-title {
    color: #172f52;

    font-size: 38px;
    line-height: 1.2;

    font-weight: 700;

    text-align: center;

    margin: 0 0 32px;
}


/* =========================================
   FAQ LIST
========================================= */

.faq-list {
    width: 100%;
}


/* =========================================
   FAQ ITEM
========================================= */

.faq-item {
    width: 100%;

    margin-bottom: 18px;

    border-radius: 14px;

    overflow: hidden;
}


/* =========================================
   QUESTION
========================================= */

.faq-question {
    min-height: 68px;

    padding: 15px 55px 15px 25px;

    position: relative;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #3d6ff0;

    color: #ffffff;

    border-radius: 14px;

    cursor: pointer;

    list-style: none;

    font-size: 18px;
    font-weight: 700;

    text-align: center;

    box-sizing: border-box;

    transition: background 0.3s ease;
}


/* Remove default arrow */

.faq-question::-webkit-details-marker {
    display: none;
}

.faq-question::marker {
    display: none;
}


.faq-question:hover {
    background: #3263df;
}


/* =========================================
   PLUS ICON
========================================= */

.faq-icon {
    position: absolute;

    right: 25px;

    font-size: 26px;
    font-weight: 400;

    line-height: 1;

    transition: transform 0.3s ease;
}


/* Open = X */

.faq-item[open] .faq-icon {
    transform: rotate(45deg);
}


/* =========================================
   ANSWER
========================================= */

.faq-answer {
    background: #ffffff;
    margin-top: 10px;
    color: #111111;

    padding: 15px 15px 18px;

    font-size: 16px;
    line-height: 1.55;

    border-radius: 14px 14px 14px 14px;

    border-left:  1px solid #d7d9dc;
    border-right: 5px solid #d7d9dc;
    border-top: 1px solid #d7d9dc;
    border-bottom: 5px solid #d7d9dc;

    box-sizing: border-box;
}


/* =========================================
   MOBILE
========================================= */

@media (max-width: 600px) {

    .faq-section {
        padding-bottom: 40px;
    }

    .faq-container {
        padding: 0 10px;
    }

    .faq-title {
        font-size: 30px;

        margin-bottom: 25px;
    }

    .faq-item {
        margin-bottom: 14px;
    }

    .faq-question {
        min-height: 60px;

        padding: 12px 45px 12px 18px;

        font-size: 15px;
    }

    .faq-icon {
        right: 18px;

        font-size: 22px;
    }

    .faq-answer {
        padding: 14px 15px 16px;

        font-size: 14px;

        line-height: 1.55;
    }

}



</style>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(function (item) {

        item.addEventListener('toggle', function () {

            if (item.open) {

                faqItems.forEach(function (otherItem) {

                    if (otherItem !== item) {
                        otherItem.removeAttribute('open');
                    }

                });

            }

        });

    });

});
</script>