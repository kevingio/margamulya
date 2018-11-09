<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;

class File extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'filename', 'mime_type', 'size', 'description', 'calendar_id', 'is_thumbnail'
    ];

    /**
     * Relation to User
     *
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Relation to Calendar
     *
     */
    public function calendar()
    {
        return $this->belongsTo('App\Models\Calendar');
    }

    /**
     * Get Total Data
     * @return integer
     */
    public function getTotal($param)
    {
        if($param == 'video') {
            return Self::whereNull('mime_type')->count();
        } else {
            return Self::whereNotNull('mime_type')->count();
        }
    }

    /**
     * Get Size
     * @return integer
     */
    public function getSize($param)
    {
        if($param == 'video') {
            return Self::whereNull('mime_type')->sum('size');
        } else {
            return Self::whereNotNull('mime_type')->sum('size');
        }
    }

    /**
     * Get Datatable Data
     * @return array
     */
    public function datatable($param)
    {
        if($param == 'video') {
            $datas = Self::with(['user', 'calendar'])->whereNull('mime_type')->orderBy('created_at', 'desc')->get();
            return Datatables::of($datas)
                ->editColumn('event_name', function ($data) {
                    return $data->calendar->title;
                })
                ->editColumn('uploader', function ($data) {
                    return $data->user->name;
                })
                ->editColumn('created_at', function ($data) {
                    return date('M d ,Y H:i', strtotime($data->created_at));
                })
                ->editColumn('action', function ($data) {
                    $html = '
                    <div class="dropdown">
                        <button class="btn btn-dark btn-sm datatable-action" type="button" data="'.encrypt($data->id).'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-horizontal m-0"></i>
                        </button>
                        <div class="dropdown-menu datatable-menu">
                            <a class="dropdown-item view" href="javascript: void(0)">View</a>
                            <a class="dropdown-item edit" href="javascript: void(0)">Edit</a>
                            <a class="dropdown-item text-danger delete" href="javascript: void(0)">Move to trash</a>
                        </div>
                    </div>';
                    return $html;
                })
                ->rawColumns(['action'])
                ->make(true);
        }else {
            $datas = Self::with(['user', 'calendar'])->whereNotNull('mime_type')->orderBy('created_at', 'desc')->get();
            return Datatables::of($datas)
                ->editColumn('event_name', function ($data) {
                    return $data->calendar->title;
                })
                ->editColumn('filename', function ($data) {
                    $html = '
                    <a href="javascript: void(0)">
                        <img src="' . Storage::url($data->filename) .'" class="img-table img-thumbnail" alt="' . $data->filename . '" />
                    </a>';
                    return $html;
                })
                ->editColumn('size', function ($data) {
                    return round($data->size/1000000, 2) . ' MB';
                })
                ->editColumn('created_at', function ($data) {
                    return date('M d ,Y H:i', strtotime($data->created_at));
                })
                ->editColumn('action', function ($data) {
                    $html = '
                    <div class="dropdown">
                        <button class="btn btn-dark btn-sm datatable-action" type="button" data="'.encrypt($data->id).'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-horizontal m-0"></i>
                        </button>
                        <div class="dropdown-menu datatable-menu">
                            <a class="dropdown-item set-thumbnail" href="javascript: void(0)">Set Thumbnail</a>
                            <a class="dropdown-item edit" href="javascript: void(0)">Edit</a>
                            <a class="dropdown-item text-danger delete" href="javascript: void(0)">Move to trash</a>
                        </div>
                    </div>';
                    return $html;
                })
                ->rawColumns(['filename' ,'action'])
                ->make(true);
        }
    }
}
