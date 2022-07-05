<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = User::with(['roles'])->select(sprintf('%s.*', (new User())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_show';
                $editGate = 'user_edit';
                $deleteGate = 'user_delete';
                $crudRoutePart = 'users';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('lastname', function ($row) {
                return $row->lastname ? $row->lastname : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });

            $table->editColumn('roles', function ($row) {
                $labels = [];
                foreach ($row->roles as $role) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $role->title);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->editColumn('country', function ($row) {
                return $row->country ? $row->country : '';
            });
            $table->editColumn('city', function ($row) {
                return $row->city ? $row->city : '';
            });
            $table->editColumn('address_1', function ($row) {
                return $row->address_1 ? $row->address_1 : '';
            });
            $table->editColumn('address_2', function ($row) {
                return $row->address_2 ? $row->address_2 : '';
            });
            $table->editColumn('kyc', function ($row) {
                return $row->kyc ? $row->kyc : '';
            });
            $table->editColumn('image', function ($row) {
            // dd($row->image);
            $url= asset($row->image);
            // return $url;
            // return '<img src="'.$url.'" border="0" width="40" class="img-rounded" align="center" />';
            // return '<img src=" '.$row->image.' "/>';
                return $row->image ? $row->image : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'roles']);

            return $table->make(true);
        }

        $roles = Role::get();

        return view('admin.users.index', compact('roles'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        return view('admin.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));


        //KYC image
        $file = $request->file('kyc');
        $extension = $file->getClientOriginalExtension(); // you can also use file name
        $fileName = time().'-'.$request->name.'.'.$extension;
        $path = public_path().'/uploads/users/kyc';
        $uplaod = $file->move($path,$fileName);
        $user->kyc = '/uploads/users/kyc/'.$fileName;

        //image
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension(); // you can also use file name
        $fileName = time().'-'.$request->name.'.'.$extension;
        $path = public_path().'/uploads/users/image';
        $uplaod = $file->move($path,$fileName);
        $user->image = '/uploads/users/image/'.$fileName;

        $user->save();

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $user->load('roles');

        return view('admin.users.edit', compact('roles', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {

        if($request->image != '' || $request->kyc != ''){        
            //image code start
            if($request->image != ''){
                //code for remove old file
                if($user->image != ''  && $user->image != null){
                    $file_old = public_path().$user->image;
                    //  dd($file_old);
                    unlink($file_old);
                }
                //upload new file
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension(); // you can also use file name
                $fileName = time().'-'.$request->name.'.'.$extension;
                $path = public_path().'/uploads/users/image/';
                $uplaod = $file->move($path,$fileName);
                //for update in table
                $fileindata = '/uploads/users/image/'.$fileName;
                //image code end

                $user->update($request->all());
                $user->roles()->sync($request->input('roles', []));

                $user->update(['image' => $fileindata]);

            }

            if($request->kyc != ''){
                //kyc code start
                //code for remove old file
                if($user->kyc != ''  && $user->kyc != null){
                    $file_old = public_path().$user->kyc;
                    //  dd($file_old);
                    unlink($file_old);
                }
                //upload new file
                $file = $request->file('kyc');
                $extension = $file->getClientOriginalExtension(); // you can also use file name
                $fileName = time().'-'.$request->name.'.'.$extension;
                $path = public_path().'/uploads/users/image/';
                $uplaod = $file->move($path,$fileName);
                //for update in table
                $fileindata = '/uploads/users/image/'.$fileName;
                //kyc code end

                $user->update($request->all());
                $user->roles()->sync($request->input('roles', []));

                $user->update(['kyc' => $fileindata]);
            }

        }else{
            $user->update($request->all());
            $user->roles()->sync($request->input('roles', []));
        }

        

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles', 'userReviews', 'userOrders');

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
