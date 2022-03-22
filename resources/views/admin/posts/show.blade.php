@extends('layouts.app')

@section('show')

    <div class="text-center">
        <h1>{{$post->title}}</h1>
        <p>{{$post->description}}</p>
        <p>{{$post->slug}}</p>
        <p>{{$post->category_id}}</p>


        <form action="{{route("admin.post.destroy", $post->id)}}" method="POST">
            @csrf
            @method("DELETE")
            <button type="submit" class="btn btn-danger">Cancella</button>
        </form>

        <a href="{{route("admin.post.index")}}"><button type="button" class="btn btn-primary mt-1">Indietro</button></a>
    </div>

        
@endsection