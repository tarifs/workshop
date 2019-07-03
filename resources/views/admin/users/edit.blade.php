@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            Update User
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user) }}" method="post">
                @csrf @method('put')
                @include('admin.users._field')
                <div class="form-group">
                    <input type="submit" class="btn btn-sm btn-primary float-right" value="Update">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
