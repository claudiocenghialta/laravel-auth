@extends('layouts.app')
@section('content')
<div class="container">
    @if (session('status'))
    <div class="alert alert-success"> {{ session('status') }} </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Titolo</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <th scope="row">{{$post->id}}</th>
                <td>{{$post->title}}</td>
                <td><a href="">Edit</a></td>
                <td>
                    <form action="{{route('posts.destroy', $post->id)}} " method="post">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection