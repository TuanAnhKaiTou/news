@extends('layout')
@section('main-content')
<div class="row">

        <div class="col-lg-6">
            <div class="page-title-box">
                <h4 class="page-title">
                    Detail Admin
                </h4>
            </div>
            <form action="{{ route('admin.update', ['id' => Auth::id()]) }}" method="post">
                @csrf
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 form-group">
                                <label>Username</label>
                                <input type="text" name="username" id="username" class="form-control" required placeholder="Enter username" @isset($admin) readonly value="{{ $admin->username }}" @endisset/>
                            </div>
                            <div class="col-4 form-group">
                                <label>Full Name</label>
                                <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Enter full name" @isset($admin) value="{{ $admin->full_name }}" @endisset/>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-2" style="margin-left: auto">
                                <button type="submit" class="btn btn-primary waves-effect waves-light btn-block">
                                    Save
                                </button>
                            </div>
                            <div class="col-2">
                                <a href="{{ route('news.list') }}" class="btn btn-secondary waves-effect waves-light btn-block">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-6">
            <div class="page-title-box">
                <h4 class="page-title">
                    Change Password
                </h4>
            </div>
            <form action="{{ route('admin.change') }}" method="post">
                @csrf
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" name="id" value="{{ Auth::id() }}">
                            <div class="col-4 form-group">
                                <label>Old password <span style="color: red">*</span></label>
                                <input type="password" name="old_pass" id="old_pass" class="form-control" required placeholder="Enter old password"/>
                                <span toggle="#old_pass" class="fa fa-eye old_pass eyes"></span>
                            </div>
                            <div class="col-4 form-group">
                                <label>New password <span style="color: red">*</span></label>
                                <input type="password" name="new_pass" id="new_pass" class="form-control" minlength="6" maxlength="20" placeholder="Enter new password"/>
                                <span toggle="#new_pass" class="fa fa-eye new_pass eyes"></span>
                            </div>
                            <div class="col-4 form-group">
                                <label>Confirm new password <span style="color: red">*</span></label>
                                <input type="password" name="confirm_pass" id="confirm_pass" class="form-control" minlength="6" maxlength="20" placeholder="Enter confirm new password"/>
                                <span toggle="#confirm_pass" class="fa fa-eye confirm_pass eyes"></span>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-2" style="margin-left: auto">
                                <button type="submit" class="btn btn-primary waves-effect waves-light btn-block">
                                    Save
                                </button>
                            </div>
                            <div class="col-2">
                                <a href="{{ route('news.list') }}" class="btn btn-secondary waves-effect waves-light btn-block">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
</div>
@endsection

@section('css')
    <!-- Alertify -->
    <link href="{{ asset('assets/libs/alertify/alertify.css') }}" rel="stylesheet" type="text/css" />

<style>
    .eyes {
        float: right;
        margin-top: -24px;
        padding-right: 8px;
        opacity: 0.8;
    }
</style>
@endsection

@section('js')
    <!-- Alertify -->
    <script src="{{ asset('assets/libs/alertify/alertify.js') }}"></script>
@endsection

@section('custom-js')
<script type="text/javascript">
    $(document).ready(function() {
        @if (session('status'))
            @if (session('status') == 'success')
                alertify.success("{!! session('msg') !!}");
            @else
                alertify.error("{!! session('msg') !!}");
            @endif
        @endif

        @error('username')
            alertify.error("{!! $message !!}");
        @enderror

        @error('full_name')
            alertify.error("{!! $message !!}");
        @enderror

        $(".old_pass").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

        $(".new_pass").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

        $(".confirm_pass").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

        $('#confirm_pass').keyup(function() {
            if ($('#new_pass').val() == $('#confirm_pass').val()) {
                $('#confirm_pass').css('border-color', '#69d069');
                $('#confirm_pass')[0].setCustomValidity('');
            } else {
                $('#confirm_pass')[0].setCustomValidity("Password Don't Match");
                $('#confirm_pass').css('border-color', '#f58787');
            }
        });

    });
</script>
@endsection
