@extends('admin.layouts.dashboard', [
    'activeTab' => 'dosen',
])

@section('title', 'Buat Akun Dosen - Dashboard Admin')

@section('content')
    @include('admin.sections.buat-akun-dosen')
@endsection
