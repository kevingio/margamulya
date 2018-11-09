<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Calendar;
use Auth;

class FileController extends Controller
{
    function __construct(File $file, Calendar $calendar)
    {
        $this->file = $file;
        $this->event = $calendar;
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
        $data = $request->except('photo');
        if($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'required|file|mimes:jpeg,jpg,gif,png',
            ]);

            $file = $request->file('photo');
            $this->file->create([
                'user_id' => Auth::user()->id,
                'filename' => $file->store('public/events'),
                'mime_type' => $file->getClientMimeType(),
                'size' => $file->getSize(),
                'calendar_id' => $data['calendar_id']
            ]);
        } else {
            $data['user_id'] = Auth::user()->id;
            $this->file->create($data);
        }
        return response()->json(['status' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id == 'video') {
            return view('web.admin.gallery.video');
        } else if ($id == 'photo') {
            return view('web.admin.gallery.photo');
        } else {
            $file = $this->file->with('calendar')->find(decrypt($id));
            if(!empty($file->mime_type)) {
                $file->filename = Storage::url($file->filename);
            } else {
                $file->url = str_replace('watch?v=', 'embed/', $file->filename);
            }
            return response()->json($file);
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
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $file = $this->file->find(decrypt($id));
        if($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'required|file|mimes:jpeg,jpg,gif,png',
            ]);

            $newFile = $request->file('photo');
            $data['filename'] = $newFile->store('public/events');
            Storage::delete($file->filename);
            $data['mime_type'] = $newFile->getClientMimeType();
            $data['size'] = $newFile->getSize();
        }
        $file->update($data);
        return response()->json(['status' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = $this->file->find(decrypt($id));
        if(!empty($file->mime_type)) {
            $this->event->where('thumbnail', $file->filename)->update(['thumbnail' => NULL]);
            Storage::delete($file->filename);
        }
        $file->delete();
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
                return $this->file->datatable($request->search);
                break;
        }
    }
}
