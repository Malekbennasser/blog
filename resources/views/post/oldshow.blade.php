@extends('layouts.app')
@section('title', "$post->title")
@section('content')

    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
    </head>
    <h1>test</h1>
    <div class="d-flex justify-content-center align-item-center">
        <div class="row content">
            <div class="col-sm-9">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="card p-3">
                                <img src="/images/{{ $post->image }}" class="img-fluid" alt="Image">
                                <h2>{{ $post->title }}</h2>
                                <h5>
                                    {{-- USERNAME --}}
                                    <span class="glyphicon glyphicon-time"></span> Post by {{ $post->user->username }}
                                    {{ date('d/m/Y ', strtotime($post->created_at)) }} at
                                    {{ date('H:i', strtotime($post->created_at)) }}
                                </h5>
                                <br />
                                <p class="fw-normal">
                                    {{ $post->content }}
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet voluptatem
                                    necessitatibus dolores totam unde eligendi impedit, sit doloremque, asperiores quibusdam
                                    in dicta dignissimos expedita autem reiciendis soluta obcaecati vitae similique?
                                </p>
                                @auth
                                    @if ($post->user_id == Auth::user()->id)
                                        <div class="d-flex justify-content-start ms-5 gap-3 ">
                                            <a href={{ route('posts.edit', ['post' => $post->id]) }}>

                                                <button type="button" class="btn  btn-dark  ">
                                                    <i class="fas fa-magic"></i>
                                                </button>
                                            </a>

                                            <form action={{ route('posts.destroy', ['post' => $post->id]) }} method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn  btn-dark  ">
                                                    <i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    @endif
                                    <h4 class="">Leave a Comment:</h4>
                                    <form action={{ route('post.comment', ['postId' => $post->id]) }} method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <textarea class="form-control" rows="3" name="content"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-dark ms-5 mb-5">Submit</button>
                                    </form>
                                    <br /><br />
                                @endauth
                                <p><span class="badge">{{ $commentsCount }}</span> Comments:</p>
                                <br />
                                {{-- Comment section for the foreach --}}
                                @foreach ($comments as $comment)
                                    <div class="row">
                                        <div class="col-sm-2 text-center">
                                            <img src="https://images.unsplash.com/photo-1575936123452-b67c3203c357?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8aW1hZ2V8ZW58MHx8MHx8fDA%3D&w=1000&q=80"
                                                class="img-circle" height="65" width="65" alt="Avatar" />
                                        </div>
                                        <div class="col-sm-10">
                                            <h4 class="d-inline">{{ $comment->user->username }}
                                                <small>{{ $comment->created_at }}</small>
                                            </h4>
                                            <p>
                                                {{ $comment->content }} Lorem ipsum dolor sit amet consectetur adipisicing
                                                elit. Earum fuga, blanditiis alias aperiam in possimus quos sunt a odio
                                                quod. Asperiores perspiciatis distinctio rem error, harum totam libero
                                                numquam in?
                                            </p>
                                            @auth
                                                @if ($post->user_id == Auth::user()->id)
                                                    <form
                                                        action={{ route('delete.comment', ['postId' => $post->id, 'id' => $comment->id]) }}
                                                        method="post" class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <h6><button type="submit" class="btn btn-sm btn-link">Delete</button>
                                                        </h6>
                                                    </form>
                                                @endif
                                            @endauth

                                            <br />
                                        </div>

                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- clasic BOOTSRAP -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endsection
