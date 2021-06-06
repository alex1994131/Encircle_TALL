<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Trust;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Auth;
use Mail;

class UserController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', User::class);

        $search = $request->get('search', '');

        if(Auth::user()->isSuperAdmin())
        {
            $users = User::search($search)
                ->latest()
                ->paginate(5);
        }
        else
        {
            $users = User::search($search)
                ->where('trust_id', Auth::user()->trust_id)
                ->latest()
                ->paginate(5);
        }

        return view('app.users.index', compact('users', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', User::class);

        $trusts = Trust::pluck('name', 'id');

        $roles = Role::get();

        return view('app.users.create', compact('trusts', 'roles'));
    }

    /**
     * @param \App\Http\Requests\UserStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $this->authorize('create', User::class);
        if($request->password != $request->password_confirmation) {
            Toastr::error('Password does not match','Error');
            return redirect()->back();
        }
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        $email_address = $user->email;
        $details = [
            'user_name' => $validated['name'],
            'password' => $request['password'],
        ];

        \Mail::to($email_address)->send(new \App\Mail\SendPasswordMail($details));  

        $user->syncRoles($request->roles);
        return redirect()
            ->route('users.edit', $user)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $user)
    {
        $this->authorize('view', $user);

        return view('app.users.show', compact('user'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $trusts = Trust::pluck('name', 'id');

        $roles = Role::get();

        return view('app.users.edit', compact('user', 'trusts', 'roles'));
    }

    /**
     * @param \App\Http\Requests\UserUpdateRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $this->authorize('update', $user);
        
        if($request->password != $request->password_confirmation) {
            Toastr::error('Password does not match','Error');
            return redirect()->back();
        }
        
        $validated = $request->validated();

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        $user->syncRoles($request->roles);

        return redirect()
            ->route('users.edit', $user)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return redirect()
            ->route('users.index')
            ->withSuccess(__('crud.common.removed'));
    }

    public function editProfile(Request $request) {
        
        $user = Auth::user();
        $trusts = Trust::pluck('name', 'id');

        $roles = Role::get();

        return view('app.users.profile',compact('user', 'trusts', 'roles'));
    }

    public function avatarUpload(Request $request) {
        if ($request->photo) {
            $exist_photo = Auth::user()->upload_avatar;
            if($exist_photo != '') {
                $file = 'public/' . $exist_photo;
                if (Storage::exists($file)) {
                    Storage::delete($file);
                }
            }

            $image = $request->file('photo');
            $filename = time().'.'.$image->guessExtension();
            
            $path = $image->storeAs(
                 'public/avatar', $filename
            );

            $photo = 'avatar/'. $filename;

            $user = Auth::user();
            $user->upload_avatar = $photo;
            $user->save();
            echo 'success';
        }
    }

    public function updateProfile(Request $request) {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->department = $request->department;
        $user->jobtitle = $request->jobtitle;
        $user->save();
        return redirect()->back()->withSuccess(__('crud.common.saved'));
    }

    public function updatePassword(Request $request) {
        $user = Auth::user();
            
        if (Hash::check($request->prev_password, $user->password)) { 
            
            if($request->password != $request->password_confirmation)
            {
                Toastr::error('Password does not match','Error');
                 return redirect()->back();
            } else {
                $user->fill([
                 'password' => Hash::make($request->password)
                 ])->save();
             
                 Toastr::success('Password changed','Sucess');
                 return redirect()->back();
            }            
         } else {
            Toastr::error('Previous Password is not correct. Please try it again','Error');
             return redirect()->back();
         }
    }
}