<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;

class Calendar extends Model
{

    /**
     * Disable timestamp
     *
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'date', 'start_hour', 'end_hour', 'title', 'thumbnail', 'user_id'
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
     * Relation to File
     *
     */
    public function file()
    {
        return $this->hasMany('App\Models\File');
    }

    /**
     * Get Datatable Data
     * @return array
     */
    public function select2($keyword)
    {
        $events = Self::where('title', 'like', "%{$keyword}%")->get();
        foreach ($events as $event) {
            $event->text = $event->title . ' (' . date('d M Y', strtotime($event->date)) . ')';
        }
        return response()->json($events);
    }

    /**
     * Get Datatable Data
     * @return array
     */
    public function datatable($type)
    {
        if($type == 'calendar') {
            $operator = '>=';
        } else {
            $operator = '<=';
        }
        $datas = Self::whereDate('date', $operator, date('Y-m-d'))
                        // ->whereTime('end_hour', '<=', \Carbon\Carbon::parse(date('H:i')))
                        ->orderBy('date')->get();
        return Datatables::of($datas)
            ->editColumn('date', function ($data) {
                return date('l, d F Y', strtotime($data->date));
            })
            ->editColumn('filename', function ($data) {
                if(!empty($data->thumbnail)) {
                    $html = '
                    <a href="javascript: void(0)">
                        <img src="' . Storage::url($data->thumbnail) .'" class="img-table img-thumbnail" alt="' . $data->thumbnail . '" />
                    </a>';
                } else {
                    $html = '<p class="text-center m-0">-</p>';
                }
                return $html;
            })
            ->editColumn('start_hour', function ($data) {
                return date('H:i', strtotime($data->start_hour));
            })
            ->editColumn('end_hour', function ($data) {
                return date('H:i', strtotime($data->end_hour));
            })
            ->editColumn('action', function ($data) use ($type) {
                if($type == 'calendar') {
                    $html = '
                    <div class="dropdown">
                        <button class="btn btn-dark btn-sm datatable-action" type="button" data="'.encrypt($data->id).'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-horizontal m-0"></i>
                        </button>
                        <div class="dropdown-menu datatable-menu">
                            <a class="dropdown-item view" href="javascript: void(0)" data-toggle="modal">Edit</a>
                            <a class="dropdown-item text-danger delete" href="javascript: void(0)">Move to trash</a>
                        </div>
                    </div>';
                } else {
                    $html = '
                    <div class="dropdown">
                        <button class="btn btn-dark btn-sm datatable-action" type="button" data="'.encrypt($data->id).'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-horizontal m-0"></i>
                        </button>
                        <div class="dropdown-menu datatable-menu">
                            <a class="dropdown-item view" href="javascript: void(0)">View</a>
                            <a class="dropdown-item view" href="javascript: void(0)" data-toggle="modal">Edit</a>
                            <a class="dropdown-item text-danger delete" href="javascript: void(0)">Move to trash</a>
                        </div>
                    </div>';
                }
                return $html;
            })
            ->rawColumns(['filename','action'])
            ->make(true);
    }
}
