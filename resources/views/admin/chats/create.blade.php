@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.chat.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.chats.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="buyers">{{ trans('cruds.chat.fields.buyer') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('buyers') ? 'is-invalid' : '' }}" name="buyers[]" id="buyers" multiple required>
                    @foreach($buyers as $id => $buyer)
                        <option value="{{ $id }}" {{ in_array($id, old('buyers', [])) ? 'selected' : '' }}>{{ $buyer }}</option>
                    @endforeach
                </select>
                @if($errors->has('buyers'))
                    <span class="text-danger">{{ $errors->first('buyers') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.chat.fields.buyer_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="message">{{ trans('cruds.chat.fields.message') }}</label>
                <input class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}" type="text" name="message" id="message" value="{{ old('message', '') }}">
                @if($errors->has('message'))
                    <span class="text-danger">{{ $errors->first('message') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.chat.fields.message_helper') }}</span>
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