@extends('modules.admin.layouts.dashboard', [
    'activeTab' => 'dashboard',
])

@section('title', 'Dashboard - Pendaftaran Sertifikasi per Prodi')

@section('content')
    <section class="card" id="panel-dashboard">
        <div class="card-header">
            <div class="card-title">
                <h2>Dashboard</h2>
                <span>Ringkasan peserta pendaftaran sertifikasi per program studi</span>
            </div>
        </div>

        @if (! $tableExists)
            <p>
                Tabel pendaftaran sertifikasi belum tersedia. Jalankan migrasi database terlebih dahulu untuk melihat ringkasan data.
            </p>
        @elseif ($chartLabels->isEmpty())
            <p>Belum ada data pendaftaran sertifikasi yang dapat ditampilkan.</p>
        @else
            <div style="padding: 12px 6px 6px;">
                <canvas id="prodiRegistrationChart" aria-label="Diagram batang jumlah peserta per prodi" role="img"></canvas>
            </div>
        @endif
    </section>

    @if ($tableExists && $chartLabels->isNotEmpty())
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const ctx = document.getElementById('prodiRegistrationChart');

                if (!ctx) return;

                const chartLabels = @json($chartLabels->values());
                const chartValues = @json($chartValues->values());

                const maxParticipants = chartValues.length
                    ? Math.max(...chartValues)
                    : 0;
                const suggestedMax = Math.max(10, maxParticipants + 1);

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: chartLabels,
                        datasets: [
                            {
                                label: 'Jumlah Peserta',
                                data: chartValues,
                                backgroundColor: '#1f4db1',
                                borderRadius: 10,
                                barThickness: 38,
                            },
                        ],
                    },
                    options: {
                        scales: {
                            x: {
                                ticks: {
                                    color: '#24345a',
                                    font: {
                                        size: 13,
                                        family: 'Instrument Sans, system-ui',
                                    },
                                },
                                grid: {
                                    display: false,
                                },
                            },
                            y: {
                                beginAtZero: true,
                                max: suggestedMax,
                                ticks: {
                                    stepSize: 1,
                                    color: '#24345a',
                                },
                                grid: {
                                    color: 'rgba(31, 77, 177, 0.08)',
                                },
                            },
                        },
                        plugins: {
                            legend: {
                                display: false,
                            },
                            tooltip: {
                                callbacks: {
                                    label: (context) => `${context.parsed.y} peserta`,
                                },
                            },
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                        layout: {
                            padding: {
                                top: 16,
                            },
                        },
                    },
                });
            });
        </script>
    @endif
@endsection
