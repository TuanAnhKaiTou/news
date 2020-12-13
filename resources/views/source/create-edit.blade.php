@extends('layout')
@section('main-content')
<form
    @if (isset($source))
        action="{{ route('source.edit', ['id' => $source->id]) }}"
    @else
        action="{{ route('source.store') }}"
    @endif method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('source.list') }}">Source</a></li>
                        <li class="breadcrumb-item">
                            @if (isset($source))
                                Update
                            @else
                                Create
                            @endif
                        </li>
                    </ol>
                </div>
                <h4 class="page-title">
                    @if (isset($source))
                        Update
                    @else
                        Create
                    @endif
                </h4>
            </div>
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 form-group">
                            <label>Name @if (!isset($source)) <span style="color: red">*</span> @endif</label>
                            <input type="text" name="name" id="name" class="form-control" required placeholder="Enter name" @isset($source) value="{{ $source->name }}" @endisset/>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2" style="margin-left: auto">
                            <button type="submit" class="btn btn-primary waves-effect waves-light btn-block">
                                Save
                            </button>
                        </div>
                        <div class="col-2">
                            <a href="{{ route('source.list') }}" class="btn btn-secondary waves-effect waves-light btn-block">Cancel</a>
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
        @error('name')
            alertify.error("{!! $message !!}");
        @enderror

        if ($('#name').val() == '') {
            $('#name').focus();
        }
    });
</script>
@endsection
