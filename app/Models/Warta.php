<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;

class Warta extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'path', 'type', 'title', 'size'
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
     * Get Total Data
     * @return integer
     */
    public function getTotal()
    {
        return Self::count();
    }

    /**
     * Get Size
     * @return integer
     */
    public function getSize()
    {
        return number_format(Self::sum('size')/1000000000);
    }

    /**
     * Get Datatable Data
     * @return array
     */
    public function datatable($filter)
    {
        $datas = Self::with('user')->where('type', $filter)->orderBy('created_at', 'desc')->get();
        return Datatables::of($datas)
            ->editColumn('uploader', function ($data) {
                return $data->user->name;
            })
            ->editColumn('size', function ($data) {
                return round($data->size/1000000, 2) . ' MB';
            })
            ->editColumn('created_at', function ($data) {
                return date('l, d F Y', strtotime($data->created_at)) . ' at ' . date('H:i', strtotime($data->created_at));
            })
            ->editColumn('action', function ($data) {
                $html = '
                <div class="dropdown">
                    <button class="btn btn-dark btn-sm datatable-action" type="button" data="'.encrypt($data->id).'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-dots-horizontal m-0"></i>
                    </button>
                    <div class="dropdown-menu datatable-menu">
                        <a class="dropdown-item view" href="javascript: void(0)">View</a>
                        <a class="dropdown-item edit" href="javascript: void(0)" data-toggle="modal" data-target="#add-video-modal">Edit</a>
                        <a class="dropdown-item text-danger delete" href="javascript: void(0)">Move to trash</a>
                    </div>
                </div>';
                return $html;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
