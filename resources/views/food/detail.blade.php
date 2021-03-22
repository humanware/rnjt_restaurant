@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Food Image') }}</div>

                    <div class="card-body">
                        <img src="{{ asset('images') }}/{{ $food->image }}" alt="{{ $food->name }}" style="width:100%; height: auto;" />
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Food Details') }}</div>

                    <div class="card-body">
                        <h2>{{ $food->name }}</h2>
                        <p class="lead">{{ $food->description }}</p>
                        <p>{{ $food->category->name }}</p>
                        <h4>${{ $food->price }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
