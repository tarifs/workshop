@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
            <h4 class="text-center text-success">{{Session::get('message')}}</h4>
        <div class="card-header">
            All User
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <th>Serial</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Rule</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @if ($users->count())
                        @foreach ($users as $key => $user)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    {{ $user->rule }}
                                </td>
                                <td>
                                    @if ($user->id != auth()->user()->id)
                                        <a href="{{ route('admin.user.reverse.rule', $user->id) }}" class="badge {{ $user->is_admin?'badge-danger':'badge-success' }}">{{ $user->reverse_rule }}</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    @if ($user->id != auth()->user()->id)
                                        @include('includes._confirm_delete',[
                                            'action' => route('admin.users.destroy', $user->id),
                                            'id' => $user->id,
                                        ])

                                    @endif
                                    
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
