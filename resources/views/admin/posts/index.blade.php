@extends('layouts.admin')

@section('content')

    @if(Session::has('deleted_post'))

        <p class="alert alert-danger text-center">{{session('deleted_post')}}</p>
    @endif

    @if(Session::has('updated_post'))

        <p class="alert alert-info text-center">{{session('updated_post')}}</p>
    @endif

    @if(Session::has('created_post'))

        <p class="alert alert-success text-center">{{session('created_post')}}</p>
    @endif

    <h1>Posts</h1>

    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>Owner</th>
            <th>Category</th>
            <th>Title</th>
            <th>Body</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
        </thead>
        <tbody>

        @if($posts)
            @foreach($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td>
                        <img height="50"
                             src="{{url($post->photo ? $post->photo->file : 'http://placehold.it/400x400')}}"
                             alt="{{$post->title . ' image'}}"></td>
                    <td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->user->name}}</a></td>
                    <td>{{$post->category ? $post->category->name : 'UnCategorized'}}</td>
                    <td>{{$post->title}}</td>
                    {{-- Go to Larvel Helpers for more methods --}}
                    <td>{{str_limit($post->body, 25)}}</td>
                    <td>{{$post->created_at->diffForHumans()}}</td>
                    <td>{{$post->updated_at->diffForHumans()}}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

@endsection