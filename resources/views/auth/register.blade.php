@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                        <div class="card-header">{{ __('Register') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="name"
                                           class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text"
                                               class="form-control @error('name') is-invalid @enderror" name="name"
                                               value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="surname"
                                           class="col-md-4 col-form-label text-md-end">{{ __('Surname') }}</label>

                                    <div class="col-md-6">
                                        <input id="surname" type="text"
                                               class="form-control @error('surname') is-invalid @enderror"
                                               name="surname" value="{{ old('surname') }}" required
                                               autocomplete="surname" autofocus>

                                        @error('surname')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="email"
                                           class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                               class="form-control @error('email') is-invalid @enderror" name="email"
                                               value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="passport_number"
                                           class="col-md-4 col-form-label text-md-end">{{ __('Passport number') }}</label>

                                    <div class="col-md-6">
                                        <input id="passport_number" type="number"
                                               class="form-control @error('passport_number') is-invalid @enderror"
                                               name="passport_number" value="{{ old('passport_number') }}" required
                                               autocomplete="passport_number" autofocus>

                                        @error('passport_number')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>


{{--                                <div class="row mb-3">--}}
{{--                                    <label for="password"--}}
{{--                                           class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>--}}

{{--                                    <div class="col-md-6">--}}
{{--                                        <input id="password" type="password"--}}
{{--                                               class="form-control @error('password') is-invalid @enderror"--}}
{{--                                               name="password" required autocomplete="new-password">--}}

{{--                                        @error('password')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="row mb-3">--}}
{{--                                    <label for="password-confirm"--}}
{{--                                           class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>--}}

{{--                                    <div class="col-md-6">--}}
{{--                                        <input id="password-confirm" type="password" class="form-control"--}}
{{--                                               name="password_confirmation" required autocomplete="new-password">--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary btn-submit">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".btn-submit").click(function (e) {
                e.preventDefault();

                let _token = $("input[name='_token']").val();
                let email = $("#email").val();
                let password = $("#password").val();
                let password_confirm = $("#password-confirm").val();

                $.ajax({
                    url: "{{ route('register') }}",
                    type: 'POST',
                    data: {_token: _token, email: email, password: password, password_confirm: password_confirm},
                    success: function (data) {
                        printMsg(data);
                    }
                });
            });

            function printMsg(msg) {
                if ($.isEmptyObject(msg.error)) {
                    console.log(msg.success);
                    $('.alert-block').css('display', 'block').append('<strong>' + msg.success + '</strong>');
                } else {
                    $.each(msg.error, function (key, value) {
                        $('.' + key + '_err').text(value);
                    });
                }
            }
        });

    </script>
@endsection
