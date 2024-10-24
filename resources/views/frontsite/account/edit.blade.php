@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 mt-3">
            <!-- Create Update -->
            <div class="row">
                <div class="col-xl">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Update Account</h5>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{route('account.update', $account->account_id)}}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Account Name</label>
                                <input type="text" name="name" class="form-control" id="basic-default-fullname" value="{{$account->name}}" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-date">Balance</label>
                                <input type="number" name="initial_balance" class="form-control" id="basic-default-date"  min="1" value="{{$account->initial_balance}}"/>
                            </div>
                            @foreach($icons as $icon)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="icon_id" id="flexRadioDefault1"  value="{{$icon->icon_id}}" {{$icon->icon_id == $account->icon_id ? 'checked':''}}/>
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
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
