@extends('layouts.app')
@section('content')
   <div class="row justify-content-center">
       <div class="col-md-8 mt-3">
           <h1 class="text-center mb-4">Account Management</h1>
           <div class="mb-4">
               <button type="button" onclick="location.href='/account/create '" class="btn btn-success">Add</button>
           </div>
       <table class="table">
        <thead class="thead-light-lilac">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Initial Balance</th>
            <th scope="col">Icon</th>
            <th scope="col">Created At</th>
            <th scope="col">Modified At</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @php $i=0 @endphp
            @foreach($accounts as $account)
                @php $i++ @endphp
                <tr>
                <td scope="row">{{$i}}</td>
                <td >{{$account->name}}</td>
                <td>{{$account->initial_balance}}</td>
                <td>
                    <img  class="small-image" src="{{ Storage::url($account->icon) }}" alt="Profile Image">
                </td>
                <td>{{$account->created_at}}</td>
                <td>{{$account->updated_at}}</td>
                <td>
                    <a class="btn btn-primary" href="{{route('account.edit', $account->account_id)}}" ><i class="bx bx-trash me-1"></i> Edit</a>
                    <a class="btn btn-danger" href="{{route('account.destroy', $account->account_id)}}" onclick="event.preventDefault();
                                document.getElementById('delete-form-{{ $account->account_id }}').submit();"><i class="bx bx-trash me-1"></i> Delete</a>
                    <form id="delete-form-{{ $account->account_id }}" action="{{ route('account.destroy', $account->account_id) }}" method="POST">
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
