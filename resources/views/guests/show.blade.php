@extends('layouts.app')
@section('content')

<div class="container">
    <img class="img-fluid rounded mx-auto"
        src="{{(substr($post->img,0,4)=='http') ?($post->img) : (Storage::url($post->img))}}" alt="{{$post->title}}">
    <h1 class="card-title">{{$post->title}}</h1>
    <p class="">
        <small class="text-muted mr-5">Autore: {{$post->user->name}}</small>
        <small class="text-muted mr-5">Data pubblicazione: {{$post->created_at}}</small>
        <small class="text-muted mr-5">Data ultima modifica: {{$post->updated_at}}</small>
    </p>
    <p class="">{{$post->body}}</p>

</div>


@endsection