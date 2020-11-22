@extends('template_backend.home')
@section('sub-title', 'Post')
@section('content')
    <h2>Listof posts</h2>    
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
    <a href="{{ route('post.create')}}" class="btn btn-success btn-sm">
        <i class="fas fa-plus"></i> &nbsp;Create new post 
    </a>
    <br>
    <br>
    <table class="table table-striped table-hover table-sm table-bordered">
        <thead>
            <th>No</th>            
            <th>Title</th>
            <th>Category</th>
            <th>Tags</th>
            <th>Thumbnail</th>  
            <th>Action</th>
        </thead>
        @foreach ($post as $result => $r)
            <tbody>
                <tr>                    
                    <td> {{ $result + $post->firstitem() }}</td>
                    <td>{{$r->title}}</td>
                    <td>{{$r->category->name}}</td>
                    <td> @foreach ($r->tags as $tag)
                        <ul>
                            <li> {{ $tag->name }} </li>                    
                        </ul>        
                    @endforeach                       
                    </td>
                    <td><img src="{{ asset($r->picture) }}" class="img-fluid" width="100px" /></td>
                    <td>                      
                        <form action="{{ route('post.destroy', $r->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <a href="{{ route('post.edit', $r->id) }}" class="btn btn-primary btn-sm">
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
    {{$post->links()}}
@endsection