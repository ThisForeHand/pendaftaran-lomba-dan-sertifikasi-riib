@php
    $tableExists = $tableExists ?? ($lombaTableExists ?? true);
    $registrations = $registrations ?? ($lombaRegistrations ?? collect());
@endphp

@extends('modules.admin.layouts.dashboard', [
    'activeTab' => 'lomba',
])

@section('title', 'Data Pendaftaran Lomba - Dashboard Admin')

@section('content')
    @include('modules.admin.sections.data-lomba', [
        'tableExists' => $tableExists,
        'registrations' => $registrations,
        'panelId' => 'panel-lomba',
    ])
@endsection
