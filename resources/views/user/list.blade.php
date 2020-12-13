@extends('layout')
@section('main-content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">User</li>
                </ol>
            </div>
            <h4 class="page-title">User</h4>
        </div>
        <form action="{{ route('user.list') }}" method="GET">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 form-group username">
                            <label>Username</label>
                            <input type="text" name="username" id="username" class="form-control" @if (!empty($inputSearch['username'])) value="{{ $inputSearch['username'] }}" @endif/>
                            <button type="button" class="close cls-username" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="col-3 form-group full_name">
                            <label>Full name</label>
                            <input type="text" name="full_name" id="full_name" class="form-control" @if (!empty($inputSearch['full_name'])) value="{{ $inputSearch['full_name'] }}" @endif/>
                            <button type="button" class="close cls-fullName" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="col-3 form-group email">
                            <label>Email</label>
                            <input type="text" name="email" id="email" class="form-control" @if (!empty($inputSearch['email'])) value="{{ $inputSearch['email'] }}" @endif/>
                            <button type="button" class="close cls-email" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="col-3 form-group phone">
                            <label>Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" @if (!empty($inputSearch['phone'])) value="{{ $inputSearch['phone'] }}" @endif/>
                            <button type="button" class="close cls-phone" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('user.list') }}" class="mr-1 btn btn-secondary waves-effect waves-light"><i class="fas fa-redo-alt"></i> Reset</a>
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
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Username</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($users) > 0)
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->full_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td class="text-center">
                                        <a href="javascript:void(0);" class="btn btn-secondary btn-sm waves-effect waves-light btn-delete" data-id="{{ $user->id }}"><i class="fas fa-trash"></i></a>
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
                    @if(count($users) > 0)
                    <div class="d-flex justify-content-between" style="margin-top: 0.3rem">
                        <div style="padding: .5rem .75rem; margin-bottom: 1rem;">
                            Show {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries
                        </div>
                        <div>
                            {{ $users->onEachSide(1)->withQueryString()->links() }}
                        </div>
                    </div>
                    @endif
                </div>
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
    .username,
    .full_name,
    .email,
    .phone {
        position: relative;
    }

    .close {
        display: none;
        position: absolute;
        bottom: 1.4px;
        right: 4px;
        font-size: 18px;
        padding: 0.5rem 0.5rem !important;
        color: inherit;
        margin-right: 10px;
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

        $('#username').focus();

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

        // Close email
        if ($('#email').val()) {
            $('.cls-email').show();
            $('#email').blur();
        }

        $('#email').keydown(function() {
            $('.cls-email').show();
        });

        $('.cls-email').click(function() {
            $('#email').val('');
            $(this).hide();
        });

        // Close phone
        if ($('#phone').val()) {
            $('.cls-phone').show();
            $('#phone').blur();
        }

        $('#phone').keydown(function() {
            $('.cls-phone').show();
        });

        $('.cls-phone').click(function() {
            $('#phone').val('');
            $(this).hide();
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
                        url: "{!! route('user.delete') !!}",
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
