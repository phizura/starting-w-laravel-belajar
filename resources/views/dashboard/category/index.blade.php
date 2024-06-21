{{-- @dd(session()) --}}
@extends('dashboard.layouts.main') @section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Post Categories</h1>
    </div>
    {{-- {{ session('success') }} --}}
    @if (session()->has('success'))
        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                Swal.fire({
                    title: "Berhasil!",
                    text: "{{ session('success') }}",
                    icon: "success"
                });
            })
        </script>
    @endif

    @if (session()->has('error'))
        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                Swal.fire({
                    title: "Gagal!",
                    text: "{{ session('error') }}",
                    icon: "error"
                });
            })
        </script>
    @endif

    @if (session()->has('warning'))
        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                Swal.fire({
                    title: "Attention!",
                    text: "{{ session('warning') }}",
                    icon: "warning"
                });
            })
        </script>
    @endif

    <div class="table-responsive col-md-6">
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CreateModal">
                Add Category
            </button>

            <div class="modal fade @if ($errors->any()) show-modal @endif" id="CreateModal" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="CreateModalLabel">
                                Form Add Category
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/dashboard/categories" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="col-form-label">
                                        Name
                                    </label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" required autofocus />
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">
                                    Add
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="/dashboard/categories/{{ $category->slug }}/edit" class="badge bg-warning"><span
                                    data-feather="edit"></span></a>
                            <form action="/dashboard/categories/{{ $category->slug }}" method="POST"
                                class="d-inline del-confirm-form" id="swal-submit-form">
                                @method('delete')
                                @csrf
                                <button type="button" class="badge bg-danger border-0 del-confirm-btn"
                                    id="swal-button-category">
                                    <span data-feather="x-circle"></span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (document.querySelector('.show-modal')) {
                var myModal = new bootstrap.Modal(document.getElementById('CreateModal'));
                myModal.show();
            }
        });
    </script>
@endsection
