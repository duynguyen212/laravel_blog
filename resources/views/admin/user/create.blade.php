@extends('template_backend.home')
@section('sub-title', 'User')
@section('content')
    <h2>Create</h2> 
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible">
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            @foreach($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif

    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible">
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ Session('success') }}
        </div>
    @endif
    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Name of user</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>
      	<div class="form-group">
            <label>Type of user</label>
            <select class="form-control" name="type">
            	<option value="" holder>Select type of user</option>
            	<option value="1" holder>Admin</option>
            	<option value="0" holder>Author</option>
            </select>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="form-group">
            <button class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;Save</button> 
            <a href="{{ route('user.index') }}" class="btn btn-outline-dark">
                <i class="fas fa-list-alt"></i>&nbsp;Back user list
            </a>
        </div>
    </form>    
@endsection