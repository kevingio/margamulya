<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Yajra\Datatables\Datatables;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'password', 'avatar', 'role', 'contributor_type_id'
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
     * Relation to Contributor
     *
     */
    public function contributorType()
    {
        return $this->belongsTo(ContributorType::class);
    }

    /**
     * Get Datatable Data
     * @return array
     */
    public function datatable()
    {

        $datas = Self::where('role', 'user')->orderBy('created_at', 'desc')->get();
        return Datatables::of($datas)
            ->editColumn('contributor_type', function ($data) {
                return $data->contributorType->name;
            })
            ->editColumn('action', function ($data) {
                $html = '
                <div class="dropdown">
                    <button class="btn btn-dark btn-sm datatable-action" type="button" data="'.encrypt($data->id).'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-dots-horizontal m-0"></i>
                    </button>
                    <div class="dropdown-menu datatable-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item edit" href="javascript:void(0)">Edit</a>
                        <a class="dropdown-item text-danger delete" href="javascript:void(0)">Delete</a>
                    </div>
                </div>';
                return $html;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
