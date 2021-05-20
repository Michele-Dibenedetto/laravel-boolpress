@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    <ul>
        @foreach ($posts as $post)
            <li><a href="{{route("post_page", ["slug" => $post->slug])}}">{{$post->titolo}}</a></li>
        @endforeach
    </ul>
@endsection