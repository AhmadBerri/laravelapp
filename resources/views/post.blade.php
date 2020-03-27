@extends('layouts.blog-post')

@section('content')

    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{asset($post->photo ? $post->photo->file : $post->photoPlaceholder())}}"
         alt="">

    <hr>

    <!-- Post Content -->

    <p>{!! $post->body !!}</p>

    <hr>

    {{--    This disqus system for comments and replies --}}

    {{--    <div id="disqus_thread"></div>--}}
    {{--    <script>--}}

    {{--        /**--}}
    {{--         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.--}}
    {{--         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/--}}
    {{--        /*--}}
    {{--        var disqus_config = function () {--}}
    {{--        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable--}}
    {{--        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable--}}
    {{--        };--}}
    {{--        */--}}
    {{--        (function () { // DON'T EDIT BELOW THIS LINE--}}
    {{--            var d = document, s = d.createElement('script');--}}
    {{--            s.src = 'https://laravelapp-4.disqus.com/embed.js';--}}
    {{--            s.setAttribute('data-timestamp', +new Date());--}}
    {{--            (d.head || d.body).appendChild(s);--}}
    {{--        })();--}}
    {{--    </script>--}}
    {{--    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by--}}
    {{--            Disqus.</a></noscript>--}}
    {{--    <script id="dsq-count-scr" src="//laravelapp-4.disqus.com/count.js" async></script>--}}

    @if(Session::has('comment_message'))

        <p class="alert alert-success text-center">{{session('comment_message')}}</p>

    @endif

    <!-- Blog Comments -->

    @if(Auth::check())
        <!-- Comments Form -->
        <div class="well">
            <h4>Leave a Comment:</h4>
            {!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store']) !!}

            <input type="hidden" name="post_id" value="{{$post->id}}">

            <div class="form-group">
                {!! Form::textarea('body', null, ['class'=>'form-control', 'rows' => 3,'placeholder'=>'Enter Your Comment here ...']) !!}
            </div>

            <div class="group-form">
                {!! Form::submit('Submit Comment', ['class'=>'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    @endif

    <hr>

    <!-- Posted Comments -->

    <!-- Comment -->
    @if(Session::has('reply_message'))

        <p class="alert alert-info text-center">{{session('reply_message')}}</p>

    @endif

    @if(count($comments) > 0)
        @foreach($comments as $comment)
            <div class="media">
                <a class="pull-left" href="#">
                    <img height="64" class="media-object" src="{{Auth::user()->gravatar}}asset($comment->photo)"
                         alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$comment->author}}
                        <small>{{$comment->created_at->diffForHumans()}}</small>
                    </h4>
                    <p>{{$comment->body}}</p>


                @if(count($comment->replies) > 0)
                    @foreach($comment->replies as $reply)

                        @if($reply->is_active == 1)

                            <!-- Nested Comment -->
                                <div id="nested-comment" class="media">
                                    <a class="pull-left" href="#">
                                        <img height="50" class="media-object" src="{{asset($reply->photo)}}" alt="">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">{{$reply->author}}
                                            <small>{{$reply->created_at->diffForHumans()}}</small>
                                        </h4>
                                        <p>{{$reply->body}}</p>
                                    </div>

                                    <div class="comment-reply-container">

                                        <button class="toggle-reply btn btn-primary pull-right">Reply</button>

                                        <div class="comment-reply col-sm-10">

                                            {!! Form::open(['method' => 'POST', 'action' => 'CommentRepliesController@createReply']) !!}

                                            <input type="hidden" name="comment_id" value="{{$comment->id}}">

                                            <div class="form-group">
                                                {!! Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => 'Enter your reply here ...', 'rows' => 1]) !!}
                                            </div>

                                            <div class="group-form">
                                                {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
                                            </div>

                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                    <!-- End Nested Comment -->
                                </div>
                            @else
                                <div class="comment-reply-container">

                                    <button class="toggle-reply btn btn-primary pull-right">Reply</button>

                                    <div class="comment-reply col-sm-10">

                                        {!! Form::open(['method' => 'POST', 'action' => 'CommentRepliesController@createReply']) !!}

                                        <input type="hidden" name="comment_id" value="{{$comment->id}}">

                                        <div class="form-group">
                                            {!! Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => 'Enter your reply here ...', 'rows' => 1]) !!}
                                        </div>

                                        <div class="group-form">
                                            {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
                                        </div>

                                        {!! Form::close() !!}

                                    </div>
                                </div>
                                @break
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        @endforeach
    @endif

@endsection

@section('scripts')

    <script>

        $(".comment-reply-container .toggle-reply").click(function () {

            $(this).next().slideToggle("slow")

        });

    </script>

@endsection