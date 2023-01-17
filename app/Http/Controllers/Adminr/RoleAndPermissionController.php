<?php

namespace App\Http\Controllers\Adminr;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionController extends Controller
{
    public function index()
    {
        try {
            $roles = Role::with('permissions')->get();
            $permissions = Permission::with('roles')->whereNull('resource')->get();

            return inertia('Adminr/RolesAndPermissions/Index', compact('roles', 'permissions'));
        } catch (\Exception | \Error $e) {
            return $this->backError('Error: ' . $e->getMessage());
        }
    }

    public function assignPermission(Request $request): JsonResponse
    {
        try {
            $role = Role::where('id', $request->get('role_id'))->first();
            $permission = Permission::where('id', $request->get('permission_id'))->first();

            if (!$role->hasPermissionTo($permission)) {
                $role->givePermissionTo($permission);
            }
            return $this->successMessage('Permission assigned to ' . $role->name . ' !');
        } catch (\Exception | \Error $e) {
            return $this->backError('Error: ' . $e->getMessage());
        }
    }

    public function revokePermission(Request $request): JsonResponse
    {
        try {
            $role = Role::where('id', $request->get('role_id'))->first();
            $permission = Permission::where('id', $request->get('permission_id'))->first();

            if ($role->hasPermissionTo($permission)) {
                $role->revokePermissionTo($permission);
            }
            return $this->successMessage('Permission revoked from ' . $role->name . ' !');
        } catch (\Exception | \Error $e) {
            return $this->backError('Error: ' . $e->getMessage());
        }
    }


    public function storeRole(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'unique:roles'],
        ], [
            "name.unique" => "Role with name \"" . $request->get('name') . "\" already exist."
        ]);

        try {
            Role::create([
                'name' => $request->get('name')
            ]);
            return $this->backSuccess('Role created successfully!');
        } catch (\Exception | \Error $e) {
            return $this->backError('Error: ' . $e->getMessage());
        }
    }

    public function storePermission(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'unique:permissions'],
        ], [
            "name.unique" => "Permission with name \"" . $request->get('name') . "\" already exist."
        ]);
        try {
            Permission::create([
                'name' => $request->get('name')
            ]);
            return $this->backSuccess('Permission created successfully!');
        } catch (\Exception | \Error $e) {
            return $this->backError('Error: ' . $e->getMessage());
        }
    }

    public function togglePermission(Request $request)
    {
        try {
            $role = Role::where('id', $request->get('role_id'))->first();
            $permission = Permission::where('id', $request->get('permission_id'))->first();
            $msg = '';
            if ($request->get('action') == 'assign') {
                /// Assign the permission
                if (!$role->hasPermissionTo($permission)) {
                    $role->givePermissionTo($permission);
                }
                $msg = 'Permission assigned successgully.';
            } else {
                /// Revoke the permission
                if ($role->hasPermissionTo($permission)) {
                    $role->revokePermissionTo($permission);
                }
                $msg = 'Permission revoked successgully.';
            }
            return $this->successMessage($msg);
        } catch (\Exception | \Error $e) {
            return $this->backError('Error: ' . $e->getMessage());
        }
    }
}
