@extends('layouts.app')

@section('center')
    <table class="table table-bordered border-primary">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">title</th>
                <th scope="col">content</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr class="text-center">
                    <th scope="row">{{$post->id}}</th>
                    <td class="align-middle">{{$post->title}}</td>
                    <td class="align-middle">{{$post->content}}</td>
                    <td class="align-middle">{{$post->slug}}</td>

                
                    <td class="align-middle">
                        <a href="{{route("admin.post.show", $post->id)}}"><button type="button" class="btn btn-primary mt-1">Vedi</button></a>
                        <a href="{{route("admin.post.edit", $post->id)}}"><button type="button" class="btn btn-warning mt-1">Modifica</button></a>
                        <form action="{{route("admin.post.destroy", $post->id)}}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-danger mt-1">Cancella</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <div class="text-center m-1">
            <a href="{{route("admin.post.create", $post->id)}}"><button type="button" class="btn btn-success">Aggiungi</button></a>
        </div>
    </table>
@endsection