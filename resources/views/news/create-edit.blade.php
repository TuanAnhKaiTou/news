@extends('layout')
@section('main-content')
<form
    @if (isset($news))
        action="{{ route('news.edit', ['id' => $news->id]) }}"
    @else
        action="{{ route('news.store') }}"
    @endif method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('news.list') }}">News</a></li>
                        <li class="breadcrumb-item">
                            @if (isset($news))
                                Update
                            @else
                                Create
                            @endif
                        </li>
                    </ol>
                </div>
                <h4 class="page-title">
                    @if (isset($news))
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
                            <label>Title @if (!isset($news)) <span style="color: red">*</span> @endif</label>
                            <input type="text" name="title" id="title" class="form-control" required placeholder="Enter title" @isset($news) value="{{ $news->title }}" @endisset/>
                        </div>
                        <div class="col-3 form-group">
                            <label>Subtitle @if (!isset($news)) <span style="color: red">*</span> @endif</label>
                            <input type="text" name="sub_title" id="sub_title" class="form-control" required placeholder="Enter subtitle" @isset($news) value="{{ $news->sub_title }}" @endisset/>
                        </div>
                        <div class="col-2 form-group">
                            <label>Author @if (!isset($news)) <span style="color: red">*</span> @endif</label>
                            <input type="text" name="author" id="author" class="form-control" required placeholder="" @isset($news) value="{{ $news->author }}" @endisset/>
                        </div>
                        <div class="col-2 form-group">
                            <label>Category @if (!isset($news)) <span style="color: red">*</span> @endif</label>
                            <select class="form-control" id="category_id" name="category_id" @if (!isset($news)) required @endif>
                                <option selected disabled>Choose category</option>
                                @if (isset($categories))
                                    @foreach($categories as $cate)
                                        <option @if (isset($news) && $cate->id == $news->category_id) selected @endif value="{{ $cate->id }}"> {{ $cate->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-2 form-group">
                            <label>Source @if (!isset($news)) <span style="color: red">*</span> @endif</label>
                            <select class="form-control" id="source_id" name="source_id" @if (!isset($news)) required @endif>
                                <option selected disabled>Choose source</option>
                                @if (isset($sources))
                                    @foreach($sources as $src)
                                        <option @if (isset($news) && $src->id == $news->source_id) selected @endif value="{{ $src->id }}"> {{ $src->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 form-group">
                            <label>Content @if (!isset($news)) <span style="color: red">*</span> @endif</label>
                            <textarea id="textarea" name="content" id="content" class="form-control" rows="5" placeholder="Enter content">@isset($news) {{ $news->content }} @endisset</textarea>
                        </div>
                        <div class="col-6 form-group">
                            <label>Image</label>
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input type='file' name="image" id="imageUpload" accept=".png,.jpg,.jpeg" />
                                    <label for="imageUpload"></label>
                                </div>
                                @isset($news)
                                    <div class="avatar-remove">
                                        <a href="javascript:void(0);"></a>
                                    </div>
                                    <input type="text" name="is_remove" id="is_remove">
                                @endisset
                                <div class="avatar-preview">
                                    <div id="imagePreview" @isset($news) style="background-image: url({{ $news->full_image }})" @endisset>
                                    </div>
                                </div>
                            </div>
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
        </div>
    </div>
</form>
@endsection

@section('css')
    <!-- Alertify -->
    <link href="{{ asset('assets/libs/alertify/alertify.css') }}" rel="stylesheet" type="text/css" />

<style>
    .avatar-upload #is_remove {
        display: none;
    }
    .avatar-upload {
        position: relative;
        max-width: 210px;
    }
    .avatar-upload .avatar-edit {
        position: absolute;
        right: 0;
        z-index: 1;
        bottom: -1.4rem;
    }
    .avatar-upload .avatar-remove {
        position: absolute;
        left: 0;
        z-index: 1;
        bottom: -1.4rem;
    }
    .avatar-upload .avatar-remove a {
        display: inline-block;
        font-size: 12px;
        margin-bottom: 0;
        cursor: pointer;
        font-weight: normal;
        transition: all 0.2s ease-in-out;
    }
    .avatar-upload .avatar-remove a:after {
        content: "Remove";
        color: rgb(104, 101, 101);
        position: absolute;
        top: 0;
        left: 0;
        text-align: center;
        margin: auto;
    }
    .avatar-upload .avatar-edit input {
        display: none;
    }
    .avatar-upload .avatar-edit input + label {
        display: inline-block;
        font-size: 12px;
        margin-bottom: 0;
        cursor: pointer;
        font-weight: normal;
        transition: all 0.2s ease-in-out;
    }
    .avatar-upload .avatar-edit input + label:after {
        content: "Upload";
        color: rgb(104, 101, 101);
        position: absolute;
        top: 0;
        right: 0;
        text-align: center;
        margin: auto;
    }
    .avatar-upload .avatar-preview {
        width: 100%;
        height: 115px;
        border-radius: 5px;
        position: relative;
        border: 2px solid #dedede;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
    }
    .avatar-upload .avatar-preview > div {
        width: 100%;
        height: 100%;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
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
        @error('title')
            alertify.error("{!! $message !!}");
        @enderror

        @error('sub_title')
            alertify.error("{!! $message !!}");
        @enderror

        @error('author')
            alertify.error("{!! $message !!}");
        @enderror

        @error('content')
            alertify.error("{!! $message !!}");
        @enderror

        @error('image')
            alertify.error("{!! $message !!}");
        @enderror

        $('.file-logo').bind('change', function() {
            var file = this.files[0],
            reader = new FileReader();
            reader.onload = function(e) {
            $('.img-logo').attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imageUpload").change(function() {
            readURL(this);
        });

        $('.avatar-remove a').click(function() {
            $('#imagePreview').css('background-image', 'url()');
            $('#is_remove').val('removed');
        });
    });
</script>
@endsection
