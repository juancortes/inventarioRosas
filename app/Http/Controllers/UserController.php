<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Str;

class UserController extends Controller
{
    public function index()
    {
        // TODO: Select columns
        $users = User::all();

        return view('users.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('users.create',[
          'roles' => Role::get(['id', 'name']),
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            "uuid" => Str::uuid(),
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,

        ]);

        /**
         * Handle upload an image
         */
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $filename = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();

            $file->storeAs('profile/', $filename, 'public');
            $user->update([
                'photo' => $filename
            ]);
        }

        return redirect()
            ->route('users.index')
            ->with('Exitoso', 'Usuario a sido creado!');
    }

    public function show(User $user)
    {
        return view('users.show', [
           'user' => $user
        ]);
    }

    public function edit(User $user)
    {

        return view('users.edit', [
          'user'  => $user,
          'roles' => Role::get(['id', 'name']),
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {

//        if ($validatedData['email'] != $user->email) {
//            $validatedData['email_verified_at'] = null;
//        }

        $user->update($request->except('photo'));

        /**
         * Handle upload image with Storage.
         */
        if($request->hasFile('photo')){

            // Delete Old Photo
            if($user->photo){
                unlink(public_path('storage/profile/') . $user->photo);
            }

            // Prepare New Photo
            $file = $request->file('photo');
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();

            // Store an image to Storage
            $file->storeAs('profile/', $fileName, 'public');

            // Save DB
            $user->update([
                'photo' => $fileName
            ]);
        }

        return redirect()
            ->route('users.index')
            ->with('Exitoso', 'Usuario a sido actualizado!');
    }

    public function updatePassword(Request $request, String $username)
    {
        # Validation
        $validated = $request->validate([
            'password' => 'required_with:password_confirmation|min:6',
            'password_confirmation' => 'same:password|min:6',
        ]);

        # Update the new Password
        $val= User::where('name', $username)->update([
            'password' => Hash::make($validated['password'])
        ]);

        return redirect()
            ->route('users.index')
            ->with('Exitoso', 'Usuario a sido actualizado!');
    }

    public function destroy(User $user)
    {
        /**
         * Delete photo if exists.
         */
        if($user->photo){
            unlink(public_path('storage/profile/') . $user->photo);
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('Exitoso', 'Usuario a sido eliminado!');
    }
}
