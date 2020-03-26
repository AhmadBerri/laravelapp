@extends('layouts.admin')

@section('content')

    @if(Session::has('deleted_photo'))

        <p class="alert alert-danger text-center">{{session('deleted_photo')}}</p>
    @endif


    @if(Session::has('created_photo'))

        <p class="alert alert-success text-center">{{session('created_photo')}}</p>
    @endif

    <h1>Media</h1>

    @if($photos)

        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Created At</th>
                <th>Deleted At</th>
            </tr>
            </thead>
            <tbody>

            @foreach($photos as $photo)
                <tr>
                    <td>{{$photo->id}}</td>
                    <td><img height="50" src="{{asset($photo->file)}}" alt=""></td>
                    <td>{{$photo->created_at ? $photo->created_at->diffForHumans() : 'No date'}}</td>
                    <td>{{$photo->updated_at ? $photo->updated_at->diffForHumans() : 'No date'}}</td>
                    <td>

                        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminMediaController@destroy', $photo->id]]) !!}

                        <div class="group-form">
                            {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                        </div>

                        {!! Form::close() !!}

                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

    @endif

@endsection