@extends('layouts.main')

@section('content')
    <h1 class="mb-5">Post Categories</h1>

    <div class="container">
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-md-4">
                    <div class="card bg-dark text-white">
                        <img src="https://picsum.photos/500/400?{{ $category->name }}" class="card-img"
                            alt="...">
                        <a href="/posts?category={{ $category->slug }}" class="text-light">
                            <div class="card-img-overlay d-flex align-items-center p-0">
                                <h5 class="card-title text-center flex-fill p-4 fs-3"
                                    style="background-color: rgba(0, 0, 0, 0.7)">
                                    {{ $category->name }}
                                </h5>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
