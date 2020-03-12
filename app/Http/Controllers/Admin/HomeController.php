<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleImage;
use App\Models\Jemaat;
use App\Models\File;
use App\Models\Warta;
use Rainwater\Active\Active;
use Jenssegers\Agent\Agent;
use DB;

class HomeController extends Controller
{
    function __construct(Article $article, Jemaat $jemaat, File $file, Warta $warta, ArticleImage $article_image, Agent $agent)
    {
        $this->article = $article;
        $this->article_image = $article_image;
        $this->jemaat = $jemaat;
        $this->file = $file;
        $this->warta = $warta;
        $this->agent = $agent;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $birthday = $this->jemaat->getBirthday();
        $anniversary = $this->jemaat->getAnniversary();

        $onlineUser = Active::guests()->count();
        $totalVisit = DB::table('sessions')->selectRaw('count(*) as total')->groupBy('payload')->get();
        $visitors = [
            'online' => $onlineUser,
            'total' => count($totalVisit)
        ];
        $count = [
            'jemaat' => $this->jemaat->getTotal(),
            'article' => $this->article->getTotal(),
            'photo' =>$this->file->getTotal('photo'),
            'warta' =>$this->warta->getTotal()
        ];
        $storage = [
            'photo' => number_format(($this->file->getSize('photo') + $this->article_image->getSize())/1000000000, 3),
            'warta' => $this->warta->getSize(),
            'system' => 0.20
        ];
        $isMobile = $this->agent->isMobile();
        return view('web.admin.dashboard.index', compact('count', 'photo_storage', 'storage', 'visitors', 'birthday', 'anniversary', 'isMobile'));
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
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
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
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort(404);
    }
}
