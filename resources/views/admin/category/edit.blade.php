@extends('template_backend.home')
@section('sub-title', 'Category')
@section('content')
    <h2>Edit</h2> 
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
    <form action="{{ route('category.update', $category->id) }}" method="POST">
        @csrf
        @method('patch')
        <div class="form-group">
            <label>Category Name</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}">
        </div>
      
        <div class="form-group">
            <button class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;Update</button> 
            <a href="{{ route('category.index') }}" class="btn btn-outline-dark">
                <i class="fas fa-list-alt"></i>&nbsp;Back category list
            </a>
        </div>
    </form>    
@endsection