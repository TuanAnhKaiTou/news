@extends('layout')
@section('main-content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">Source</li>
                </ol>
            </div>
            <h4 class="page-title">Source</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <a href="{{ route('source.create') }}" class="btn btn-success waves-effect waves-light mb-4"><i class="fas fa-plus"></i> Add New</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($sources) > 0)
                                @foreach($sources as $source)
                                <tr>
                                    <td>{{ $source->name }}</td>
                                    <td class="text-center">
                                        <div>
                                            <a href="{{ route('source.edit', ['id' => $source->id]) }}" class="btn btn-warning btn-sm waves-effect waves-light"><i class="fas fa-edit"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-secondary btn-sm waves-effect waves-light btn-delete" data-id="{{ $source->id }}"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                @include('partials.no-data')
                            @endif
                        </tbody>
                    </table>
                    @if(count($sources) > 0)
                    <div class="d-flex justify-content-between" style="margin-top: 0.3rem">
                        <div style="padding: .5rem .75rem; margin-bottom: 1rem;">
                            Show {{ $sources->firstItem() }} to {{ $sources->lastItem() }} of {{ $sources->total() }} entries
                        </div>
                        <div>
                            {{ $sources->onEachSide(1)->withQueryString()->links() }}
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
    .btn-warning:hover {
        color: #fff;
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
                        url: "{!! route('source.delete') !!}",
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
