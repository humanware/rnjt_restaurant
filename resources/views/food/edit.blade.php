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
                    <div class="card-header">Edit {{ $food->name }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('food.update', [$food->id]) }}" enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <label for="foodname">Food Name</label>
                                <input type="text" name="foodname" id="foodname" class="form-control @error('foodname') is-invalid @enderror" autocomplete="foodname" autofocus placeholder="Enter food name" value="{{ $food->name }}" />
                                @error('foodname')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="fooddescription">Food Description</label>
                                <textarea class="form-control" id="fooddescription" rows="3" name="fooddescription" placeholder="Enter food description">{{ $food->description }}</textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="foodprice">Food Price</label>
                                    <input type="number" name="foodprice" id="foodprice" class="form-control @error('foodprice') is-invalid @enderror" placeholder="Enter food price" value="{{ $food->price }}" />
                                    @error('foodprice')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="foodcategory">Food Category</label>
                                    <select name="foodcategory" id="foodcategory" class="form-control @error('foodcategory') is-invalid @enderror">
                                        <option value="">Select Category</option>
                                        @foreach(App\Models\Category::all() as $category)
                                            <option value="{{ $category->id }}" @if($category->id == $food->category_id) selected="selected" @endif>{{ $category->name }}</option>
                                        @endforeach
                                        @error('foodcategory')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="foodimage">Food Image</label>
                                    <input type="file" name="foodimage" id="foodname" class="form-control @error('foodimage') is-invalid @enderror" />
                                </div>
                                <div class="col-md-6">
                                    @if(!empty($food->image))
                                        <img src="{{ url('/images/')}}/{{ $food->image }}" style="width: 100%; height: auto;" alt="{{ $food->title }}" title="{{ $food->title }}" />
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-primary" value="Submit" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
