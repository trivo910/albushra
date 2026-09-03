@php
    $__settings = \App\Models\Setting::current();
    $__waNumber = preg_replace('/\D/', '', $__settings->whatsapp_number ?? '');
    $__waGreeting = $__settings->whatsapp_greeting ?: 'Hello 👋 Can we help you?';
@endphp
@if ($__waNumber)
    <div data-whatsapp-widget class="fixed bottom-5 right-5 z-50 flex flex-col items-end gap-3 font-poppins">
        <div data-whatsapp-bubble class="hidden max-w-[260px] bg-white rounded-2xl rounded-br-sm p-4 relative"
             style="box-shadow: 0 12px 30px -10px rgba(26,43,72,0.3);">
            <button type="button" data-whatsapp-bubble-close aria-label="Close"
                    class="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-white flex items-center justify-center"
                    style="box-shadow: 0 2px 8px rgba(26,43,72,0.2);">
                <svg width="12" height="12" viewBox="0 0 12 12"><path d="M1 1l10 10M11 1L1 11" stroke="#1A2B48" stroke-width="1.5" stroke-linecap="round"/></svg>
            </button>
            <p class="text-sm" style="color: var(--p-navy);">{{ $__waGreeting }}</p>
        </div>

        <a href="https://wa.me/{{ $__waNumber }}?text={{ urlencode($__waGreeting) }}" target="_blank" rel="noopener"
           aria-label="Chat on WhatsApp"
           class="w-14 h-14 rounded-full flex items-center justify-center"
           style="background: #25d366; box-shadow: 0 8px 20px -4px rgba(37,211,102,0.6);">
            <svg width="28" height="28" viewBox="0 0 32 32" fill="#fff"><path d="M16.001 3C9.373 3 4 8.373 4 15c0 2.362.688 4.564 1.875 6.417L4 29l7.771-1.834A11.94 11.94 0 0016.001 27C22.628 27 28 21.627 28 15S22.628 3 16.001 3zm0 21.75a9.7 9.7 0 01-4.95-1.35l-.355-.21-4.615 1.09 1.11-4.5-.232-.368A9.7 9.7 0 016.25 15c0-5.38 4.372-9.75 9.751-9.75S25.75 9.62 25.75 15 21.38 24.75 16.001 24.75zm5.34-7.29c-.293-.147-1.734-.856-2.003-.954-.269-.098-.465-.147-.66.147-.196.293-.758.954-.929 1.15-.171.196-.343.22-.636.073-.293-.147-1.236-.455-2.354-1.452-.87-.776-1.458-1.734-1.629-2.027-.171-.293-.018-.451.128-.598.132-.131.293-.343.44-.514.147-.171.196-.293.293-.489.098-.196.049-.367-.024-.514-.073-.147-.66-1.591-.905-2.179-.238-.572-.48-.494-.66-.503l-.562-.01a1.08 1.08 0 00-.783.367c-.269.293-1.028 1.005-1.028 2.45 0 1.446 1.052 2.843 1.199 3.04.147.196 2.07 3.16 5.017 4.432.701.303 1.248.484 1.675.62.704.224 1.344.192 1.85.117.564-.084 1.734-.709 1.979-1.393.244-.685.244-1.272.171-1.394-.073-.122-.269-.196-.562-.343z"/></svg>
        </a>
    </div>
@endif
