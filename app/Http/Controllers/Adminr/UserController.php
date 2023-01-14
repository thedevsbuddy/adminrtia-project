<?php

namespace App\Http\Controllers\Adminr;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Inertia\Response;
use Inertia\ResponseFactory;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    protected int $paginationLimit = 10;

    public function index(): Response|ResponseFactory|RedirectResponse
    {
        try {
//            $users = User::notRole(['admin', 'super_admin'])->paginate($this->paginationLimit);
            $users = User::paginate($this->paginationLimit);
            return inertia('Adminr/Users/Index', compact('users'));
        } catch (\Exception | \Error $e) {
            return $this->backError('Error : ' . $e->getMessage());
        }
    }

    public function create(): Response|ResponseFactory|RedirectResponse
    {
        try {
            $roles = Role::where('name', '!=', 'super_admin')->get();
            return inertia('Adminr/Users/Create', compact('roles'));
        } catch (\Exception | \Error $e) {
            return $this->backError('Error : ' . $e->getMessage());
        }
    }

    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'name' => ['required'],
            'username' => ['required', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'phone' => ['required', 'unique:users', 'numeric', 'min:10'],
            'password' => ['required', 'min:6'],
            'confirm_password' => ['required', 'same:password', 'min:6'],
        ]);

        try {
            if ($request->hasFile('avatar')) {
                $avatar = $this->uploadFile(file: $request->file('avatar'), dir: 'users/avatars')->getFilePath();
            } else {
                $avatar = null;
            }

            $user = User::create([
                'name' => $request->get('name'),
                'username' => $request->get('username'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'avatar' => $avatar,
                'email_verified_at' => now(),
                'password' => bcrypt($request->get('password')),
            ]);

            $user->assignRole(Role::where('id', $request->get('role'))->first());

            return $this->backSuccess('User created successfully!');
        } catch (\Exception $e) {
            return $this->backError('Error : ' . $e->getMessage());
        } catch (\Error $e) {
            return $this->backError('Error : ' . $e->getMessage());
        }
    }


    public function edit(User $user): Response|ResponseFactory|RedirectResponse
    {
        try {
            $roles = Role::where('name', '!=', 'super_admin')->get();
            $user->load(['roles' => function($query) {
                $query->first();
            }]);
            return inertia('Adminr/Users/Edit', compact('user', 'roles'));
        } catch (\Exception $e) {
            return $this->backError('Error : ' . $e->getMessage());
        } catch (\Error $e) {
            return $this->backError('Error : ' . $e->getMessage());
        }
    }



    public function update(User $user, Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required'],
            'username' => ['required'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'numeric', 'min:10'],
            'password' => ['sometimes'],
            'confirm_password' => ['sometimes', 'same:password'],
        ]);

        try {
            // Validate if username admin entered is of
            // selected user or any one else took it
            if(User::where('username', $request->get('username'))->where('id', '!=', $user->id)->value('id') != null){
                return  $this->backError(message: "Username is already taken!");
            }

            if ($request->hasFile('avatar')) {
                $avatar = $this->uploadFile($request->file('avatar'), 'users/avatars')->getFilePath();
                $this->deleteStorageFile($user->avatar);
            } else {
                $avatar = $user->avatar;
            }

            $user->update([
                'name' => $request->get('name'),
                'username' => $request->get('username'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'avatar' => $avatar,
            ]);

            if ($request->get('password') && $request->get('confirm_password')) {
                $user->update([
                    'password' => bcrypt($request->get('password'))
                ]);
            }

            // Update User role if selected new
            $user->syncRoles(Role::where('id', $request->get('role'))->first());

            return $this->backSuccess('User updated successfully!');
        } catch (\Exception $e) {
            return $this->backError('Error : ' . $e->getMessage());
        } catch (\Error $e) {
            return $this->backError('Error : ' . $e->getMessage());
        }
    }


    public function destroy(User $user): RedirectResponse
    {
        try {
            if (!$user->hasDefaultAvatar()) {
                $this->deleteStorageFile($user->avatar);
            }
            $user->delete();
            return $this->backSuccess('User deleted successfully!');
        } catch (\Exception $e) {
            return $this->backError('Error : ' . $e->getMessage());
        }
    }


}

