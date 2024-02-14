@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Post</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('posts.update', $post->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}" required>
                        </div>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea name="content" id="content" class="form-control" rows="8" required>{{ $post->content }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="publication_date">Publication Date</label>
                            <input type="date" name="publication_date" id="publication_date" value="{{ $post->publication_date ? \Carbon\Carbon::parse($post->publication_date)->format('Y-m-d') : '' }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="categories">Categories</label>
                            <select name="categories[]" id="categories" class="form-control" multiple>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $post->categories->contains($category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Update Post</button>
                                <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

