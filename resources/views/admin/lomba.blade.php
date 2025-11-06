@php
    $tableExists = $tableExists ?? ($lombaTableExists ?? true);
    $registrations = $registrations ?? ($lombaRegistrations ?? collect());
@endphp

@extends('admin.layouts.dashboard', [
    'activeTab' => 'lomba',
])

@section('title', 'Data Pendaftaran Lomba - Dashboard Admin')

@section('content')
    @include('admin.sections.data-lomba', [
        'tableExists' => $tableExists,
        'registrations' => $registrations,
        'panelId' => 'panel-lomba',
    ])
@endsection
