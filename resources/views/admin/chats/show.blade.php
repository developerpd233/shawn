@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.chat.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.chats.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.chat.fields.id') }}
                        </th>
                        <td>
                            {{ $chat->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.chat.fields.buyer') }}
                        </th>
                        <td>
                            @foreach($chat->buyers as $key => $buyer)
                                <span class="label label-info">{{ $buyer->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.chat.fields.message') }}
                        </th>
                        <td>
                            {{ $chat->message }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.chats.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection