@extends('layouts.admin')

@section('content')

    @if(Session::has('deleted_photo'))

        <p class="alert alert-danger text-center">{{session('deleted_photo')}}</p>
    @endif

    @if(Session::has('deleted_photos'))

        <p class="alert alert-danger text-center">{{session('deleted_photos')}}</p>
    @endif


    @if(Session::has('created_photo'))

        <p class="alert alert-success text-center">{{session('created_photo')}}</p>
    @endif

    <h1>Media</h1>

    @if($photos)

        {!! Form::open(['method'=>'DELETE', 'class' => 'form-inline','action'=>'AdminMediaController@deleteMedia' ]) !!}

        <div class="form-group">
            {!! Form::select('checkBoxArray', ['' => 'Delete'], ['class'=>'form-control']) !!}
        </div>

        <div class="group-form">
            {!! Form::submit('Submit', ['class'=>'btn btn-primary', 'name' => 'delete_all']) !!}
        </div>

        <table class="table">
            <thead>
            <tr>
                <th><input type="checkbox" id="options"></th>
                <th>Id</th>
                <th>Name</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
            </thead>
            <tbody>

            @foreach($photos as $photo)
                <tr>
                    <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="{{$photo->id}}">
                    </td>
                    <td>{{$photo->id}}</td>
                    <td><img height="50" src="{{asset($photo->file)}}" alt=""></td>
                    <td>{{$photo->created_at ? $photo->created_at->diffForHumans() : 'No date'}}</td>
                    <td>{{$photo->updated_at ? $photo->updated_at->diffForHumans() : 'No date'}}</td>
{{--                    <td>--}}

{{--                        <input type="hidden" name="photo" value="{{$photo->id}}">--}}
{{--                        <div class="group-form">--}}
{{--                            <input type="submit" name="delete_single" value="Delete" class="btn btn-danger">--}}
{{--                        </div>--}}

{{--                    </td>--}}
                </tr>
            @endforeach

            </tbody>
        </table>
        {!! Form::close() !!}
    @endif
@endsection

@section('scripts')
    <script>

        $(document).ready(function () {
            $('#options').click(function () {
                if (this.checked) {
                    $('.checkBoxes').each(function () {
                        this.checked = true;
                    });
                } else {
                    $('.checkBoxes').each(function () {
                        this.checked = false;
                    });
                }
            });
        });

    </script>

@endsection