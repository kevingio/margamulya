<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;

class Jemaat extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'dob', 'anniversary', 'address', 'gender', 'couple_id', 'sector'
    ];

    /**
     * Relation to self
     *
     */
    public function couple()
    {
        return $this->hasOne('App\Models\Jemaat', 'id', 'couple_id');
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
     * Get birthday list
     * @param integer $take
     * @return array
     */
    public function getBirthday($take=0)
    {
        // $from_month = date('m');
        // $to_month = date('m', strtotime('+1 week'));
        //
        // $from_day = date('d');
        // $to_day = date('d', strtotime('+1 week'));
        //
        // if($to_day > 6) {
        //     $birthday = Self::whereMonth('dob', '>=', $from_month)
        //                     ->whereMonth('dob', '<=', $to_month)
        //                     ->whereDay('dob', '>=', $from_day)
        //                     ->whereDay('dob', '<=', $to_day);
        // } else {
        //     $birthday = Self::whereMonth('dob', '>=', $from_month)
        //                     ->orWhereMonth('dob', '<=', $to_month)
        //                     ->whereDay('dob', '>=', $from_day)
        //                     ->orWhereDay('dob', '<=', $to_day);
        // }
        $birthday = Self::whereMonth('dob', date('m'))
                        ->whereDay('dob', date('d'));
        // dd($birthday->toSql());
        if($take > 0) {
            $birthday = $birthday->take($take);
        }
        return $birthday->whereNotNull('dob')->latest()->get();
    }

    /**
     * Get anniversary list
     * @param integer $take
     * @return array
     */
    public function getAnniversary($take=0)
    {
        // $from_month = date('m');
        // $to_month = date('m', strtotime('+1 week'));
        //
        // $from_day = date('d');
        // $to_day = date('d', strtotime('+1 week'));
        // $anniversary = Self::whereNotNull('anniversary')
        //                     ->whereMonth('anniversary', '>=', $from_month)
        //                     ->whereMonth('anniversary', '<=', $to_month)
        //                     ->whereDay('anniversary', '>=', $from_day)
        //                     ->whereDay('anniversary', '<=', $to_day)
        //                     ->orderBy('anniversary');
        $anniversary = Self::whereNotNull('anniversary')
                            ->whereMonth('anniversary', date('m'))
                            ->whereDay('anniversary', date('d'))
                            ->orderBy('anniversary');
        if($take > 0) {
            $anniversary = $anniversary->take($take);
        }
        return $anniversary->get();
    }

    /**
     * Get Datatable Data
     * @return array
     */
    public function select2($keyword)
    {
        $jemaats = Self::where('name', 'like', "%{$keyword}%")->whereNull('couple_id')->get();
        foreach ($jemaats as $jemaat) {
            $jemaat->text = $jemaat->name . ', ' . $jemaat->sector;
        }
        return response()->json($jemaats);
    }

    /**
     * Get Datatable Data
     * @return array
     */
    public function datatable()
    {
        $datas = Self::with('couple')->orderBy('created_at', 'desc')->get();
        return Datatables::of($datas)
            ->editColumn('dob', function ($data) {
                return date('d F Y', strtotime($data->dob));
            })
            ->editColumn('aniversary', function ($data) {
                return (empty($data->anniversary) ? '-' : date('d F Y', strtotime($data->anniversary)));
            })
            ->editColumn('couple', function ($data) {
                return (empty($data->couple) ? '-' : $data->couple->name);
            })
            ->editColumn('sector', function ($data) {
                return (empty($data->sector) ? '-' : $data->sector);
            })
            ->editColumn('action', function ($data) {
                $html = '
                <div class="dropdown">
                    <button class="btn btn-dark btn-sm datatable-action" type="button" data="'.encrypt($data->id).'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-dots-horizontal m-0"></i>
                    </button>
                    <div class="dropdown-menu datatable-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item edit" href="javascript: void(0)">Edit</a>
                        <a class="dropdown-item text-danger delete" href="javascript: void(0)">Move to trash</a>
                    </div>
                </div>';
                return $html;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
