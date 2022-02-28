@extends('layouts.app')

@section('content')
    {{--       Edit Account             --}}

    <div class="modal fade" id="EditAccountModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit & Update Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <ul id="updateform_errList"></ul>

                    <div class="form-group mb-3">
                        <label for="">Name:
                            <input type="text" class="edit_name form-control" id="edit_post_title">
                        </label>
                        <label for="">Surname:
                            <input type="text" class="edit_surname form-control" id="edit_post_content">
                        </label>
                        <label for="">Email:
                            <input type="email" class="edit_email form-control" id="edit_post_content">
                        </label>
                        <label for="">Passport number:
                            <input type="number" class="edit_passport form-control" id="edit_post_content">
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update_account">Update</button>
                </div>
            </div>
        </div>
    </div>

    {{--        End EDIT ACCOUNT            --}}

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Account') }}
                        <a type="button" href="#" class="btn btn-primary float-end btn-sm ml-3" data-bs-toggle="modal"
                           data-bs-target="#EditAccountModal">Edit account</a>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div id="account">
                            <div class="card-body">
                                <ul class="acc_body list-group">
                                    <li class="list-group-item">
                                        Name: {{Auth::user()->name}}
                                    </li>
                                    <li class="list-group-item">
                                        Surname: {{Auth::user()->surname}}
                                    </li>
                                    <li class="list-group-item">
                                        Email: {{Auth::user()->email}}
                                    </li>
                                    <li class="list-group-item">
                                        Passport Number: {{Auth::user()->passport_number}}
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {

            $(document).on('click', '.update_account',function (e){
                e.preventDefault();
                $(this).text('Updating');
                var account_id = {{Auth::user()->id}}



                var data = {
                    'name': $('.edit_name').val(),
                    'surname': $('.edit_surname').val(),
                    'email': $('.edit_email').val(),
                    'passport_number': $('.edit_passport').val(),
                }



                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type:'PATCH',
                    url:'account/'+account_id,
                    data:data,
                    dataType:'json',
                    success:function (response){
                        if(response.status==400){
                            $('#updateform_errList').html('');
                            $('#updateform_errList').addClass('alert alert-danger');
                            $.each(response.errors,function (key,errors){
                                $('#updateform_errList').append('<li class="ml-3">'+errors+'</li>');
                            })
                            $('.update_account').text("Update");
                        } else {
                            $('#saveform_errList').html('');
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('#EditAccountModal').modal('hide');
                            location.reload();

                        }


                    }
                })
            })
        })

    </script>
@endsection
