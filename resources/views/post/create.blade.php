@extends('layouts.app')
@section('title', 'Create post')
@section('content')

    <section class="vh-100" style="background-color: #eee;">
        <div class="container ">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-9">

                    <h1 class="my-4">Create a post</h1>

                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body">
                            <form action="{{ route('posts.index') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row align-items-center pt-4 pb-3">
                                    <div class="col-md-3 ps-5">

                                        <h6 class="mb-0">Title</h6>

                                    </div>
                                    <div class="col-md-9 pe-5">

                                        <input type="text" class="form-control form-control-lg" name="title"
                                            placeholder="Title" value="{{ old('title') }}" />

                                    </div>
                                </div>

                                <hr class="mx-n3">

                                <div class="row align-items-center py-3">
                                    <div class="col-md-3 ps-5">

                                        <h6 class="mb-0">Content</h6>

                                    </div>
                                    <div class="col-md-9 pe-5">

                                        <textarea class="form-control" rows="5" placeholder="Write your post" name="content">{{ old('content') }}</textarea>

                                    </div>
                                </div>

                                <hr class="mx-n3">

                                <div class="row align-items-center py-3">
                                    <div class="col-md-3 ps-5">

                                        <h6 class="mb-0">Picture</h6>

                                    </div>
                                    <div class="col-md-9 pe-5">

                                        <input class="form-control form-control-lg" id="formFileLg" type="file"
                                            name="image" />
                                        <div class="small text-muted mt-2">Upload your image. Max file
                                            size 2 MB</div>

                                    </div>
                                </div>

                                <hr class="mx-n3">

                                <div class="px-5 py-4">
                                    <button type="submit" class="btn btn-dark btn-lg btn-block">Create</button>
                                </div>
                            </form>
                            @if ($errors->any())
                                <div class="errors">

                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
