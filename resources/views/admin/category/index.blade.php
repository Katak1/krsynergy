@extends('layouts.admin')

@section('content')
{{-- Create category   --}}
        <div class="modal fade" id="CreateCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Categories</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul id="saveform_errList"></ul>
                        <div class="form-group mb-3">
                            <label for="">Title
                                <input type="text" class="title form-control">
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary create_category">Create</button>
                    </div>
                </div>
            </div>
        </div>
{{--End create category--}}


{{--Edit category--}}

        <div class="modal fade" id="EditCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit & Update Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <ul id="updateform_errList"></ul>

                        <input type="hidden" id="edit_category_id">
                        <div class="form-group mb-3">
                            <label for="">Title</label>
                            <input type="text" id="edit_title" class="update form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary update_category">Update</button>
                    </div>
                </div>
            </div>
        </div>

{{--End edit category--}}

{{--Delete category--}}

<div class="modal fade" id="DeleteCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <input type="hidden" id="delete_category_id">

                <h4>Are you sure? want to delete this data</h4>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary delete_category">Yes Delete</button>
            </div>
        </div>
    </div>
</div>

{{--End delete category--}}


    <div class="index_category">

        <div class="container py-5">
            <div class="row">
                <div class="col-md-12">
                    <div id="success_message"></div>
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Categories
                                <a type="button" href="#" class="btn btn-primary float-end btn-sm ml-3" data-bs-toggle="modal" data-bs-target="#CreateCategoryModal">Create Categories</a>
                            </h4>
                        </div>
                        <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Title</th>
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

            fetchcategory();

            function fetchcategory(){
                $.ajax({
                    type:"GET",
                    url: "fetch-category",
                    dataType:"json",
                    success: function (response){
                        $('tbody').html("")
                        $.each(response.categories,function (key,item){
                            $('tbody').append('<tr>\
                                <th scope="row">'+item.id+'</th>\
                            <td>'+item.title+'</a></td>\
                            <td><button type="button" value="'+item.id+'" class="edit_categories btn btn-primary btn-small">Edit</button></td>\
                            <td><button type="button" value="'+item.id+'" class="delete_categories btn btn-danger btn-small">Delete</button></td>\
                        </tr>')
                        })
                    }
                    })
            }

            $(document).on('click', '.delete_categories',function (e){
                e.preventDefault();
                var category_id = $(this).val();
                // alert(category_id);

                $('#delete_category_id').val(category_id);
                $('#DeleteCategoryModal').modal('show');

            })
            $(document).on('click', '.delete_category',function (e){
                e.preventDefault();
                var category_id = $('#delete_category_id').val();
                $(this).text('Deleting');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type:"DELETE",
                    url: "category/"+category_id,
                    success:function (response){
                        // console.log(response);
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#DeleteCategoryModal').modal('hide');
                        $('.delete_category').text('Yes delete');
                        fetchcategory();
                    }
                })

            })

            $(document).on('click', '.edit_categories',function (e){
                e.preventDefault();
                var category_id = $(this).val();

                $('#EditCategoryModal').modal('show');
                $.ajax({
                    type:"GET",
                    url: "category/"+category_id,
                    success:function (response){
                        // console.log(response)
                        if (response.status==404) {
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-danger');
                            $('#success_message').text(response.message);
                        }else{
                            $('#edit_title').val(response.categories.title);
                            $('#edit_category_id').val(category_id);
                        }
                    }
                })
            })

            $(document).on('click', '.update_category',function (e){
                e.preventDefault();
                $(this).text('Updating');
                var category_id = $('#edit_category_id').val();
                var data = {
                    'title':$('#edit_title').val(),
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type:'PATCH',
                    url:'category/'+category_id,
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
                            $('.update_category').text("Update");
                        } else {
                            $('#saveform_errList').html('');
                            $('#success_message').html('');
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('.update_category').text("Update");
                            $('#EditCategoryModal').modal('hide');
                            fetchcategory();
                        }

                    }
                })
            })


           $(document).on('click','.create_category',function (e){
                e.preventDefault();

                var data = {
                    'title': $('.title').val(),
                }

               $.ajaxSetup({
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
               });

                $.ajax({
                    type:'POST',
                    url:'category',
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
                            $('#CreateCategoryModal').modal('hide');
                            $('#CreateCategoryModal').find('input').val('');
                            fetchcategory();
                        }
                    }
                })

           });

        });
    </script>
@endsection
