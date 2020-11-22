@extends('template_backend.home')
@section('sub-title', 'Post')
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
    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label>Category</label>
            <select class="form-control" name="category_id">
                @foreach ($category as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>    
                @endforeach               
            </select>
        </div>
        <div class="form-group">
            <label>Select tags</label>
            <select class="form-control select2" multiple="" name="tags[]">
                @foreach ($tags as $tag)
                    <option value={{ $tag->id }}>{{ $tag->name }}</option>    
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Content</label>
            <textarea class="form-control" name="content"></textarea>
        </div>   
        <div class="form-group">
            <label>Thumbnail</label>
            <input type="file" name="picture" class="form-control">
        </div>  
        <div class="form-group">
            <button class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;Save</button> 
            <a href="{{ route('category.index') }}" class="btn btn-outline-dark">
                <i class="fas fa-list-alt"></i>&nbsp;Back category list
            </a>
        </div>
    </form>    
@endsection