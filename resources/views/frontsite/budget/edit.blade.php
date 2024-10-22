@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 mt-3">
            <h1 class="text-center mb-4">Add Budget</h1>
            <!-- Create Update -->
            <div class="row">
                <div class="col-xl">
                        <div class="card-body">
                            <form method="POST" action="{{route('budget.update', $budget->budget_id)}}">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Budget Name</label>
                                    <input type="text" name="name" class="form-control" id="basic-default-fullname" value="{{$budget->name}}" />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-limit">Limit</label>
                                    <input type="number" name="limit" class="form-control" id="basic-default-limit"  value="{{$budget->limit}}" />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-date">First Day of month</label>
                                    <input type="number" name="day_of_month" class="form-control" id="basic-default-date"  min="1" max="31" value="{{$budget->day_of_month}}" />
                                </div>
                                <select name="category_id">
                                    @foreach($categories as $category)
                                        <option value="{{$category->category_id}}" {{ $category->category_id == $budget->category_id ? 'selected' : '' }}>{{$category->name}}</option>
                                    @endforeach
                                </select>

                                @if($errors->any())
                                    <div class="mb-3">
                                        @foreach($errors->all() as $error)
                                            <div class="alert alert-danger">
                                                <p>{{$error}}</p>
                                            </div
                                        @endforeach
                                    </div>
                                @endif
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
