<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Models\File;

class CalendarController extends Controller
{
    function __construct(Calendar $calendar, File $file)
    {
        $this->calendar = $calendar;
        $this->file = $file;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('web.admin.calendar.index');
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
        $event = $request->all();
        $event['user_id'] = auth()->user()->id;
        $this->calendar->create($event);
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
        $event = $this->calendar->with('user')->find(decrypt($id));
        return response()->json($event);
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
        $event = $request->all();
        $event['user_id'] = auth()->user()->id;
        $this->calendar->find(decrypt($id))->update($event);
        return response()->json(['status' => true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function setThumbnail(Request $request, $id)
    {
        $file = $this->file->find(decrypt($id));
        $this->calendar->find($file->calendar_id)->update(['thumbnail' => $file->filename]);
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
        $event = $this->calendar->find(decrypt($id));
        $files = $this->file->where('calendar_id', $event->id);
        foreach ($files as $file) {
            if(!empty($file->mime_type)) {
                Storage::delete($file->filename);
            }
        }
        $files->delete();
        $event->delete();
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
                return $this->calendar->datatable($request->type);
                break;
            case 'select2':
                return $this->calendar->select2($request->search);
                break;
        }
    }
}
