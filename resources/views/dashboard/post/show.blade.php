@extends('dashboard.layouts.main')

@section('container')
    <div class="container">
        <div class="row my-3">
            <div class="col-lg-8">
                <h1 class="mb-3">{{ $post->title }}</h1>

                <a href="/dashboard/posts" class="btn btn-success"><span data-feather="arrow-left"></span> Back to MY Post</a>
                <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning"><span data-feather="edit"></span>
                    Edit</a>
                <form action="/dashboard/posts/{{ $post->slug }}" method="POST" class="d-inline del-confirm-form">
                    @method('delete')
                    @csrf
                    <button type="button" class="btn btn-danger del-confirm-btn">
                        <span data-feather="x-circle"></span> Delete
                    </button>
                </form>

                @if ($post->image)
                    <div style="max-height:350px; overflow: hidden;">
                        <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid mt-3"
                            alt="{{ $post->category->name }}">
                    </div>
                @else
                    <img src="https://picsum.photos/1200/400?{{ $post->category->name }}" class="img-fluid mt-3"
                        alt="{{ $post->category->name }}">
                @endif

                <article class="my-3 fs-5">
                    {!! $post->body !!}
                </article>
            </div>
        </div>
    </div>
@endsection
