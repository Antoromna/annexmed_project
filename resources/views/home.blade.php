@extends('layouts.app')

@section('content')


<div class="container">
    <div class="d-flex justify-content-end">
        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Create Post</a>
    </div>
    <div class="row">
        @include('includes.sidebar')
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="categorySelect" class="form-label">Filter by Category:</label>
                        <div class="input-group">
                            <select id="categorySelect" class="form-control">
                                <option value="">All</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <button id="searchBtn" class="btn btn-primary">Search</button>
                            <button id="resetBtn" class="btn btn-secondary">Reset</button>
                        </div>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>SNo</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Publication Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $key=>$post)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ strip_tags($post->content) }}</td>
                                <td>{{ $post->publication_date }}</td>
                                <td>
                                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-info">View</a>
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($posts->hasPages())
                        <ul class="pagination justify-content-end">
                            @if ($posts->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">&laquo;</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $posts->previousPageUrl() }}" rel="prev" aria-label="Previous">&laquo;</a>
                                </li>
                            @endif
                            @for ($i = 1; $i <= $posts->lastPage(); $i++)
                            <li class="page-item {{ $posts->currentPage() === $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ $posts->url($i) }}">{{ $i }}</a>
                            </li>
                            @endfor
                            @if ($posts->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $posts->nextPageUrl() }}" rel="next" aria-label="Next">&raquo;</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">&raquo;</span>
                                </li>
                            @endif
                        </ul>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
