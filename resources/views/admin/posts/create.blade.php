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
    <form action=" {{route('posts.store')}} " method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="title">Titolo</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Titolo">
        </div>
        <div class="form-group">
            <label for="img">Immagine</label>
            <input type="file" class="form-control-file" name="img" accept="image/*">
        </div>
        <div class="form-group">
            <label for="body">Testo del post</label>
            <textarea class="form-control" id="body" name="body" rows="3" placeholder="Testo del post"></textarea>
        </div>

        <div class="btn-group-toggle">
            @foreach ($tags as $tag)
            <label class="" for="tag">
                <input type="checkbox" name="tags[]" value="{{$tag->id}}">
                {{$tag->name}}
            </label>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>
@endsection