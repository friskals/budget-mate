@extends('layouts.app')
@section('content')
   <div class="row justify-content-center">
       <div class="col-md-8 mt-3">
           <h1 class="text-center mb-4">Category Management</h1>
           <div class="mb-4">
               <button type="button" onclick="location.href='/category/create '" class="btn btn-success">Add</button>
           </div>
       <table class="table">
        <thead class="thead-light-lilac">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Created At</th>
            <th scope="col">Modified At</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @php $i=0 @endphp
            @foreach($categories as $category)
                @php $i++ @endphp
                <tr>
                <th scope="row">{{$i}}</th>
                <td>{{$category->name}}</td>
                <td>{{$category->created_at}}</td>
                <td>{{$category->updated_at}}</td>
                <td>
                    <a type="button" class="btn btn-primary">Edit</a>
                    <a class="btn btn-danger" href="{{route('category.destroy', $category->category_id)}}" onclick="event.preventDefault();
                                document.getElementById('delete-form-{{ $category->category_id }}').submit();"><i class="bx bx-trash me-1"></i> Delete</a>
                    <form id="delete-form-{{ $category->category_id }}" action="{{ route('category.destroy', $category->category_id) }}" method="POST">
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
