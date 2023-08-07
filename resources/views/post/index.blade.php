@extends('layouts.app')
@section('title', 'Home')
@section('content')

    @if (session()->has('message'))
        <div class="alert alert-primary" role="alert">
            <h2>{{ session()->get('message') }}</h2>
        </div>
    @endif

    <div class="row row-cols-1 row-cols-md-2 g-4 m-5">
        @foreach ($posts as $post)
            <div class="col">
                <div class="card">

                    <img src="/images/{{ $post->image }}" class="card-img-top" alt="Hollywood Sign on The Hill" />
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <h6>Posted by {{ $post->user->username }} </h6>

                        <p class="card-text">
                            <small class="text-muted">Last updated {{ $post->updated_at }}</small>
                        </p>
                        <p class="card-text">
                            {{ $post->content }}
                        </p>
                        @auth
                            @if ($post->user_id == Auth::user()->id)
                                <a href={{ route('posts.edit', ['post' => $post->id]) }}>
                                    <button type="button" class="btn btn-sm btn-dark btn-floating">
                                        <i class="fas fa-magic"></i>
                                    </button>
                                </a>

                                <form action={{ route('posts.destroy', ['post' => $post->id]) }} method="post"
                                    class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger btn-floating ">
                                        <i class="fas fa-trash"></i></button>
                                </form>
                            @endif
                        @endauth

                        <a href="{{ route('posts.show', $post->id) }}">
                            <button type="button" class="btn btn-sm btn-dark ">
                                Read more
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
