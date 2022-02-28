@extends('layouts.app')
@section('content')
    <div>
    <div class="body">
        <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
            <div class="col-md-6 px-0">
                <h1 class="display-4 fst-italic">Blog on laravel</h1>
                <p class="lead my-3">In this web application, you can create posts, leave comments and put likes under posts. Several technical functions have been implemented, such as data search, pagination and validation.</p>
                <p class="lead mb-0"><a href="#" class="text-white fw-bold">{{date('d/m/y')}}</a></p>
            </div>
        </div>
        <div class="d-flex">
        <div class="col-md-6 m-3 w-50 m-3">

            <div
                class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">

                    <strong class="d-inline-block mb-2 text-primary">{{$posts->category->title}}</strong>
                    <h3 class="mb-0">{{$posts->title}}</h3>
                    <div class="mb-1 text-muted">{{$posts->created_at}}</div>
                    <p class="card-text mb-auto">{{$posts->content}}</p>
{{--                    <a href="{{route('posts.show', $posts->id)}}" class="stretched-link">Continue reading</a>--}}
                </div>
                <div class="col-auto d-none d-lg-block">
                    <image class="bd-placeholder-img" width="250" height="250" src="{{$posts->image}}" alt=""><title>
                            Placeholder</title>
                        <rect width="100%" height="100%" fill="#55595c"></rect>
                        <text x="50%" y="50%" fill="#eceeef" dy=".3em"></text>
                    </image>

                </div>
            </div>
        </div>
        <div class="container p-3 justify-content-center">
            <div class="card p-3">
                <p>Contanct: +996555123456</p>
                <p>Mail: example@gmail.com</p>
                <p>Address: Some street</p>
            </div>
        </div>
        </div>
    </div>
    </div>
@endsection
