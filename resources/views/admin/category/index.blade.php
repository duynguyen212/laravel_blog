@extends('template_backend.home')
@section('content')
    <h1>Category List</h1>
    @foreach ($category as $result)
        <ul>
            <li>{{ $result->name }}</li>            
        </ul>
    @endforeach
@endsection