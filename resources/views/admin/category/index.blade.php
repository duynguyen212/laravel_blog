@extends('template_backend.home')
@section('sub-title', 'Category')
@section('content')
    <h2>Category List</h2>    
     @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible">
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ Session('success') }}
        </div>
    @endif
    <br>
    <br>
    <a href="{{ route('category.create')}}" class="btn btn-success btn-sm">
        <i class="fas fa-plus"></i> &nbsp;Create new category 
    </a>
    <br>
    <br>
    <table class="table table-striped table-hover table-sm table-bordered">
        <thead>
            <th>No</th>
            <th>Name</th>
            <th>Action</th>
        </thead>
        @foreach ($category as $result => $r)
            <tbody>
                <tr>
                    <td> {{ $result + $category->firstitem() }}</td>
                    <td>{{$r->name}}</td>
                    <td>                      
                        <form action="{{ route('category.destroy', $r->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <a href="{{ route('category.edit', $r->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-pencil-alt"></i>&nbsp; Edit
                            </a> &nbsp;                        
                            <button class="btn btn-danger btn-sm" type="submit">
                                <i class="fas fa-trash"></i> &nbsp; Delete
                            </button>
                        </form>
                    </td>
                </tr>
            </tbody>            
        @endforeach
    </table>
    {{$category->links()}}
@endsection