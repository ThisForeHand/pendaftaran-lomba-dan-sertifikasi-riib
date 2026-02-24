@extends('layouts.guest')

@section('title', 'Portal Paper Reading Club')

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
                padding: clamp(18px, 3vw, 28px);
                border-radius: clamp(22px, 3vw, 30px);
                border: 1px solid rgba(22, 78, 99, 0.18);
                background: linear-gradient(135deg, rgba(14, 165, 233, 0.08) 0%, rgba(59, 130, 246, 0.06) 100%);
                box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4);
                display: grid;
                gap: clamp(18px, 3vw, 28px);
            }

            .timeline {
                list-style: none;
                margin: 0;
                padding: 0;
                display: grid;
                gap: clamp(14px, 2.5vw, 22px);
            }

            .timeline-step {
                display: grid;
                grid-template-columns: min-content 1fr;
                gap: clamp(12px, 2vw, 18px);
                padding: clamp(16px, 2.8vw, 22px);
                border-radius: clamp(18px, 3vw, 24px);
                background: #ffffff;
                border: 1px solid rgba(30, 64, 175, 0.08);
                box-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
                position: relative;
                overflow: hidden;
            }

            .timeline-step::after {
                content: "";
                position: absolute;
                inset: -12% 65% auto -12%;
                background: radial-gradient(circle at top right, rgba(59, 130, 246, 0.08), transparent 65%);
                z-index: 0;
            }

            .step-badge {
                width: clamp(44px, 5vw, 52px);
                height: clamp(44px, 5vw, 52px);
                border-radius: 50%;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                font-weight: 700;
                font-size: 1rem;
                color: #ffffff;
                background: linear-gradient(180deg, #2563eb 0%, #1d4ed8 100%);
                box-shadow: inset 0 0 0 2px rgba(255, 255, 255, 0.25), 0 16px 32px rgba(37, 99, 235, 0.35);
                position: relative;
                z-index: 1;
            }

            .timeline li:nth-child(2) .step-badge {
                background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 48%, #0369a1 100%);
            }

            .timeline li:nth-child(3) .step-badge {
                background: linear-gradient(135deg, #14b8a6 0%, #0d9488 50%, #0f766e 100%);
            }

            .step-content {
                display: grid;
                gap: clamp(6px, 1.6vw, 12px);
                position: relative;
                z-index: 1;
            }

            .step-heading {
                margin: 0;
                font-size: clamp(1.05rem, 2.2vw, 1.22rem);
                font-weight: 600;
                color: #0f172a;
            }

            .step-description {
                margin: 0;
                font-size: clamp(0.9rem, 1.8vw, 1rem);
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

            .empty-flow-message {
                margin: 0;
                padding: clamp(18px, 3vw, 24px);
                border-radius: clamp(18px, 3vw, 24px);
                border: 1px dashed rgba(59, 130, 246, 0.4);
                background: rgba(255, 255, 255, 0.8);
                color: rgba(15, 23, 42, 0.75);
                font-weight: 500;
                text-align: center;
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
            }
    </style>
@endpush

@section('content')
<div class="page-wrapper">
            <header>
                <h1>Portal Paper Reading Club</h1>
                <p>
                    Jelajahi informasi kegiatan Paper Reading Club yang sedang dibuka dan lengkapi seluruh persyaratan
                    agar proses pendaftaran berjalan lancar.
                </p>
            </header>

            <main class="main-card">
                <div class="flow-grid">
                    <div class="flow-card">
                        <h3>Alur Paper Reading Club</h3>
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
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ol>
                            @else
                                <p class="empty-flow-message">
                                    Konten alur pendaftaran akan segera tersedia. Silakan cek kembali atau hubungi admin.
                                </p>
                            @endif

                            <div class="support-box">
                                <strong>Butuh bantuan?</strong>
                                <p>
                                    Silakan koordinasi dengan dosen pembina atau hubungi helpdesk Paper Reading Club untuk memastikan
                                    seluruh berkas sudah lengkap sebelum batas waktu.
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
