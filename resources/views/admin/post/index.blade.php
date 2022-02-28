@extends('layouts.admin')

@section('content')
    {{-- Create Posts   --}}
    <div class="modal fade"  id="CreatePostModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog " >
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Categories</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" >
                    <ul id="saveform_errList"></ul>
                    <div class="form-group mb-3">
                        <label for="">Title
                            <input type="text" class="title form-control">
                        </label>
                        <label for="">Content
                            <input type="text" class="post_content form-control">
                        </label>
                        <label for="category">Category</label>
                        <select class="category_id form-control" id="category_id" name="category_id">
                            @foreach($category as $categories)
                                <option
                                    {{old('category_id')==$categories->id ? ' selected':''}}

                                    value="{{$categories->id}}">{{$categories->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary create_post">Create</button>
                </div>
            </div>
        </div>
    </div>
    {{--End create Posts--}}


    {{--Edit Posts--}}

    <div class="modal fade" id="EditPostModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit & Update Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <ul id="updateform_errList"></ul>

                    <input type="hidden" id="edit_post_id">
                    <div class="form-group mb-3">
                        <label for="">Title
                            <input type="text" class="edit_post_title form-control" id="edit_post_title">
                        </label>
                        <label for="">Content
                            <input type="text" class="edit_post_content form-control" id="edit_post_content">
                        </label>
                        <label for="category">Category</label>
                        <select class="category_id form-control" id="edit_category_id" name="category_id">
                            @foreach($category as $categories)
                                <option
                                    {{old('category_id')==$categories->id ? ' selected':''}}

                                    value="{{$categories->id}}">{{$categories->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update_post">Update</button>
                </div>
            </div>
        </div>
    </div>

    {{--End edit Post--}}

    {{--Delete Post--}}

    <div class="modal fade" id="DeletePostModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="delete_post_id">

                    <h4>Are you sure? want to delete this data</h4>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary delete_post">Yes Delete</button>
                </div>
            </div>
        </div>
    </div>

    {{--End delete Post--}}


    <div class="index_post">

        <div class="container py-5">
            <div class="row">
                <div class="col-md-12">
                    <div id="success_message"></div>
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Posts
                                <a type="button" href="#" class="btn btn-primary float-end btn-sm ml-3" data-bs-toggle="modal" data-bs-target="#CreatePostModal">Create Posts</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
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

            fetchpost();

            function fetchpost(){
                $.ajax({
                    type:"GET",
                    url: "fetch-post",
                    dataType:"json",
                    success: function (response){
                        $('tbody').html("")
                        $.each(response.posts,function (key,item){
                            $('tbody').append('<tr>\
                                <th scope="row">'+item.id+'</th>\
                            <td>'+item.title+'</td>\
                            <td>'+item.content+'</td>\
                            <td>'+item.category_id+'</td>\
                            <td><button type="button" value="'+item.id+'" class="edit_posts btn btn-primary btn-small">Edit</button></td>\
                            <td><button type="button" value="'+item.id+'" class="delete_posts btn btn-danger btn-small">Delete</button></td>\
                        </tr>')
                        })
                    }
                })
            }

            $(document).on('click', '.delete_posts',function (e){
                e.preventDefault();
                var post_id = $(this).val();
                // alert(category_id);

                $('#delete_post_id').val(post_id);
                $('#DeletePostModal').modal('show');

            })
            $(document).on('click', '.delete_post',function (e){
                e.preventDefault();
                var post_id = $('#delete_post_id').val();
                $(this).text('Deleting');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type:"DELETE",
                    url: "post/"+post_id,
                    success:function (response){
                        // console.log(response);
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#DeletePostModal').modal('hide');
                        $('.delete_category').text('Yes delete');
                        fetchpost();
                    }
                })

            })

            $(document).on('click', '.edit_posts',function (e){
                e.preventDefault();
                var post_id = $(this).val();

                $('#EditPostModal').modal('show');
                $.ajax({
                    type:"GET",
                    url: "post/"+post_id,
                    success:function (response){
                        if (response.status==404) {
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-danger');
                            $('#success_message').text(response.message);
                        }else{
                            $('#edit_post_title').val(response.posts.title);
                            $('#edit_post_content').val(response.posts.content);
                            $('#edit_category_id').val(response.posts.category_id);
                            $('#edit_post_id').val(post_id);
                        }
                    }
                })
            })

            $(document).on('click', '.update_post',function (e){
                e.preventDefault();
                $(this).text('Updating');
                var post_id = $('#edit_post_id').val();
                var data = {
                    'title': $('.edit_post_title').val(),
                    'content': $('.edit_post_content').val(),
                    'category_id': $('.edit_category_id').val(),
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type:'PATCH',
                    url:'post/'+post_id,
                    data:data,
                    dataType:'json',
                    success:function (response){
                        // console.log(response)
                        if(response.status==400){
                            $('#updateform_errList').html('');
                            $('#updateform_errList').addClass('alert alert-danger');
                            $.each(response.errors,function (key,errors){
                                $('#updateform_errList').append('<li class="ml-3">'+errors+'</li>');
                            })
                            $('.update_category').text("Update");
                        }else if(response.status==404){
                            $('#updateform_errList').html('');
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('.update_post').text("Update");
                        } else {
                            $('#saveform_errList').html('');
                            $('#success_message').html('');
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('.update_post').text("Update");
                            $('#EditPostModal').modal('hide');
                            fetchpost();
                        }

                    }
                })
            })


            $(document).on('click','.create_post',function (e){
                e.preventDefault();

                var data = {
                    'title': $('.title').val(),
                    'content': $('.post_content').val(),
                    'category_id': $('.category_id').val(),
                }
                console.log(data)


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type:'POST',
                    url:'post',
                    data:data,
                    datatype:'json',
                    success: function (response){
                        if(response.status == 400){
                            $('#saveform_errList').html('');
                            $('#saveform_errList').addClass('alert alert-danger');
                            $.each(response.errors,function (key,errors){
                                $('#saveform_errList').append('<li class="ml-3">'+errors+'</li>');
                            });
                        }else {
                            $('#saveform_errList').html('');
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('#CreatePostModal').modal('hide');
                            $('#CreatePostModal').find('input').val('');
                            fetchpost();
                        }
                    }
                })

            });

        });
    </script>
@endsection
