<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Alert;

class UserController extends Controller
{
    function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->user->find($id);
        return view('web.admin.profile.index', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Show change password form
     *
     * @return \Illuminate\Http\Response
     */
    public function showFormChangePassword()
    {
        session()->forget('sweet_alert.alert');
        return view('web.admin.profile.change-password');
    }

    /**
     *  Change password form
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        $oldPassword = bcrypt($request->old_password);
        $newPassword = bcrypt($request->new_password);

        if($oldPassword == auth()->user()->password) {
            $this->user->find(auth()->user()->id)->update([
                'password' => $newPassword
            ]);
            alert()->success('Password Changed!', 'Success')->autoclose(3000);
        } else {
            alert()->error('Old password do not match our records!', 'Error')->autoclose(3000);
        }

        return view('web.admin.profile.change-password');
    }

    /**
     * Handle all AJAX request
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function ajax(Request $request)
    {
        switch ($request->mode) {
            case 'datatable':
                return $this->user->datatable();
                break;
        }
    }
}
