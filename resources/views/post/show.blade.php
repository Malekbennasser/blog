@extends('layouts.app')
@section('title', "$post->title")
@section('content')

    <!--Main layout-->
    <main class="mt-4 mb-5">
        <div class="container d-flex justify-content-center align-items-center">
            <!--Grid row-->
            <div class="row">

                <div class="test-cent">

                    <!--Grid column-->
                    <div class="col-md-8 mb-4 mx-auto">
                        <!--Section: Post data-mdb-->
                        <section class="border-bottom mb-4">
                            <div class="text-center">
                                <!-- Updated line -->
                                <img src="/images/{{ $post->image }}" class="img-fluid shadow-2-strong rounded-5 mb-4"
                                    alt="image" style="max-width: 400px;">
                            </div>
                            <h4>{{ $post->title }} This is a title of the article</h4>
                            <div class="row align-items-center mb-4">

                                <div class="col-lg-6 text-center text-lg-start mb-3 m-lg-0">
                                    <img src="/images/{{ $post->user->picture }}" class="rounded-5 shadow-1-strong me-2"
                                        height="35" alt="" loading="lazy" />
                                    <span> Published <u>{{ date('d/m/Y', strtotime($post->created_at)) }}</u> by</span>
                                    <a href="" class="text-dark">{{ $post->user->username }}</a>
                                </div>

                            </div>
                        </section>
                        <!--Section: Post data-mdb-->

                        <!--Section: Text-->
                        <section>
                            <p>
                                {{ $post->content }} Lorem ipsum, dolor sit amet consectetur adipisicing elit. Optio
                                sapiente molestias
                                consectetur. Fuga nulla officia error placeat veniam, officiis rerum laboriosam
                                ullam molestiae magni velit laborum itaque minima doloribus eligendi! Lorem ipsum,
                                dolor sit amet consectetur adipisicing elit. Optio sapiente molestias consectetur.
                                Fuga nulla officia error placeat veniam, officiis rerum laboriosam ullam molestiae
                                magni velit laborum itaque minima doloribus eligendi!
                            </p>
                            <!--Section: Leave a comment-->
                            <div class="d-flex justify-content-start  gap-3 ">

                                @auth
                                    @if ($post->user_id == Auth::user()->id)
                                        <a href={{ route('posts.edit', ['post' => $post->id]) }}>

                                            <button type="button" class="btn btn-sm  btn-dark  ">
                                                <i class="fas fa-magic"></i>
                                            </button>
                                        </a>

                                        <form action={{ route('posts.destroy', ['post' => $post->id]) }} method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm  btn-danger  ">
                                                <i class="fas fa-trash"></i></button>
                                        </form>
                                    @endif

                                    {{-- like --}}
                                    <form method="POST" action="{{ route('post.like', $post->id) }}">
                                        @csrf

                                        <button type="submit" class="btn btn-sm  btn-dark  ">

                                            @if (Auth::user()->likes &&
                                                    auth()->user()->likes()->where('post_id', $post->id)->exists())
                                                <i class="fas fa-thumbs-down text-danger"></i>
                                            @else
                                                <i class="fas fa-thumbs-up"></i>
                                            @endif

                                        </button>
                                    </form>
                                </div>
                            @endauth

                            <p class="text-left"><strong>{{ $likesCount }} likes</strong></p>

                            @auth
                                <h4 class="mt-3">Leave a Comment:</h4>
                                <form action={{ route('post.comment', ['postId' => $post->id]) }} method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" name="content"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-dark mt-3  mb-3">Submit</button>
                                </form>

                            @endauth
                            <!--Section: Leave a comment-->

                        </section>
                        <!--Section: Text-->

                        <!--Section: Comments-->
                        <section class="border-bottom mb-3">
                            <p class="text-left"><strong>{{ $commentsCount }} comments</strong></p>
                            @foreach ($comments as $comment)
                                <!-- Comment -->
                                <div class="row mb-4">
                                    <div class="col-2">
                                        <img src="/images/{{ $comment->user->picture }}"
                                            class="rounded-circle shadow-4-strong" height="65" width="65"
                                            alt="" />
                                    </div>

                                    <div class="col-10">
                                        <p class="mb-2"><strong>{{ $comment->user->username }}</strong>
                                            <small>{{ date('d/m/Y ', strtotime($comment->created_at)) }}</small>
                                        </p>

                                        <p>
                                            {{ $comment->content }} Lorem ipsum dolor sit amet consectetur adipisicing
                                            elit.
                                            Distinctio est ab iure
                                            inventore dolorum consectetur? Molestiae aperiam atque quasi consequatur aut?
                                            Repellendus alias dolor ad nam, soluta distinctio quis accusantium!
                                        </p>
                                        @auth
                                            @if ($comment->user_id == Auth::user()->id)
                                                <form
                                                    action={{ route('delete.comment', ['postId' => $post->id, 'id' => $comment->id]) }}
                                                    method="post" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <h6><button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                    </h6>
                                                </form>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                                <!-- Comment -->
                            @endforeach

                        </section>
                        <!--Section: Comments-->

                    </div>
                    <!--Grid column-->

                </div>

            </div>
            <!--Grid row-->
        </div>
    </main>
    <!--Main layout-->

@endsection
