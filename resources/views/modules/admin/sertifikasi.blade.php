@php
    $tableExists = $tableExists ?? ($sertifikasiTableExists ?? true);
    $registrations = $registrations ?? ($sertifikasiRegistrations ?? collect());
@endphp

@extends('modules.admin.layouts.dashboard', [
    'activeTab' => 'sertifikasi',
])

@section('title', 'Data Pendaftaran Sertifikasi - Dashboard Admin')

@section('content')
    @include('modules.admin.sections.data-sertifikasi', [
        'tableExists' => $tableExists,
        'registrations' => $registrations,
        'panelId' => 'panel-sertifikasi',
    ])
@endsection
