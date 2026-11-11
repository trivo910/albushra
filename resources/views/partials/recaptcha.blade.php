@if (config('services.recaptcha.enabled'))
    <input type="hidden" name="recaptcha_token" value="" data-recaptcha-action="{{ $action }}">
    @error('recaptcha')
        <p data-recaptcha-error class="text-sm" style="color: #b3261e;" role="alert">{{ $message }}</p>
    @else
        <p data-recaptcha-error class="text-sm" style="color: #b3261e;" role="alert" hidden>Please verify your submission and try again.</p>
    @enderror
@endif
