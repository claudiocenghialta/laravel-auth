@extends('layouts.app')
@section('content')
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action=" {{route('posts.update', $post->id)}} " method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="title">Titolo</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Titolo"
                value="{{$post->title}}"">
        </div>
        <div class=" form-group">
            <label for="body">Testo del post</label>
            <textarea class="form-control" id="body" name="body" rows="3"
                placeholder="Testo del post">{{$post->body}}</textarea>
        </div>
        <div class="btn-group-toggle">
            @foreach ($tags as $tag)
            <label class="" for="tag">
                <input type="checkbox" name="tags[]" value="{{$tag->id}}"
                    {{($post->tags->contains($tag->id))?'checked':''}}>
                {{$tag->name}}
            </label>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>
@endsection