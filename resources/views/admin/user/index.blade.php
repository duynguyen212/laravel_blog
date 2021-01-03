@extends('template_backend.home')
@section('sub-title', 'Users')
@section('content')
    <h2>List of users</h2>    
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
    <a href="{{ route('user.create')}}" class="btn btn-success btn-sm">
        <i class="fas fa-plus"></i> &nbsp;Create new user 
    </a>
    <br>
    <br>
    <table class="table table-striped table-hover table-sm table-bordered">
        <thead>
            <th>No</th>            
            <th>Name</th>
            <th>Email</th>            
            <th>Type</th>         
            <th>Action</th>
        </thead>
        @foreach ($user as $result => $r)
            <tbody>
                <tr>                    
                    <td> {{ $result + $user->firstitem() }}</td>
                    <td>{{ $r->name }}</td>
                    <td>{{ $r->email }}</td>                  
                    <td>
                        @if($r->type) 
                            <span class="badge badge-success">Admin</span>
                        @else
                            <span class="badge badge-secondary">Author</span>
                        @endif
                    </td>                  
                    <td>                      
                        <form action="{{ route('user.destroy', $r->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <a href="{{ route('user.edit', $r->id) }}" class="btn btn-primary btn-sm">
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
    {{$user->links()}}
@endsection