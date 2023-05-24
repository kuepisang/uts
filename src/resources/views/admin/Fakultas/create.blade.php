@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.fakultas.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.fakultas.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="fakultasname">{{ trans('cruds.fakultas.fields.fakultasname') }}</label>
                <input class="form-control {{ $errors->has('fakultasname') ? 'is-invalid' : '' }}" type="text" name="fakultasname" id="fakultasname" value="{{ old('fakultasname', '') }}" required>
                @if($errors->has('fakultasname'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fakultasname') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fakultas.fields.fakultasname_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="author">{{ trans('cruds.fakultas.fields.author') }}</label>
                <input class="form-control {{ $errors->has('author') ? 'is-invalid' : '' }}" type="text" name="author" id="author" value="{{ old('author', '') }}" required>
                @if($errors->has('author'))
                    <div class="invalid-feedback">
                        {{ $errors->first('author') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fakultas.fields.author_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection