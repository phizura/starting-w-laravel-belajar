@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Posts</h1>
    </div>

    <div class="col-lg-8 mb-5">
        <form action="/dashboard/posts/{{ $post->slug }}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    value="{{ old('title', $post->title) }}" required tabindex="1">
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                    value="{{ old('slug', $post->slug) }}" required tabindex="-1">
                @error('slug')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" id="category"
                    tabindex="2">
                    <option selected class="text-muted">--Pilih Category--</option>
                    @foreach ($categories as $category)
                        @if (old('category_id', $post->category_id) == $category->id)
                            <option selected value={{ $category->id }}>{{ $category->name }}</option>
                        @else
                            <option value={{ $category->id }}>{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Post Image</label>
                <input type="hidden" name="oldImg" value="{{ $post->image }}">
                @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}"
                        class="image-preview image-fluid col-sm-5 mb-3 d-block">
                @else
                    <img class="image-preview image-fluid col-sm-5 mb-3">
                @endif
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                    name="image" tabindex="3" onchange="imgPreview()">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="body" class="form-label">Body</label>
                @error('body')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <input id="body" type="hidden" name="body" value="{{ old('body', $post->body) }}">
                <trix-editor input="body" tabindex="3"></trix-editor>
            </div>
            <button type="submit" class="btn btn-primary">Update Post</button>
        </form>
    </div>
    
    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function() {
            fetch(`/dashboard/posts/checkSlug?title=${title.value}`)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });

        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        })

        function imgPreview() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.image-preview');

            imgPreview.style.display = 'block'

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result
            }
        }
    </script>
@endsection
