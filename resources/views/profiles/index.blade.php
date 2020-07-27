@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="https://instagram.flpa1-1.fna.fbcdn.net/v/t51.2885-19/s150x150/97566921_2973768799380412_5562195854791540736_n.jpg?_nc_ht=instagram.flpa1-1.fna.fbcdn.net&_nc_ohc=R4RWsNsSv3wAX-JG8Nq&oh=e97400aada9d5723aaf5cb702db04db2&oe=5F3EE567"
                class="rounded-circle"
            >
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <h1>{{ $user->username }}</h1>
                <a href="/p/create">Add New Post</a>
            </div>
            <div class="d-flex">
                <div class="pr-5"><strong>{{ $user->posts->count() }}</strong> posts </div>
                <div class="pr-5"><strong>23k</strong> followers </div>
                <div><strong>212</strong> following </div>
            </div>
            <div class="pt-4 font-weight-bold">{{ $user->profile->title }}</div>
            <div>{{ $user->profile->description }}</div>
            <div>
                <a href="#">{{ $user->profile->url}}</a>
            </div>
        </div>
    </div>


    <div class="row pt-4">
        @foreach($user->posts as $posts)
            <div class="col-4 pb-4">
                <img src="/storage/{{ $posts->image }}"
                    class="w-100"
                >
            </div>
        @endforeach
    </div>
</div>
@endsection
