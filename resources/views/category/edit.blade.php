@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(Session::has('message'))
                    <div class="alert alert-success">
                        {{ Session::get('message') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">Update {{ $category->name }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('category.update', [$category->id]) }}">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" autofocus placeholder="Enter category name" value="{{ $category->name }}" />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-primary" value="Update" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
