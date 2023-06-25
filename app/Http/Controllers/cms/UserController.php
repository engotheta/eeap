<?php

namespace App\Http\Controllers\cms;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class UserController extends BaseController
{

    public function authenticate(Request $request)
    {
        $inputs = $request->only('email', 'password');
        return (Auth::attempt($inputs)) ? redirect()->intended('/cms') : redirect()->back()->withInput()->with('status', 'fail');
    }

    public function login()
    {
        if (Auth::check()) {
          return redirect('/cms');
        }
        return view('cms.auth.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/system');
    }

    public function userForm($id)
    {
        $users = User::find($id);
        return view('cms.users_mgt.edit_user', compact('users'));
    }


    public function updateUserForm(Request $request, $id)
    {
        $user = User::find($id);

        if ($user->email == $request->email) {
            $validator = Validator::make($data = $request->all(), User::$rules_update);
        } else {
            $validator = Validator::make($data = $request->all(), User::$rules);
        }
        
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $user = User::find($id);

        if ($user->update($data)) {
            // remove the previous role before assign a new role
            //   DB::table('model_has_roles')->where('model_id','=',$user->id)->delete();
            //   $user->roles()->attach($request->role);
            $user->syncRoles([$request->role]);
        }
        return back()->with('status', 'success');

        // $email = $data['email'];
        // if (isset($data['check'])) {
        //     $response = $passwords->sendResetLink(['email' => $email], function ($m) {
        //         $m->subject("ML Website:Change Password Request");
        //     });
        // }

        // return redirect()->route('cms.users.create-user-form')->with('success', 'User Updated Successfully');

    }

    public function registerForm()
    {
        $current_user = Auth::user();
        $roles = Role::pluck('name','id');
        $users = User::whereNotIn('id', [$current_user->id])->get();
        return view('cms.users_mgt.index', compact(['users','roles']));
    }


    public function createUser(Request $request, PasswordBroker $passwords)
    {
        $validator = Validator::make($data = $request->all(), User::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $data['password'] = bcrypt('Gbt@_678');
        $user = User::create($data);

        if ($user) {
            $user->roles()->attach($request->role);

            $email = $request->email;

            //send a reset password link
            // $response = $passwords->sendResetLink(['email' => $email], function ($m) {
            //     $m->subject("TNBC CMS Website Change Password Requests");
            // }); 

            //send a reset password link ...(this is working, commented due to SMTP might not be configured.)
            //$response = $passwords->sendResetLink(['email' => $email]);
            
            return back()->with('status', 'success');
        }
    }

    public function userRolesForm($userID)
    {

        $user = User::findOrFail($userID);

        $roles = DB::table('roles')
            ->leftJoin('role_user', function ($join) use ($userID) {
                $join->on('roles.id', '=', 'role_user.role_id')->where('user_id', '=', $userID);
            })->get();

        return view('cms.users_mgt.roles.user_roles', compact('user', 'roles'));
    }

    public function updateUserRoles(Request $request)
    {

        $user = User::findOrFail($request->user_id);
        $data = $request->all();

        $user->roles()->detach();

        if (isset($data['roles'])) {
            $user->roles()->attach($data['roles']);
        }

        return back()->with('status', 'success');

    }


    public function userPermissionsForm($roleID)
    {

        $role = Role::findOrFail($roleID);

        $permissions = DB::table('permissions')
            ->leftJoin('role_has_permissions', function ($join) use ($roleID) {
                $join->on('permissions.id', '=', 'role_has_permissions.permission_id')->where('role_id', '=', $roleID);
            })->get();

        foreach ($permissions as $p) {
            $p->action = substr(strrchr($p->name, '.'), 1);
            $p->name = substr($p->name, 0, strripos($p->name, '.'));
        }

        $modules = collect($permissions)->groupBy('name');
        return view('cms.users_mgt.roles.role_permissions', compact('role', 'modules'));
    }

    public function updateUserPermissions(Request $request)
    {
        $role = Role::findOrFail($request->role_id);
        $data = $request->all();

        if (isset($data['permissions'])) {
            $role->syncPermissions($data['permissions']);
        }

        return back()->with('status', 'success');

    }


    public function changeUserPasswordForm()
    {
        $user = Auth::user();

        return view('cms.users_mgt.change_password', compact('user'));
    }

    public function updateUserPassword(Request $request)
    {
        $user = Auth::user();

        $rules = array(
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Password::defaults()],
        );

        $validator = Validator::make($data = $request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            $validator->errors()->add("current_password", "Wrong current password");
            return redirect()->back()->withErrors($validator);
        }

        $user->password = Hash::make($request['password']);
        $user->save();
        return redirect()->back()->with('message', 'Password Changed Successfully');
    }

    public function destroy($id)
    {

        $user = User::destroy($id);

        return back()->with('status', 'success');
    }

}
