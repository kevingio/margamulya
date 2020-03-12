<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Warta;
use Auth;

class WartaController extends Controller
{
    function __construct(Warta $warta)
    {
        $this->warta = $warta;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort(404);
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
        $request->validate([
            'file' => 'file|mimes:pdf',
        ]);

        $data = $request->all();
        $file = $request->file('file');
        $this->warta->create([
            'title' => $data['title'],
            'path' => $file->store('public/wartas'),
            'size' => $file->getSize(),
            'user_id' => Auth::user()->id,
            'type' => $data['type']
        ]);
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
        if($id == 'jemaat') {
            return view('web.admin.warta.jemaat');
        } else {
            return view('web.admin.warta.umum');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $warta = $this->warta->find(decrypt($id));
        $warta->path = Storage::url($warta->path);
        return response()->json($warta);
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
        $request->validate([
            'file' => 'file|mimes:pdf',
        ]);

        $data = $request->all();
        if($request->hasFile('file')) {
            $oldFile = $this->warta->find(decrypt($id));
            $path = storage_path() . '/app/' . $oldFile->path;
            if(file_exists($path)) {
                unlink($path);
            }
            $file = $request->file('file');
            $data['path'] = $file->store('public/wartas');
            $data['size'] = $file->getSize();
        }
        $data['user_id'] = Auth::user()->id;
        $this->warta->find(decrypt($id))->update($data);
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
        $warta = $this->warta->find(decrypt($id));
        $path = storage_path() . '/app/' . $warta->path;
        if(file_exists($path)) {
            unlink($path);
        }
        $warta->delete();
        return response()->json(['status' => true]);
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
                return $this->warta->datatable($request->search);
                break;
        }
    }
}
