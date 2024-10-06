@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 offset-md-2">
            <h1 class="text-center my-2">Category Management</h1>

            <div class="card card-default">
                <div class="card-header">
                    Todos
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($categories as $category)
                            <li class="list-group-item">
                                {{$category->name}}
                                <a class="btn btn-primary btn-sm float-right" href="/todos/{{$category->category_id}}">View</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
