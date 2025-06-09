@extends('layouts.app')

@section('content')
<h2>Login Admin</h2>
<form action="{{ route('login') }}" method="POST">
    @csrf
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>
</form>
@if ($errors->any())
    <div>
        <strong>{{ $errors->first() }}</strong>
    </div>
@endif
@endsection
