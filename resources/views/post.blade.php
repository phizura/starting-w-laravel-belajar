@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <h1 class="mb-3">{{ $post->title }}</h1>

                <p>
                    By. <a href="/authors/{{ $post->author->username }}"
                        class="text-decoration-none">{{ $post->author->name }}</a> in <a
                        href="/posts?category={{ $post->category->slug }}"
                        class="text-decoration-none">{{ $post->category->name }}</a>
                </p>

                <img src="https://picsum.photos/1200/400?{{ $post->category->name }}" class="img-fluid"
                    alt="{{ $post->category->name }}">

                <article class="my-3 fs-5">
                    {!! $post->body !!}
                </article>
                <a href="/posts" class="text-decoration-none d-block mt-3">Back To Posts</a>
            </div>
        </div>
    </div>
@endsection
