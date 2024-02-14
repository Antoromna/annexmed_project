@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $post->title }}</div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Title:</th>
                                <td>{{ $post->title }}</td>
                            </tr>
                            <tr>
                                <th>Publication Date:</th>
                                <td>{{ $post->publication_date }}</td>
                            </tr>
                            <tr>
                                <th>Content:</th>
                                <td>{!! $post->content !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end">
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back</a>
        </div>
</div>
@endsection
