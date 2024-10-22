@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 mt-3">
            <h1 class="text-center mb-4">Budget Management</h1>
            <div class="mb-4">
                <button type="button" onclick="location.href='/budget/create '" class="btn btn-success">Add</button>
            </div>
            <table class="table">
                <thead class="thead-light-lilac">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Limit</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">Categories</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Modified At</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @php $i=0 @endphp
                @foreach($budgets as $budget)
                    @php $i++ @endphp
                    <tr>
                        <th scope="row">{{$i}}</th>
                        <td>{{$budget->name}}</td>
                        <td>{{$budget->limit}}</td>
                        <td>{{$budget->day_of_month}}</td>
                        <td>{{$budget->category}}</td>
                        <td>{{$budget->created_at}}</td>
                        <td>{{$budget->updated_at}}</td>
                        <td>
                            <a class="btn btn-primary" href="{{route('budget.edit', $budget->budget_id)}}" ><i class="bx bx-trash me-1"></i> Edit</a>
                            <a class="btn btn-danger" href="{{route('budget.destroy', $budget->budget_id)}}" onclick="event.preventDefault();
                                document.getElementById('delete-form-{{ $budget->budget_id }}').submit();"><i class="bx bx-trash me-1"></i> Delete</a>
                            <form id="delete-form-{{ $budget->budget_id }}" action="{{ route('budget.destroy', $budget->budget_id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
