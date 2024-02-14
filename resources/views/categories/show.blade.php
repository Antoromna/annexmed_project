@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $category->name }}</div>

                <div class="card-body">
                    <p><strong>Name:</strong> {{ $category->name }}</p>

                </div>

            </div>
        </div>

    </div>
    <div class="d-flex justify-content-end">
    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
