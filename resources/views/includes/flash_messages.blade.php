@if(Session::has('comment_message'))

    <p class="alert alert-success text-center">{{session('comment_message')}}</p>

@endif