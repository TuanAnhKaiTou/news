@extends('layout')
@section('main-content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">Admin</li>
                </ol>
            </div>
            <h4 class="page-title">Admin</h4>
        </div>
        <form action="{{ route('admin.list') }}" method="GET">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 form-group username">
                            <label>Username</label>
                            <input type="text" name="username" id="username" class="form-control" @if (!empty($inputSearch['username'])) value="{{ $inputSearch['username'] }}" @endif/>
                            <button type="button" class="close close-custom cls-username" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="col-4 form-group full_name">
                            <label>Full name</label>
                            <input type="text" name="full_name" id="full_name" class="form-control" @if (!empty($inputSearch['full_name'])) value="{{ $inputSearch['full_name'] }}" @endif/>
                            <button type="button" class="close close-custom cls-fullName" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('admin.list') }}" class="mr-1 btn btn-secondary waves-effect waves-light"><i class="fas fa-redo-alt"></i> Reset</a>
                                <button type="submit" class="btn btn-info waves-effect waves-light">
                                    <i class="fas fa-search"></i> Search
                                </button>
                            </div>
                        </div>
                        </div>
                </div>
            </div>
        </form>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <a href="{{ route('admin.create') }}" class="btn btn-success waves-effect waves-light mb-4"><i class="fas fa-plus"></i> Add New</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Username</th>
                                <th scope="col">Full Name</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($admins) > 0)
                                @foreach($admins as $admin)
                                <tr>
                                    <td>{{ $admin->username }}</td>
                                    <td>{{ $admin->full_name }}</td>
                                    <td class="text-center">
                                        <div>
                                            <a href="{{ route('admin.edit', ['id' => $admin->id]) }}" class="btn btn-warning btn-sm waves-effect waves-light"><i class="fas fa-edit"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-info btn-sm waves-effect waves-light btn-changePass" data-toggle="modal" data-target="#con-close-modal" data-id="{{ $admin->id }}"><i class=" fas fa-key"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-secondary btn-sm waves-effect waves-light btn-delete" data-id="{{ $admin->id }}"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                @if ($isSearch)
                                    @include('partials.no-data-search')
                                @else
                                    @include('partials.no-data')
                                @endif
                            @endif
                        </tbody>
                    </table>
                    @if(count($admins) > 0)
                    <div class="d-flex justify-content-between" style="margin-top: 0.3rem">
                        <div style="padding: .5rem .75rem; margin-bottom: 1rem;">
                            Show {{ $admins->firstItem() }} to {{ $admins->lastItem() }} of {{ $admins->total() }} entries
                        </div>
                        <div>
                            {{ $admins->onEachSide(1)->withQueryString()->links() }}
                        </div>
                    </div>
                    @endif
                </div>
                <form action="{{ route('admin.change') }}" method="POST">
                    @csrf
                    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Change Password</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <input type="hidden" name="id" id="admin-id">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="new_pass" class="control-label">New pass <span style="color: red">*</span></label>
                                                <input type="password" class="form-control" id="new_pass" name="new_pass" minlength="6" maxlength="20" required placeholder="Enter password">
                                                <span toggle="#new_pass" class="fa fa-eye new_pass eyes"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="confirm_pass" class="control-label">Confirm pass <span style="color: red">*</span></label>
                                                <input type="password" class="form-control" id="confirm_pass" required minlength="6" maxlength="20" placeholder="Enter confirm pass">
                                                <span toggle="#confirm_pass" class="fa fa-eye confirm_pass eyes"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
    <!-- Sweet Alert -->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Alertify -->
    <link href="{{ asset('assets/libs/alertify/alertify.css') }}" rel="stylesheet" type="text/css" />

<style>
    .btn-warning:hover {
        color: #fff;
    }

    .username,
    .full_name,
    .email,
    .phone {
        position: relative;
    }

    .close-custom {
        display: none;
        position: absolute;
        bottom: 1.4px;
        right: 4px;
        font-size: 18px;
        padding: 0.5rem 0.5rem !important;
        color: inherit;
        margin-right: 10px;
    }

    .eyes {
        float: right;
        margin-top: -24px;
        padding-right: 8px;
        opacity: 0.8;
    }
</style>
@endsection

@section('js')
    <!-- Sweet Alerts js -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

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

        focus();

        // Close username
        if ($('#username').val()) {
            $('.cls-username').show();
            $('#username').blur();
        }

        $('#username').keydown(function() {
            $('.cls-username').show();
        });

        $('.cls-username').click(function() {
            $('#username').val('');
            $(this).hide();
        });

        // Close full name
        if ($('#full_name').val()) {
            $('.cls-fullName').show();
            $('#full_name').blur();
        }

        $('#full_name').keydown(function() {
            $('.cls-fullName').show();
        });

        $('.cls-fullName').click(function() {
            $('#full_name').val('');
            $(this).hide();
        });

        $('.btn-changePass').click(function() {
            var mId = $(this).data('id');
            $('#admin-id').val(mId);
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

        $('.btn-delete').click(function() {
            var mId = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#23b397',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{!! route('admin.delete') !!}",
                        type: 'delete',
                        data: { id: mId }
                    }).done(function(response) {
                        Swal.fire({
                            title: response.title,
                            type: response.status,
                            text: response.msg
                        }).then((result) => {
                            location.reload();
                        });
                    });
                }
            });
        });
    });
</script>
@endsection
