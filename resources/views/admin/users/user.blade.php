@extends('layouts.dashboard');

@section('content')
    <h1>sezione user</h1>
    <div class="card" style="width: 18rem;">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">{{Auth::user()->name}}</li>
            <li class="list-group-item">{{Auth::user()->email}}</li>
            @if (Auth::user()->api_token)
                <li class="list-group-item">{{Auth::user()->api_token}}</li>
            @else
            <form action="{{route("user_generate_token")}}" method="post">
                @csrf
                <button type="submit">Genera un token</button>
            </form>
                
            @endif
        </ul>
    </div>
@endsection