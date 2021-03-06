<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UsersDataTable;
use App\Events\UserCreated;
use App\Events\UserUpdatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserDeleteRequest;
use App\Http\Requests\UserStoreRequest;
use App\Models\Office;
use App\Models\Permission;
use App\Models\User;
use App\Notifications\UserDeletedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create', [
            'pageTitle' => 'Add New User',
            'roles'     => Role::all(),
            'offices'   => Office::all(),
            'permissions'=> Permission::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $password = Str::random(8); // generate password with length of 8 characters

        $user = User::create([
            'first_name'=> $request->first_name,
            'last_name' => $request->last_name,
            'name'      => $request->first_name . ' ' . $request->last_name,
            'email'     => $request->email,
            'password'  => Hash::make($password),
            'office_id' => $request->office_id,
        ]);

        if ($request->roles) {
            $user->roles()->sync($request->roles->first());
            $user->assigned_roles()->sync($request->roles);
        }

        $user->syncPermissions($request->permissions);

        if ($request->has('activated')) {
            $user->activate();
        }

        event(new UserCreated($user, $password));

        Alert::success('Success','User successfully created');

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'pageTitle' => 'Edit User',
            'roles'     => Role::all(),
            'user'      => $user,
            'offices'   => Office::all(),
            'permissions'=> Permission::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update([
            'first_name'=> $request->first_name,
            'last_name' => $request->last_name,
            'name'      => $request->first_name . ' ' . $request->last_name,
            'office_id' => $request->office_id,
        ]);

        $user->assigned_roles()->sync($request->roles);
        $user->syncPermissions($request->permissions);

        if ($request->has('activated')) {
            $user->activate();
        } else {
            $user->deactivate();
        }

        \Log::info('user being updated: ' . $user);

        event(new UserUpdatedEvent($user));

        Alert::success('Success','User successfully updated');

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDeleteRequest $request, User $user)
    {
        $user->delete();

        $user->notify(new UserDeletedNotification($request->reason));

        Alert::success('User has been deleted');

        return redirect()->route('admin.users.index');
    }

    public function projects(Request $request, string $username)
    {
        return User::findByUsername($username)->projects;
    }
}
