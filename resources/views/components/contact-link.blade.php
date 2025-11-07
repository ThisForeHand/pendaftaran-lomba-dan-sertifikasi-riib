@props(['value'])

@php
    $text = trim((string) ($value ?? ''));
    $href = null;

    if ($text !== '') {
        $lower = \Illuminate\Support\Str::of($text)->lower();

        if ($lower->startsWith(['http://', 'https://'])) {
            $href = $text;
        } elseif ($lower->startsWith('www.')) {
            $href = 'https://' . ltrim($text, '/');
        } else {
            $digits = preg_replace('/\D+/', '', $text);

            if ($digits !== '') {
                $normalized = ltrim($digits, '0');
                if ($normalized === '') {
                    $normalized = $digits;
                }

                if (! \Illuminate\Support\Str::startsWith($normalized, '62')) {
                    $normalized = '62' . $normalized;
                }

                $href = 'https://wa.me/' . $normalized;
            }
        }
    }
@endphp

@if ($href)
    <a
        href="{{ $href }}"
        class="contact-link"
        target="_blank"
        rel="noopener noreferrer"
    >
        {{ $value }}
    </a>
@else
    {{ $value }}
@endif
