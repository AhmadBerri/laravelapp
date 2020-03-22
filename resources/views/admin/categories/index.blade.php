@extends('layouts.admin')

@section('content')

    @if(Session::has('deleted_category'))

        <p class="alert alert-danger text-center">{{session('deleted_category')}}</p>
    @endif

    @if(Session::has('updated_category'))

        <p class="alert alert-info text-center">{{session('updated_category')}}</p>
    @endif

    @if(Session::has('created_category'))

        <p class="alert alert-success text-center">{{session('created_category')}}</p>
    @endif

    <h1>Categories</h1>

    <div class="col-sm-6">

        {!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store']) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Enter name']) !!}
        </div>

        <div class="group-form">
            {!! Form::submit('Create Category', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>

    <div class="col-sm-6">

        @if($categories)
            <table class="table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
                </thead>
                <tbody>

                @foreach($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td><a href="{{route('admin.categories.edit', $category->id)}}">{{$category->name}}</a></td>
                        <td>{{$category->created_at ? $category->created_at->diffForHumans() : 'No date'}}</td>
                        <td>{{$category->updated_at ? $category->updated_at->diffForHumans() : 'No date'}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

    </div>

@endsection