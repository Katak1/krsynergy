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


                        <form action="{{route('comm.store', $posts->id)}}" method="POST">
                            @csrf
                            <div class="form-group d-grid">
                                <label for="comment">Comment</label>
                                <textarea name="message" id="comment" class="form-control" placeholder="Write your message"></textarea>
                            </div>
                            <input type="submit" class="btn btn-primary create_comment mt-3">
                        </form>

                        <div class="mt-5"><h5>Comments</h5></div>
                    <div class="card mt-3">

                                @foreach($comment as $comments)
                                    <div class="card bg-white p-2 px-4">
                                     <div class="mt-2">
                                            <div class="d-flex flex-row align-items-center">
                                                <h5 class="mr-2">Author: {{$comments->user->name}}</h5>
                                            </div>
                                            <span>{{$comments->message}}</span>

                                     </div>
                                         <form action="{{route('comm.delete', [$posts->id, $comments->id])}}" method="POST">
                                             @csrf
                                             @method("DELETE")
                                             <button type="submit" class="btn btn-primary mt-3">Delete</button>
                                         </form>
                                    </div>

                             @endforeach

                        <div>
                </div>
                </div>
            </div>
        </div>

@endsection

{{--@section('script')--}}
{{--    <script>--}}
{{--        $(document).ready(function (){--}}


{{--            $(document).on('click','.create_comment',function (e){--}}
{{--                e.preventDefault();--}}

{{--                var data = {--}}
{{--                    'comm_body': $('.comment_body').val(),--}}
{{--                    'post_id': $('.post_id').val()--}}

{{--                }--}}
{{--                console.log(data)--}}



{{--                $.ajaxSetup({--}}
{{--                    headers: {--}}
{{--                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                    }--}}
{{--                });--}}


{{--                $.ajax({--}}
{{--                    type:'POST',--}}
{{--                    url:'{{route('comm.store', $posts->id)}}',--}}
{{--                    data:data,--}}
{{--                    datatype:'json',--}}

{{--                })--}}

{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--@endsection--}}



