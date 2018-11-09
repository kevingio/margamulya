<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Yajra\Datatables\Datatables;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'password', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Relation to Role
     *
     */
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    /**
     * Get Datatable Data
     * @return array
     */
    public function datatable()
    {

        $datas = Self::orderBy('created_at', 'desc')->get();
        return Datatables::of($datas)
            ->editColumn('avatar', function ($data) {
                $html = '
                <div>
                    <img src="/admin-asset/img/faces-clipart/pic-1.png" style="width: 100px; height: auto;" alt="image"/>
                </div>';
                return $html;
            })
            ->editColumn('username', function ($data) {
                $html = '<a href="'.url('/admin/profile', [$data->id]).'">'.$data->username.'</a>';
                return $html;
            })
            ->editColumn('created', function ($data) {
                return date('d F Y H:i', strtotime($data->created_at));
            })
            ->editColumn('action', function ($data) {
                $html = '
                <div class="dropdown">
                    <button class="btn btn-dark btn-sm datatable-action" type="button" data="'.encrypt($data->id).'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-dots-horizontal m-0"></i>
                    </button>
                    <div class="dropdown-menu datatable-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="'.url('/admin/profile', [$data->id]).'">View</a>
                        <a class="dropdown-item" href="'.url('/admin/post', [$data->id]).'">Edit</a>
                        <a class="dropdown-item text-danger delete" href="javascript: void(0)">Move to trash</a>
                    </div>
                </div>';
                return $html;
            })
            ->rawColumns(['username','avatar','action'])
            ->make(true);
    }
}
