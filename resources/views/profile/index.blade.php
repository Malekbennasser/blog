@extends('layouts.app')
@section('title', 'Profile')
@section('content')

    <section class="vh-100">
        <div class="container py-5 ">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-6 mb-4 mb-lg-0">
                    <div class="card mb-3" style="border-radius: .5rem;">
                        <div class="row g-0">
                            <div class="col-md-4 gradient-custom text-center "
                                style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                <img src="/images/{{ Auth::user()->picture }}" alt="Avatar" class="img-fluid my-5"
                                    style="width: 80px;" />

                                <p>Blog member</p>
                                <a href="">
                                    <i class="far fa-edit mb-5"></i>
                                </a>

                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-4">
                                    <h6>Information</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3" style="min-width: 250px">
                                            <h6>Email</h6>
                                            <p class="text-muted">{{ Auth::user()->email }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Username</h6>
                                            <p class="text-muted">{{ Auth::user()->username }}</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
