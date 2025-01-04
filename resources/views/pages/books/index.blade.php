@extends('template')

@section('title', 'Data Buku')

@section('content')
    <div class="container-fluid">
        @include('partials.alert')

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0 text-gray-800">Data Buku</h1>

            <a href="/books/create" class="btn btn-primary">+ Tambah</a>
        </div>

        @include('pages.books.table')
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        const onDeleteBook = async (event) => {
            const form = event.target.parentElement.querySelector('[data-for="DELETE"]');

            const {
                isConfirmed
            } = await Swal.fire({
                title: 'Apakah Anda yakin untuk menghapus data ini?',
                text: 'Data yang sudah dihapus tidak dapat dikembalikan.',
                icon: 'question',
                showCancelButton: true,
            });

            form.submit();
        }
    </script>
@endpush
