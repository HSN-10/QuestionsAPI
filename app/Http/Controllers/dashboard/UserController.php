<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Queue\RedisQueue;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('dashboard.user.view', compact(['users']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users', 'regex:/(^([a-zA-Z]+)(\d+)?$)/u'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'is_admin' => 'required',
        ]);
        $save = User::create($request->all());
        if ($save)
            return redirect()->route('user.index')->with(['success' => Lang::get('lang.addSuccess')]);
        else
            return redirect()->route('user.index')->with(['error' => Lang::get('lang.addError')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('dashboard.user.edit', compact(['user']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id, 'regex:/(^([a-zA-Z]+)(\d+)?$)/u'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'is_admin' => ['required']
        ]);
        if ($user->update($validate))
            return redirect()->route('user.index')->with(['success' => Lang::get('lang.updateSuccess')]);
        else
            return redirect()->route('user.index')->with(['error' => Lang::get('lang.updateError')]);
    }

    public function changepassword(Request $request, User $user)
    {
        if (!(Hash::check($request->get('oldpassword'), $user->password))) {
            $error = ValidationException::withMessages([
                'oldpassword' => [Lang::get('lang.incorrectpassword')],
            ]);
            throw $error;
        }

        $validate = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->password = Hash::make($request->password);

        if ($user->save())
            return redirect()->route('user.index')->with(['success' => Lang::get('lang.updateSuccess')]);
        else
            return redirect()->route('user.index')->with(['error' => Lang::get('lang.updateError')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->delete())
            return redirect()->back()->with(['success' => Lang::get('lang.deleteSuccess')]);
        else
            return redirect()->back()->with(['error' => Lang::get('lang.deleteError')]);
    }

    public function trash()
    {
        $users = User::onlyTrashed()->get();
        return view('dashboard.user.trash', compact(['users']));
    }
    public function undo($id)
    {
        $user = User::onlyTrashed()->where('id', $id)->first();
        $user->deleted_at = null;
        if ($user->save())
            return redirect()->back()->with(['success' => Lang::get('lang.undoSuccess')]);
        else
            return redirect()->back()->with(['error' => Lang::get('lang.undoError')]);
    }
    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->where('id', $id)->first();
        if ($user->forceDelete())
            return redirect()->back()->with(['success' => Lang::get('lang.deleteSuccess')]);
        else
            return redirect()->back()->with(['error' => Lang::get('lang.deleteError')]);
    }

    public function profileEdit()
    {
        $user = auth()->user();
        return view('dashboard.user.edit', compact(['user']));
    }

    public function profileUpdate(Request $request)
    {
        $user = auth()->user();
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id, 'regex:/(^([a-zA-Z]+)(\d+)?$)/u'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);
        if ($user->update($validate))
            return redirect()->route('user.index')->with(['success' => Lang::get('lang.updateSuccess')]);
        else
            return redirect()->route('user.index')->with(['error' => Lang::get('lang.updateError')]);
    }

    public function changepassword_admin(Request $request, User $user)
    {
        $validate = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->password = Hash::make($request->password);

        if ($user->save())
            return redirect()->route('user.index')->with(['success' => Lang::get('lang.updateSuccess')]);
        else
            return redirect()->route('user.index')->with(['error' => Lang::get('lang.updateError')]);
    }
}
