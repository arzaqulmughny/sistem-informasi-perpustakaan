@extends('template')

@section('title', 'Daftar Peminjaman')

@section('content')
    <div class="container-fluid">
        @include('partials.alert')

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0 text-gray-800">Daftar Peminjaman</h1>

            <a href="/loans/create" class="btn btn-primary">+ Peminjaman</a>
        </div>

        @include('pages.loans.table')
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script></script>
@endpush
