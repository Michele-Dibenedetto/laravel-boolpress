@extends('layouts.app')

@section("title_page", "post")

@section('content')
    <h1>Post</h1>
        <div class="block_post">
            <div class="profile">
                <img class="picture_profile" src="{{$post->immagine_profilo}}" alt="">
                <div class="info">
                    <h2>{{$post->titolo}}</h2>
                    <p>{{$post->data_publicazione}}</p>
                    <p>{{$post->user->name}}</p>
                </div>
            </div>
            <p class="text">{{$post->testo}}</p>
        </div>
@endsection