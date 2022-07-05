<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\Admin\UserResource;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserResource(User::with(['roles'])->get());
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserResource($user->load(['roles']));
    }

    public function showProfile()
    {
        $res = [
            'data' => auth()->user()
        ];
        return response($res, 200);
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'name' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'email' => 'required|string||max:100|unique:users,email,'.$user->id,
            'phone' => 'required|string|max:20|min:9',
            'country' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'address_1' => 'required|string|max:255',
            'address_2' => 'nullable|string|max:255'
        ]);

        $user->update($request->all());

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function updateProfileImage(Request $request)
    {
        $user = auth()->user();
        
        $data = $request->validate([
            'image' => 'required|image'
        ]);

        $unique = bin2hex(random_bytes(10));
        $file_pre = public_path().$user->image;
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension(); // you can also use file name
        $fileName = $unique.'.'.$extension;
        $path = public_path().'/uploads/users/image';
        $uplaod = $file->move($path,$fileName);

        $user->image = '/uploads/users/image/'.$fileName;

        if ($user->save()) 
        {
            if (file_exists($file_pre)) {
                unlink($file_pre);
            }
            
            $res = [
                'status' => 'success',
                'message' => 'Profile image updated.',
                'user' => $user
            ];
        } 
        else {
            $res = [
                'status' => 'error',
                'message' => 'Something went wrong!'
            ];
        }
        
        return response($res, 201);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
