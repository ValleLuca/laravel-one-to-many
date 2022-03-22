@extends('layouts.app')

@section('addpost')
    <h1 class="text-center">Crea post</h1>  

    <form action="{{route("admin.post.update", $post->id)}}" method="POST">
        
        @csrf
        @method('PUT')

        <div class="form-group text-center">
            <label for="title">Titolo</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror text-center" id="title" name="title" placeholder="Inserisci il nome del post"  value="{{old("title")??$post->title}}">
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group text-center">
            <label for="content">content</label>
            <textarea class="form-control text-center" id="content" name="content" placeholder="Inserisci la descrizione del post">{{old("content")??$post->content}}</textarea>
            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <select name="category_id" id="">
                <option value="">----</option>
                @foreach ($post as $element)
                <option value="{{$element->id}}">{{$element->type}}</option>
                @endforeach
            </select>
        </div> 

        <div class="text-center">
            <span><a href="{{route("admin.post.index")}}"><button type="button" class="btn btn-primary">Indietro</button></a></span>
            <span><button type="submit" class="btn btn-primary">Salva modifiche</button></span>
        </div>
        
    </form>
@endsection