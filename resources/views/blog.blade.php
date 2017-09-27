@extends('layouts.header')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">All articles</div>

                    <div class="panel-body">
                        @foreach($articles as $article)
                            <h2>{{ $article['title'] }}</h2>
                            <p>{{ $article['content'] }}</p>

                            @foreach($article->comments as $comment)
                                <p>{{ $comment->user->name }}</p>
                                <p>{{ $comment->message }}</p>

                                {{--@foreach()--}}
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection