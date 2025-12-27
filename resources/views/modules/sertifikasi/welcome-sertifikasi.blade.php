@extends('layouts.guest')

@section('title', 'Portal Pendaftaran Sertifikasi')

@php
    $flowSteps = collect($flowSteps ?? []);
@endphp

@push('styles')
    <style>
:root {
                color-scheme: light;
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: flex-start;
                font-family: "Instrument Sans", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
                background: linear-gradient(180deg, #f3f7ff 0%, #f9fbff 48%, #ffffff 100%);
                color: #000000;
                padding: clamp(40px, 6vw, 72px) clamp(16px, 6vw, 40px);
            }

            .page-wrapper {
                width: min(960px, 100%);
                background: #ffffff;
                border-radius: 28px;
                border: 1px solid rgba(93, 123, 214, 0.18);
                box-shadow: 0 30px 70px rgba(28, 42, 74, 0.08);
                overflow: hidden;
            }

            header {
                padding: clamp(40px, 6vw, 56px) clamp(32px, 6vw, 80px) clamp(24px, 4vw, 32px);
                text-align: center;
                background: linear-gradient(180deg, rgba(226, 233, 255, 0.65) 0%, rgba(255, 255, 255, 0) 100%);
                border-bottom: 1px solid rgba(93, 123, 214, 0.12);
            }

            header h1 {
                margin: 0 0 14px;
                font-size: clamp(2rem, 4.5vw, 2.7rem);
                font-weight: 600;
                color: #000000;
                letter-spacing: -0.02em;
            }

            header p {
                margin: 0 auto;
                max-width: 720px;
                font-size: clamp(1rem, 2vw, 1.05rem);
                line-height: 1.65;
                color: #000000;
            }

            .main-card {
                padding: clamp(32px, 5vw, 52px) clamp(32px, 6vw, 80px);
                display: grid;
                gap: clamp(32px, 6vw, 60px);
            }

            .link-block {
                display: grid;
                gap: 16px;
            }

            .card-title {
                font-size: clamp(1.4rem, 2.8vw, 1.68rem);
                font-weight: 600;
                color: #000000;
                text-decoration: underline;
                text-decoration-thickness: 2px;
                text-underline-offset: 6px;
            }

            .card-button {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                border: none;
                background: linear-gradient(135deg, #3068ff 0%, #1f49e0 100%);
                color: #ffffff;
                font-weight: 600;
                font-size: 0.95rem;
                padding: 12px 26px;
                border-radius: 999px;
                text-decoration: none;
                box-shadow: 0 12px 24px rgba(41, 104, 246, 0.22);
                transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
                width: fit-content;
            }

            .card-button:hover,
            .card-button:focus {
                transform: translateY(-2px);
                box-shadow: 0 14px 28px rgba(31, 73, 224, 0.26);
                background: linear-gradient(135deg, #2a5cea 0%, #1a3fba 100%);
            }

            .secondary-link {
                color: #000000;
                font-weight: 600;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 8px;
            }

            .secondary-link:hover,
            .secondary-link:focus {
                color: #000000;
                text-decoration: underline;
            }

            .flow-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: clamp(24px, 5vw, 48px);
                padding-top: clamp(16px, 3vw, 28px);
            }

            .flow-card {
                display: grid;
                gap: clamp(20px, 4vw, 32px);
                position: relative;
                z-index: 1;
            }

            .flow-card h3 {
                margin: 0;
                font-size: 1.08rem;
                font-weight: 600;
                color: #000000;
            }

            .flow-diagram {
                margin: 0;
                padding: clamp(18px, 3vw, 28px);
                background: linear-gradient(135deg, rgba(14, 165, 233, 0.08) 0%, rgba(59, 130, 246, 0.06) 100%);
                border-radius: clamp(24px, 4vw, 32px);
                border: 1px solid rgba(22, 78, 99, 0.18);
                box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4);
                display: grid;
                gap: clamp(18px, 3vw, 28px);
            }

            .timeline {
                list-style: none;
                margin: 0;
                padding: 0;
                display: grid;
                gap: clamp(18px, 3vw, 28px);
            }

            .timeline-step {
                position: relative;
                display: flex;
                align-items: flex-start;
                gap: clamp(16px, 3vw, 28px);
                padding: clamp(18px, 3vw, 26px);
                border-radius: clamp(20px, 3vw, 28px);
                background: #ffffff;
                border: 1px solid rgba(30, 64, 175, 0.08);
                box-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
                transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s ease;
            }

            .timeline-step:hover,
            .timeline-step:focus-within {
                transform: translateY(-3px);
                box-shadow: 0 22px 44px rgba(31, 73, 224, 0.16);
                border-color: rgba(59, 130, 246, 0.22);
            }

            .timeline-step:focus-within {
                outline: none;
                box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.16), 0 22px 44px rgba(31, 73, 224, 0.16);
            }

            .step-badge {
                flex-shrink: 0;
                width: clamp(56px, 6vw, 72px);
                aspect-ratio: 1 / 1;
                border-radius: 50%;
                display: grid;
                place-items: center;
                color: #ffffff;
                font-size: clamp(1.35rem, 3.2vw, 1.6rem);
                font-weight: 700;
                position: relative;
                background: linear-gradient(180deg, #2563eb 0%, #1d4ed8 100%);
                box-shadow: inset 0 0 0 2px rgba(255, 255, 255, 0.25), 0 16px 32px rgba(37, 99, 235, 0.26);
            }

            .step-badge::after {
                content: "";
                position: absolute;
                inset: -12%;
                border-radius: 50%;
                background: radial-gradient(circle at top right, rgba(59, 130, 246, 0.12), transparent 65%);
                z-index: -1;
            }

            .timeline li:nth-child(2) .step-badge {
                background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 48%, #0369a1 100%);
                box-shadow: inset 0 0 0 2px rgba(255, 255, 255, 0.25), 0 16px 32px rgba(14, 165, 233, 0.22);
            }

            .timeline li:nth-child(3) .step-badge {
                background: linear-gradient(135deg, #14b8a6 0%, #0d9488 50%, #0f766e 100%);
                box-shadow: inset 0 0 0 2px rgba(255, 255, 255, 0.25), 0 16px 32px rgba(20, 184, 166, 0.22);
            }

            .step-content {
                display: grid;
                gap: clamp(6px, 1.8vw, 12px);
            }

            .step-heading {
                margin: 0;
                font-size: clamp(1.05rem, 2.2vw, 1.22rem);
                font-weight: 600;
                color: #0f172a;
            }

            .step-description {
                margin: 0;
                font-size: clamp(0.92rem, 1.8vw, 1rem);
                line-height: 1.6;
                color: rgba(15, 23, 42, 0.78);
            }

            .step-meta {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                margin-top: clamp(6px, 1.4vw, 10px);
                font-size: clamp(0.82rem, 1.6vw, 0.92rem);
                font-weight: 600;
                color: rgba(37, 99, 235, 0.96);
            }

            .step-link {
                color: inherit;
                text-decoration: none;
                display: inline-flex;
                align-items: baseline;
                gap: 6px;
                cursor: pointer;
            }

            .step-heading.step-link {
                display: inline-block;
                gap: 0;
            }

            .step-meta.step-link {
                align-items: center;
            }

            .step-link:hover,
            .step-link:focus-visible {
                text-decoration: underline;
            }

            .step-link:focus-visible {
                outline: none;
            }

            .step-actions {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                margin-top: clamp(10px, 2vw, 14px);
            }

            .support-box {
                padding: clamp(18px, 3vw, 24px);
                border-radius: clamp(18px, 3vw, 24px);
                background: rgba(59, 130, 246, 0.06);
                border: 1px solid rgba(59, 130, 246, 0.28);
                display: grid;
                gap: 6px;
            }

            .support-box strong {
                font-size: clamp(0.95rem, 1.8vw, 1.05rem);
                font-weight: 600;
                color: #0f172a;
            }

            .support-box p {
                margin: 0;
                font-size: clamp(0.88rem, 1.6vw, 0.96rem);
                color: rgba(15, 23, 42, 0.78);
            }

            .empty-flow-message {
                margin: 0;
                padding: clamp(18px, 3vw, 26px);
                border-radius: clamp(18px, 3vw, 24px);
                border: 1px dashed rgba(59, 130, 246, 0.4);
                background: rgba(255, 255, 255, 0.8);
                font-weight: 500;
                color: rgba(15, 23, 42, 0.74);
                text-align: center;
            }

            .visually-hidden {
                position: absolute;
                width: 1px;
                height: 1px;
                padding: 0;
                margin: -1px;
                overflow: hidden;
                clip: rect(0, 0, 0, 0);
                white-space: nowrap;
                border: 0;
            }

            footer {
                text-align: center;
                padding: 0 24px 40px;
                color: #000000;
                font-size: 0.85rem;
            }

            @media (max-width: 720px) {
                body {
                    padding: 32px 16px;
                }

                header {
                    padding: 32px 20px 18px;
                }

                .main-card {
                    padding: 28px 20px 36px;
                }

                .flow-diagram {
                    padding: clamp(16px, 6vw, 24px);
                }
            }
    </style>
@endpush

@section('content')
<div class="page-wrapper">
            <header>
                <h1>Portal Pendaftaran Sertifikasi</h1>
                <p>
                    Dapatkan sertifikasi profesional untuk menguatkan kompetensi, portofolio, dan jenjang karier Anda.
                </p>
            </header>

            <main class="main-card">
                <div class="flow-grid">
                    <div class="flow-card">
                        <h3>Alur Pendaftaran Sertifikasi</h3>
                        <div class="flow-diagram">
                            @if ($flowSteps->isNotEmpty())
                                <ol class="timeline" role="list">
                                    @foreach ($flowSteps as $step)
                                        @php
                                            $stepSequence = (int) ($step->sequence ?? $loop->iteration);
                                            $stepNumber = str_pad((string) $stepSequence, 2, '0', STR_PAD_LEFT);
                                            $link = $step->link;
                                            $openInNewTab = $link && (str_starts_with($link, 'http://') || str_starts_with($link, 'https://'));
                                        @endphp
                                        <li>
                                            <div class="timeline-step">
                                                <span class="step-badge">{{ $stepNumber }}</span>
                                                <div class="step-content">
                                                    <h4 class="step-heading">{{ $step->title }}</h4>
                                                    <p class="step-description">{!! nl2br(e($step->description)) !!}</p>
                                                    @if ($link)
                                                        <a
                                                            class="step-meta step-link"
                                                            href="{{ $link }}"
                                                            @if ($openInNewTab) target="_blank" rel="noopener" @endif
                                                        >
                                                            ➡️ Buka tautan pendukung
                                                        </a>
                                                    @endif
                                                    @if ($stepSequence === 3)
                                                        <div class="step-actions">
                                                            <a class="card-button" href="{{ route('pendaftaran.sertifikasi') }}">
                                                                Daftar Sertifikasi
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ol>
                            @else
                                <p class="empty-flow-message">
                                    Konten alur sertifikasi akan segera diumumkan. Silakan cek kembali secara berkala.
                                </p>
                            @endif

                            <div class="support-box">
                                <strong>Hanya bila diperlukan</strong>
                                <p>
                                    Masih kesulitan? Hubungi helpdesk melalui email di atas atau WhatsApp resmi panitia untuk
                                    mendapatkan bantuan teknis pendaftaran.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <footer>
                &copy; {{ date('Y') }} Program Kompetisi &amp; Sertifikasi
            </footer>
        </div>
@endsection
