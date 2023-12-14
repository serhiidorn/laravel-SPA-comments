<?php

declare(strict_types=1);

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class Recaptcha implements ValidationRule
{
    /**
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $response = Http::asForm()->post(config('services.recaptcha.verify_url'), [
            'secret' => config('services.recaptcha.secret'),
            'response' => $value,
        ]);

        if (! $response->json('success') || $response->json('score') < 0.5) {
            $fail('Captcha is invalid.');
        }
    }
}
