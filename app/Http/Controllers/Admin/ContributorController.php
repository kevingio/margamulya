<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ContributorType;

class ContributorController extends Controller
{

    function __construct(User $user, ContributorType $contributorType)
    {
        $this->contributor = $user;
        $this->contributorType = $contributorType;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contributorTypes = $this->contributorType->get();
        return view('web.admin.contributor.index', compact('contributorTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $usernameCheck = $this->contributor->where('username', $data['username'])->count() > 0;
        if ($usernameCheck) {
            return response()->json([
                'status' => 400,
                'message' => 'Username is exist, please use another username'
            ]);
        }
        $this->contributor->create($data);
        return response()->json(['status' => 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->contributor->findOrFail(decrypt($id));
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort(404);
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
        $data = $request->all();
        $contributor = $this->contributor->findOrFail(decrypt($id));
        if (strtolower($contributor->username) != strtolower($data['username'])) {
            $usernameCheck = $this->contributor->where('username', $data['username'])->count() > 0;
            if ($usernameCheck) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Username is exist, please use another username'
                ]);
            }
        }
        if ($request->has('password')) {
            $data['password'] = bcrypt($data['password']);
        }
        $contributor->update($data);
        return response()->json(['status' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->contributor->findOrFail(decrypt($id))->delete();
        return response()->json(['status' => 200]);
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
                return $this->contributor->datatable();
                break;
        }
    }
    
}
