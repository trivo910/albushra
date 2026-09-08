@extends('layouts.public')

@php
    $seoTitle = 'FAQs | '.(\App\Models\Setting::current()->site_name ?? config('app.name'));
    $seoDescription = 'Frequently asked questions about booking Hajj and Umrah packages.';
@endphp

@section('content')
    <x-page-hero image="public/contact/5-(2).png" title="FAQs" />

    <section class="faqs-section">

        <div class="faqs-container">

            <div class="faqs-heading">
                <h2 class="faqs-title">Everything You Need to Know</h2>
                <p class="faqs-subtitle">This comprehensive FAQ guide covers every aspect of your pilgrimage, ensuring you're well-prepared for every step of the way.</p>
            </div>

            @if ($faqs->isEmpty())

                <div class="text-center py-16">
                    <p class="font-poppins font-medium mb-1" style="color: var(--p-navy);">No FAQs published yet</p>
                    <p class="text-sm" style="color: var(--p-grey);">Have a question? <a href="{{ route('contact.index') }}" style="color: var(--p-primary);">Get in touch</a>.</p>
                </div>

            @else

                <div class="faqs-grid">

                    @foreach ($faqs as $faq)

                        <details class="faqs-card">

                            <summary class="faqs-card-question">
                                <span class="faqs-card-icon">+</span>
                                <span class="faqs-card-text">{{ $faq->question }}</span>
                            </summary>

                            <p class="faqs-card-answer">{{ $faq->answer }}</p>

                        </details>

                    @endforeach

                </div>

            @endif

        </div>

    </section>
@endsection

<style>

/* =========================================
   FAQS SECTION
========================================= */

.faqs-section {
    width: 100%;
    background: #ffffff;
    padding: 60px 0 70px;
}

.faqs-container {
    width: 100%;
    max-width: 1150px;

    margin: 0 auto;
    padding: 0 20px;
}


/* =========================================
   HEADING
========================================= */

.faqs-heading {
    max-width: 720px;

    margin: 0 auto 45px;

    text-align: center;
}

.faqs-title {
    font-family: "Poppins", sans-serif;
    font-size: 36px;
    font-weight: 700;
    line-height: 1.25;
    letter-spacing: -0.6px;

    color: #1A2B48;

    margin: 0 0 14px;
}

.faqs-subtitle {
    font-size: 16px;
    line-height: 1.6;

    color: #5e6d77;

    margin: 0;
}


/* =========================================
   GRID
========================================= */

.faqs-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;

    align-items: start;
}


/* =========================================
   CARD
========================================= */

.faqs-card {
    background: #ffffff;

    border: 1px solid #eef0f3;
    border-radius: 14px;

    box-shadow: 0 5px 18px rgba(26, 43, 72, 0.08);

    transition: box-shadow 0.25s ease;
}

.faqs-card:hover {
    box-shadow: 0 10px 28px rgba(26, 43, 72, 0.12);
}

.faqs-card-question {
    display: flex;
    align-items: flex-start;
    gap: 16px;

    padding: 20px 22px;

    cursor: pointer;
    list-style: none;
}

.faqs-card-question::-webkit-details-marker {
    display: none;
}

.faqs-card-question::marker {
    display: none;
}


/* =========================================
   PLUS ICON
========================================= */

.faqs-card-icon {
    flex-shrink: 0;

    width: 30px;
    height: 30px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 8px;

    background: var(--p-light-grey);
    color: #1A2B48;

    font-size: 18px;
    font-weight: 600;
    line-height: 1;

    transition:
        transform 0.25s ease,
        background-color 0.25s ease,
        color 0.25s ease;
}

.faqs-card[open] .faqs-card-icon {
    transform: rotate(45deg);

    background: var(--p-primary);
    color: #ffffff;
}


/* =========================================
   QUESTION TEXT
========================================= */

.faqs-card-text {
    font-size: 17px;
    font-weight: 600;
    line-height: 1.4;

    color: #1A2B48;

    padding-top: 3px;
}


/* =========================================
   ANSWER
========================================= */

.faqs-card-answer {
    margin: 0;

    padding: 0 22px 22px 68px;

    font-size: 14.5px;
    line-height: 1.7;

    color: #5e6d77;
}


/* =========================================
   TABLET
========================================= */

@media (max-width: 900px) {

    .faqs-grid {
        grid-template-columns: 1fr;
    }

}


/* =========================================
   MOBILE
========================================= */

@media (max-width: 600px) {

    .faqs-section {
        padding: 45px 0 50px;
    }

    .faqs-title {
        font-size: 26px;
    }

    .faqs-subtitle {
        font-size: 14px;
    }

    .faqs-card-question {
        padding: 16px 18px;
        gap: 12px;
    }

    .faqs-card-text {
        font-size: 15px;
    }

    .faqs-card-answer {
        padding: 0 18px 18px 58px;
    }

}

</style>
