@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>Posts</h1></div>
                    <div class="panel-body">
                        <ul>
                            @foreach($posts as $post)
                                <li><a href="{{ $post->url }}">{{ $post->title  }}</a></li>
                            @endforeach
                        </ul>
                     </div>
                </div>
            </div>
        </div>
    </div>
@endsection
