@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 mt-3">
            <h1 class="text-center mb-4">Add account</h1>
            <!-- Create Update -->
            <div class="row">
                <div class="col-xl">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Create Account</h5>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{route('account.store')}}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Account Name</label>
                                    <input type="text" name="name" class="form-control" id="basic-default-fullname" placeholder="BCA" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-date">Balance</label>
                                    <input type="number" name="initial_balance" class="form-control" id="basic-default-date"  min="1"/>
                                </div>
                                @foreach($icons as $icon)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="icon_id" id="flexRadioDefault1" value="{{$icon->icon_id}}">
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
