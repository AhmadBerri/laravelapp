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
            <th>Title</th>
            <th>Owner</th>
            <th>Category</th>
            <th>Post</th>
            <th>Comments</th>
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
                    <td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->title}}</a></td>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->category ? $post->category->name : 'UnCategorized'}}</td>
                    {{-- Go to Larvel Helpers for more methods --}}
                    <td><a href="{{route('home.post', $post->slug)}}">View Post</a></td>
                    <td><a href="{{route('admin.comments.show', $post->id)}}">View Comments</a></td>
                    <td>{{$post->created_at->diffForHumans()}}</td>
                    <td>{{$post->updated_at->diffForHumans()}}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">

            {{$posts->render()}}

        </div>
    </div>

@endsection