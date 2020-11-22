@extends('template_backend.home')
@section('sub-title', 'Post in trash')
@section('content')
    <h2>List of posts in trash</h2>    
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
    
    <table class="table table-striped table-hover table-sm table-bordered">
        <thead>
            <th>No</th>            
            <th>Title</th>
            <th>Category</th>
            <th>Tags</th>
            <th>Thumbnail</th>  
            <th>Action</th>
        </thead>
        @foreach ($deletedPost as $result => $r)
            <tbody>
                <tr>                    
                    <td> {{ $result + $deletedPost->firstitem() }}</td>
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
                        <form action="{{ route('post.kill', $r->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <a href="{{ route('post.restore', $r->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-pencil-alt"></i>&nbsp; Restore
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
    {{$deletedPost->links()}}
@endsection