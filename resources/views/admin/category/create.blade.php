@extends('template_backend.home')
@section('sub-title', 'Category')
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
    <form action="{{ route('category.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Category Name</label>
            <input type="text" name="name" class="form-control">
        </div>
      
        <div class="form-group">
            <button class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;Save</button> 
            <a href="{{ route('category.index') }}" class="btn btn-outline-dark">
                <i class="fas fa-list-alt"></i>&nbsp;Back category list
            </a>
        </div>
    </form>    
@endsection