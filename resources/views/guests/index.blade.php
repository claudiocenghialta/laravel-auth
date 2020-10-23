@extends('layouts.app')
@section('content')


<div class="container">
    <div class="card-group">
        <div class="row">
            @foreach ($posts as $post)
            <div class="col-sm-4 pt-3">

                <div class="card">
                    <img class="card-img-top"
                        src="{{(substr($post->img,0,4)=='http') ?($post->img) : (Storage::url($post->img))}}"
                        alt="{{$post->title}}">
                    <div class="card-body">
                        <h5 class="card-title">{{$post->title}}</h5>
                        <p class="card-text">
                            <p class="text-muted m-0">Autore: {{$post->user->name}}</p>
                            <p class="text-muted m-0">Data pubblicazione: {{$post->created_at}}</p>
                            <p class="text-muted m-0">Data ultima modifica: {{$post->updated_at}}</p>
                        </p>
                        <p class="card-text">{{Str::substr($post->body,0,100).'...'}}</p>
                        <a href="{{route('guest.post.show',$post->slug)}} " class="btn btn-primary">Read More...</a>
                    </div>
                </div>

            </div>
            @endforeach
        </div>

    </div>

</div>

@endsection