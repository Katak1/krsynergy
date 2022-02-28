@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="posts">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Posts
                            <a type="button" href="{{route('admin.post.index')}}" class="btn btn-primary float-end btn-sm ml-3">View all posts</a>
                            </h4>
                        </div>
                        <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Title</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($posts as $post)
                                        <tr>
                                            <th scope="row">{{$post->id}}</th>
                                            <td>{{$post->title}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="categories">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Categories
                                <a type="button" href="{{route('admin.category.index')}}" class="btn btn-primary float-end btn-sm ml-3">View all category</a>
                            </h4>
                        </div>
                        <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Title</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                            @foreach($category as $categories)
                                    <tr>
                                        <th scope="row">{{$categories->id}}</th>
                                        <td>{{$categories->title}}</td>
                                    </tr>
                            @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
