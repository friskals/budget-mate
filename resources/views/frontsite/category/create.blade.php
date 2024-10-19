@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 mt-3">
            <h1 class="text-center mb-4">Add Category</h1>
            <!-- Create Update -->
            <div class="row">
                <div class="col-xl">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Create Category</h5>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{route('category.store')}}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Category Name</label>
                                    <input type="text" name="name" class="form-control" id="basic-default-fullname" placeholder="Education" />
                                </div>

                                <div class="mb-3">
                                    <label for="category-type" class="form-label">Type</label><br>
                                    <select class="form-select" name="type" id="category-type" aria-label="Category" >
                                        <option value=""></option>
                                        <option value="expense">Expense</option>
                                        <option value="income">Income</option>
                                    </select>
                                </div>
                                @foreach($icons as $icon)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="icon_id" id="flexRadioDefault1" value="{{$icon->icon_id}}">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Default radio
                                        </label>
                                        <img  class="small-image" src="{{ Storage::url($icon->logo) }}" alt="Profile Image">
                                    </div>
                                @endforeach

                                @if($errors->any())
                                    <div class="mb-3">
                                        @foreach($errors->all() as $error)
                                            <div class="alert alert-danger">
                                                <p>{{$error}}</p>
                                            </div
                                        @endforeach
                                    </div>
                                @endif
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
