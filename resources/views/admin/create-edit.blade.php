@extends('layout')
@section('main-content')
<form
    @if (isset($admin))
        action="{{ route('admin.edit', ['id' => $admin->id]) }}"
    @else
        action="{{ route('admin.store') }}"
    @endif method="POST">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.list') }}">Admin</a></li>
                        <li class="breadcrumb-item">
                            @if (isset($admin))
                                Update
                            @else
                                Create
                            @endif
                        </li>
                    </ol>
                </div>
                <h4 class="page-title">
                    @if (isset($admin))
                        Update
                    @else
                        Create
                    @endif
                </h4>
            </div>
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 form-group">
                            <label>Username @if (!isset($admin)) <span style="color: red">*</span> @endif</label>
                            <input type="text" name="username" id="username" class="form-control" required placeholder="Enter username" @isset($admin) readonly value="{{ $admin->username }}" @endisset/>
                        </div>
                        <div class="col-4 form-group">
                            <label>Full Name @if (!isset($admin)) <span style="color: red">*</span> @endif</label>
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
                            <a href="{{ route('admin.list') }}" class="btn btn-secondary waves-effect waves-light btn-block">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('css')
    <!-- Alertify -->
    <link href="{{ asset('assets/libs/alertify/alertify.css') }}" rel="stylesheet" type="text/css" />

<style>
</style>
@endsection

@section('js')
    <!-- Alertify -->
    <script src="{{ asset('assets/libs/alertify/alertify.js') }}"></script>
@endsection

@section('custom-js')
<script type="text/javascript">
    $(document).ready(function() {
        @error('username')
            alertify.error("{!! $message !!}");
        @enderror

        @error('full_name')
            alertify.error("{!! $message !!}");
        @enderror

        if ($('#username').val() == '') {
            $('#username').focus();
        }

    });
</script>
@endsection
