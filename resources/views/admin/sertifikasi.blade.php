@php
    $tableExists = $tableExists ?? ($sertifikasiTableExists ?? true);
    $registrations = $registrations ?? ($sertifikasiRegistrations ?? collect());
@endphp

@extends('admin.layouts.dashboard', [
    'activeTab' => 'sertifikasi',
])

@section('title', 'Data Pendaftaran Sertifikasi - Dashboard Admin')

@section('content')
    @include('admin.sections.data-sertifikasi', [
        'tableExists' => $tableExists,
        'registrations' => $registrations,
        'panelId' => 'panel-sertifikasi',
    ])
@endsection
