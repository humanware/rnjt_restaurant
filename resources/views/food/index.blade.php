@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if(Session::has('message'))
                    <div class="alert alert-success">
                        {{ Session::get('message') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">{{ __('Foods List') }}
                        <span class="float-right">
                            <a href="{{ route('food.create') }}" class="btn btn-outline-secondary btn-sm">Add Food</a>
                        </span>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" style="width: 10%;">Image</th>
                                <th scope="col">Food Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Price</th>
                                <th scope="col">Category</th>
                                <th scope="col" colspan="2">Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($foods) > 0)
                                @foreach($foods as $key=>$food)
                                    <tr>
                                        <td scope="row">{{ $key + 1 }}</td>
                                        <td><img src="{{ asset('images') }}/{{ $food->image }}" style="width: 100%; height:auto;" /></td>
                                        <td>{{ $food->name }}</td>
                                        <td>{{ $food->description }}</td>
                                        <td>${{ $food->price }}</td>
                                        <td>{{ $food->category->name }}</td>
                                        <td>
                                            <a type="button" class="btn btn-outline-primary btn-sm" href="{{ route('food.edit', [$food->id]) }}">Edit</a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#deleteFood{{ $food->id }}">
                                                Delete
                                            </button>
                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteFood{{ $food->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form action="{{ route('food.destroy', [$food->id]) }}" method="POST">
                                                            @csrf
                                                            {{ method_field('DELETE') }}
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">Delete {{ $food->name }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure want to delete {{ $food->name }}?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-danger">Confirm</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td>No food to display</td></tr>
                            @endif
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {!! $foods->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
