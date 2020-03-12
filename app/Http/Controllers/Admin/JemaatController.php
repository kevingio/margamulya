<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Jemaat;
use App\Imports\JemaatsImport;
use Excel;

class JemaatController extends Controller
{
    function __construct(Jemaat $jemaat)
    {
        $this->jemaat = $jemaat;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('web.admin.jemaat.index');
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
        if($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('public');
            Excel::import(new JemaatsImport, $path);

            $path = storage_path() . '/app/' . $path;
            if(file_exists($path)) {
                unlink($path);
            }

            return redirect('/admin/jemaat');
        } else {
            $data = $request->all();
            if($data['marriage'] == 'no') {
                unset($data['anniversary']);
            }
            unset($data['marriage']);
            $new_data = $this->jemaat->updateOrCreate($data);
            if(!empty($data['marriage'])) {
                $jemaat = $this->jemaat->find($data['couple_id']);
                $jemaat->update([
                    'couple_id' => $new_data->id
                ]);
            }
        }
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
        $jemaat = $this->jemaat->with('couple')->find(decrypt($id));
        return response()->json($jemaat);
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
        $jemaat = $this->jemaat->find(decrypt($id));
        if($data['marriage'] == 'no') {
            $data['anniversary'] = NULL;
            $data['couple_id'] = NULL;
            if(!empty($jemaat->couple_id)) {
                $old_couple = $this->jemaat->find($jemaat->couple_id)->update([
                    'couple_id' => NULL,
                    'anniversary' => NULL
                ]);
            }
        } else {
            $new_couple = $this->jemaat->find($data['couple_id'])->update([
                'couple_id' => $jemaat->id,
                'anniversary' => $data['anniversary']
            ]);
        }
        unset($data['marriage']);
        $jemaat->update($data);
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
        $jemaat = $this->jemaat->find(decrypt($id));
        if(!empty($jemaat->couple_id)) {
            $couple = $this->jemaat->find($jemaat->couple_id)->update([
                'couple_id' => NULL,
                'anniversary' => NULL
            ]);
        }
        $jemaat->delete();
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
                return $this->jemaat->datatable();
                break;
            case 'select2':
                return $this->jemaat->select2($request->search);
                break;
        }
    }

    /**
     * Download format file excel
     *
     * @return \Illuminate\Http\Response
     */
    public function getDownload()
    {
        $file = public_path() . '/src/format_upload.xlsx';
        $headers = array('Content-Type: application/vnd.openxmlformats-officedocument.speadsheetml.sheet');
        return response()->download($file, 'format_upload.xlsx', $headers);
    }
}
