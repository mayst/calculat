@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Name: {{ Auth::user()->name }}</div>
                    <div class="panel-heading">Email: {{ Auth::user()->email }}</div>

                    <div class="panel-body">
                        <?php
                        $articles = Auth::user()->articles;

                        foreach($articles as $article) { ?>
                            <h2>{{ $article['title'] }}</h2>
                            <p>{{ $article['content'] }}</p>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection