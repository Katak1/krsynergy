@extends('layouts.app')
@section('content')

<div class="index_post">

        
        <div class="container py-5">
            <div class="row">
                <div class="col-md-12">
                    <div id="success_message"></div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">Category</th>
                                </tr>
                                </thead>
                                <tbody id="dynamic-row">
                                <tr>
                                    <th scope="row">{{$posts->id}}</th>
                                    <td>{{$posts->title}}</td>
                                    <td>{{$posts->content}}</td>
                                    <td>{{$posts->category_id}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Comment</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function (){
            
        });
    </script>
@endsection



