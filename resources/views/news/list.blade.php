@extends('layout')
@section('main-content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">News</li>
                </ol>
            </div>
            <h4 class="page-title">News</h4>
        </div>
        <form action="{{ route('news.list') }}" method="GET">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 form-group author">
                            <label>Author</label>
                            <input type="text" name="author" id="author" class="form-control" @if (!empty($inputSearch['author'])) value="{{ $inputSearch['author'] }}" @endif/>
                            <button type="button" class="close close-custom" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="col-4 form-group">
                            <label>Source</label>
                            <select class="form-control" id="src_id" name="src_id" required>
                                @if (!isset($inputSearch['src_id']))
                                    <option selected disabled>Choose source</option>
                                @endif
                                @if (isset($sources))
                                    @foreach($sources as $src)
                                        <option @if (isset($inputSearch['src_id']) && $src->id == $inputSearch['src_id']) selected @endif value="{{ $src->id }}"> {{ $src->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-4 form-group">
                            <label>Category</label>
                            <select class="form-control category" id="cate_id" name="cate_id" required>
                                @if (!isset($inputSearch['cate_id']))
                                    <option selected disabled>Choose category</option>
                                @endif
                                @if (isset($categories))
                                    @foreach($categories as $cate)
                                        <option @if (isset($inputSearch['cate_id']) && $cate->id == $inputSearch['cate_id']) selected @endif value="{{ $cate->id }}"> {{ $cate->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('news.list') }}" class="mr-1 btn btn-secondary waves-effect waves-light"><i class="fas fa-redo-alt"></i> Reset</a>
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
                        <a href="{{ route('news.create') }}" class="btn btn-success waves-effect waves-light mb-4"><i class="fas fa-plus"></i> Add New</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" style="min-width: 8rem;">Title</th>
                                <th scope="col">Subtitle</th>
                                <th scope="col" style="min-width: 8rem;">Author</th>
                                <th scope="col">Source</th>
                                <th scope="col" style="min-width: 7rem;">Category</th>
                                <th scope="col" style="min-width: 10rem;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($news) > 0)
                                @foreach($news as $item)
                                <tr>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->sub_title }}</td>
                                    <td>{{ $item->author }}</td>
                                    <td>{{ $item->source->name }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>
                                        <div>
                                            <a href="javascript:void(0);" class="btn btn-info btn-sm waves-effect waves-light btn-detail" data-id="{{ $item->id }}" data-toggle="modal" data-target="#con-close-modal"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('news.edit', ['id' => $item->id]) }}" class="btn btn-warning btn-sm waves-effect waves-light"><i class="fas fa-edit"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-secondary btn-sm waves-effect waves-light btn-delete" data-id="{{ $item->id }}"><i class="fas fa-trash"></i></a>
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
                    @if(count($news) > 0)
                    <div class="d-flex justify-content-between" style="margin-top: 0.3rem">
                        <div style="padding: .5rem .75rem; margin-bottom: 1rem;">
                            Show {{ $news->firstItem() }} to {{ $news->lastItem() }} of {{ $news->total() }} entries
                        </div>
                        <div>
                            {{ $news->onEachSide(1)->withQueryString()->links() }}
                        </div>
                    </div>
                    @endif
                </div>

                <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Detail</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body p-3" id="detailBody">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
    <!-- Custom box css -->
    <link href="{{ asset('assets/libs/custombox/custombox.min.css') }}" rel="stylesheet">

    <!-- Sweet Alert -->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Alertify -->
    <link href="{{ asset('assets/libs/alertify/alertify.css') }}" rel="stylesheet" type="text/css" />

<style>
    .btn-warning:hover {
        color: #fff;
    }

    .author {
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
</style>
@endsection

@section('js')
    <!-- Modal-Effect -->
    <script src="{{ asset('assets/libs/custombox/custombox.min.js') }}"></script>

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

        var author = $('#author');
        var btnClose = $('.close');

        author.focus();

        if (author.val()) {
            btnClose.show();
            author.blur();
        }

        author.keydown(function() {
            btnClose.show();
        });

        btnClose.click(function() {
            author.val('');
            $(this).hide();
        });

        $('.btn-detail').click(function() {
            var mId = $(this).data('id');
            $.ajax({
                url: 'news/' + mId,
                type: 'get'
            }).done(function(response) {
                $('#detailBody').html(modalBody(response));
            });
        });

        var modalBody = function(data) {
            return `
            <dl class="row mb-0">
                <dt class="col-sm-3">Title</dt>
                <dd class="col-sm-9">${data.data.title}</dd>

                <dt class="col-sm-3">Subtitle</dt>
                <dd class="col-sm-9">${data.data.sub_title}</dd>

                <dt class="col-sm-3">Author</dt>
                <dd class="col-sm-9">${data.data.author}</dd>

                <dt class="col-sm-3">Category</dt>
                <dd class="col-sm-9">${data.data.category.name}</dd>

                <dt class="col-sm-3">Source</dt>
                <dd class="col-sm-9">${data.data.source.name}</dd>

                <dt class="col-sm-3">Content</dt>
                <dd class="col-sm-9">
                    <textarea class="form-control bg-white" id="content" style="height: 130px" readonly>${data.data.content}</textarea>
                </dd>
            </dl>`;
        }

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
                        url: "{!! route('news.delete') !!}",
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
