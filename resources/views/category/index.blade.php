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
                    <div class="card-header">{{ __('Food Categories') }}
                        <span class="float-right">
                            <a href="{{ route('category.create') }}" class="btn btn-outline-secondary btn-sm">Add Category</a>
                        </span>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col" colspan="2">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($categories) > 0)
                                @foreach($categories as $key=>$category)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <a type="button" class="btn btn-outline-primary btn-sm" href="{{ route('category.edit', [$category->id]) }}">Edit</a>
                                        </td>
                                        <td>
                                                <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $category->id }}">
                                                    Delete
                                                </button>
                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form action="{{ route('category.destroy', [$category->id]) }}" method="POST">
                                                            @csrf
                                                            {{ method_field('DELETE') }}
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">Delete {{ $category->name }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure want to delete {{ $category->name }}?
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
                                <tr><td>No category to display</td></tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
