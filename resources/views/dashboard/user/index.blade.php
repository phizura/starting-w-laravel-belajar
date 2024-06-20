@extends('dashboard.layouts.main')

@section('container')
    <nav class="mt-3">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="tab-nav-admin" data-bs-toggle="tab" data-bs-target="#tab-admin" type="button"
                role="tab" aria-controls="tab-admin" aria-selected="true">Admins</button>
            <button class="nav-link" id="tab-nav-member" data-bs-toggle="tab" data-bs-target="#tab-member" type="button"
                role="tab" aria-controls="tab-member" aria-selected="false">Members</button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="tab-admin" role="tabpanel" aria-labelledby="tab-nav-admin">
            @include('dashboard.user.admin')
        </div>
        <div class="tab-pane fade" id="tab-member" role="tabpanel" aria-labelledby="tab-nav-member">
            @include('dashboard.user.member')
        </div>
    </div>

    <form id="form-role" method="POST">
        @method('put')
        @csrf
        <input type="hidden" id="type" name="type" value="">
    </form>

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

    <script>
        function changeRole(id, type) {
            const form = document.getElementById('form-role');
            const input = document.getElementById('type');

            form.setAttribute('action', `/dashboard/users/${id}`);
            input.value = type;

            const role = type === 'promote' ? 'admin' : 'member'

            Swal.fire({
                title: "Are you sure?",
                text: `Yakin ${type} member menjadi ${role}?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: type + " user",
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }

    </script>
@endsection
