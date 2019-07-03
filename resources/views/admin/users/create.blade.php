@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            Add New User
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="post">
                @csrf
                @include('admin.users._field')
                <div class="form-group">
                    <input type="submit" class="btn btn-primary float-right" value="Submit">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
