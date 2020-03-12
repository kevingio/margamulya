<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;

class Article extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'user_id', 'background_img'
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
     * Relation to Article View
     *
     */
    public function article_view()
    {
        return $this->hasMany('App\Models\ArticleView');
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
     * Get Datatable Data
     * @return array
     */
    public function datatable($type)
    {
        $datas = Self::whereHas('user', function ($query) use ($type) {
                        if ($type != 'all') {
                            $query->where('contributor_type_id', $type);
                        }
                        if (auth()->user()->role == 'user') {
                            $query->where('user_id', auth()->id());
                        }
                    })
                    ->with(['user', 'article_view'])
                    ->latest()
                    ->get();
        return Datatables::of($datas)
            ->editColumn('title', function ($data) {
                return $data->title;
            })
            ->editColumn('author', function ($data) {
                return $data->user->name;
            })
            ->editColumn('views', function ($data) {
                $count = 0;
                if(!empty($data->article_view)) {
                    $count = count($data->article_view);
                }
                return $count;
            })
            ->editColumn('timestamp', function ($data) {
                return date('M d ,Y H:i', strtotime($data->created_at));
            })
            ->editColumn('action', function ($data) {
                $html = '
                <div class="dropdown">
                    <button class="btn btn-dark btn-sm datatable-action" type="button" data="'.encrypt($data->id).'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-dots-horizontal m-0"></i>
                    </button>
                    <div class="dropdown-menu datatable-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="'.url('/admin/article', [$data->id]).'">Edit</a>
                        <a class="dropdown-item text-danger delete" href="#">Move to trash</a>
                    </div>
                </div>';
                return $html;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
