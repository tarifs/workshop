<div class="form-group">
    <label for="">Name</label>
    <input type="text" class="form-control  @error('name') is-invalid @enderror" placeholder="Enter Your Name" value="{{ old('name',$user->name) }}" name="name">
    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <label for="">Email</label>
    <input type="email" class="form-control  @error('email') is-invalid @enderror" placeholder="Enter Email Address" value="{{ old('email',$user->email) }}" name="email">
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <label for="">Password</label>
    <input type="password" class="form-control  @error('password') is-invalid @enderror" placeholder="Enter password" value="{{ old('password') }}" name="password">
    @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <label for="">Confirm Password</label>
    <input type="password" class="form-control" placeholder="Enter confirm password" value="{{ old('password_confirmation') }}" name="password_confirmation">
</div>

@if ($user->id != auth()->user()->id)
    <div class="form-group">
        <label for="">Rule</label> : 
        <label for="admin">
            <input {{ $user->is_admin == '1'?'checked':'' }} type="radio" value="1" name="rule" id="admin">Admin
        </label>
        <label for="User">
            <input {{ $user->is_admin == '0'?'checked':'' }} type="radio" value="0" name="rule" id="User">User
        </label>
        @error('rule')
            <span class="text-danger" role="alert"><br>
                <small><strong>{{ $message }}</strong></small>
            </span>
        @enderror
    </div>
@endif