<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyChatRequest;
use App\Http\Requests\StoreChatRequest;
use App\Http\Requests\UpdateChatRequest;
use App\Models\Chat;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('chat_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Chat::with(['buyers'])->select(sprintf('%s.*', (new Chat())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'chat_show';
                $editGate = 'chat_edit';
                $deleteGate = 'chat_delete';
                $crudRoutePart = 'chats';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('buyer', function ($row) {
                $labels = [];
                foreach ($row->buyers as $buyer) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $buyer->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('message', function ($row) {
                return $row->message ? $row->message : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'buyer']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.chats.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('chat_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $buyers = User::pluck('name', 'id');

        return view('admin.chats.create', compact('buyers'));
    }

    public function store(StoreChatRequest $request)
    {
        $chat = Chat::create($request->all());
        $chat->buyers()->sync($request->input('buyers', []));

        return redirect()->route('admin.chats.index');
    }

    public function edit(Chat $chat)
    {
        abort_if(Gate::denies('chat_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $buyers = User::pluck('name', 'id');

        $chat->load('buyers');

        return view('admin.chats.edit', compact('buyers', 'chat'));
    }

    public function update(UpdateChatRequest $request, Chat $chat)
    {
        $chat->update($request->all());
        $chat->buyers()->sync($request->input('buyers', []));

        return redirect()->route('admin.chats.index');
    }

    public function show(Chat $chat)
    {
        abort_if(Gate::denies('chat_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $chat->load('buyers');

        return view('admin.chats.show', compact('chat'));
    }

    public function destroy(Chat $chat)
    {
        abort_if(Gate::denies('chat_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $chat->delete();

        return back();
    }

    public function massDestroy(MassDestroyChatRequest $request)
    {
        Chat::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
