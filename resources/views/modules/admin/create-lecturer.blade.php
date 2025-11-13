@extends('modules.admin.layouts.dashboard', [
    'activeTab' => 'dosen',
])

@section('title', 'Buat Akun Dosen - Dashboard Admin')

@section('content')
    @include('modules.admin.sections.buat-akun-dosen')
@endsection
