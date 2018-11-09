<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleImage;
use Image;

class ArticleController extends Controller
{
    function __construct(Article $article, ArticleImage $article_image)
    {
        $this->article = $article;
        $this->article_image = $article_image;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('web.admin.article.index');
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
        $data = $request->except('content');
		$content = $request->content;
        if($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'required|file|mimes:jpeg,jpg,gif,png',
            ]);

            $file = $request->file('photo');
            $data['background_img'] = $file->store('public/articles');
        }

		$dom = new \DomDocument();
        libxml_use_internal_errors(true);
		$dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
		$images = $dom->getElementsByTagName('img');

        $article_assets = [];
		foreach($images as $img){
			$src = $img->getAttribute('src');
			if(preg_match('/data:image/', $src)){
				preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
				$mimetype = $groups['mime'];
				$filename = uniqid();
                $slug_title = str_slug($data['title']);
				$filepath = "/public/articles/$slug_title-$filename.$mimetype";
                $image = Image::make($src);
                Storage::put($filepath, (string) $image->encode());

				$img->removeAttribute('src');
				$img->setAttribute('src', str_replace('public','storage',$filepath));
                $article_assets[] = [
                    'filename' => $filepath,
                    'mime_type' => $mimetype,
                    'size' => $image->filesize()
                ];
			}
		}

        $data['content'] = $dom->saveHTML();
        $data['user_id'] = auth()->user()->id;
        $article = $this->article->create($data);

        foreach ($article_assets as $asset) {
            $asset['article_id'] = $article->id;
            $this->article_image->create($asset);
        }

		return redirect('/admin/article');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = $this->article->find($id);
        if(!empty($article->background_img)) {
            $article->background_img = Storage::url($article->background_img);
        }
        return view('web.admin.article.edit-article', compact('article'));
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
        $article = $this->article->find($id);
        $data = $request->except('content');
		$content = $request->content;

        if($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'file|mimes:jpeg,jpg,gif,png',
            ]);

            if(!empty($article->background_img)) {
                Storage::delete($article->background_img);
            }
            $file = $request->file('photo');
            $data['background_img'] = $file->store('public/articles');
        }

		$dom = new \DomDocument();
        libxml_use_internal_errors(true);
		$dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
		$images = $dom->getElementsByTagName('img');

        $article_assets = [];
		foreach($images as $img){
			$src = $img->getAttribute('src');
			if(preg_match('/data:image/', $src)){
				preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
				$mimetype = $groups['mime'];
				$filename = uniqid();
                $slug_title = str_slug($data['title']);
				$filepath = "/public/articles/$slug_title-$filename.$mimetype";
                $image = Image::make($src);
                Storage::put($filepath, (string) $image->encode());

				$img->removeAttribute('src');
				$img->setAttribute('src', str_replace('public','storage',$filepath));
                $article_assets[] = [
                    'filename' => $filepath,
                    'mime_type' => $mimetype,
                    'size' => $image->filesize()
                ];
			}
		}

        $data['content'] = $dom->saveHTML();
        $data['user_id'] = auth()->user()->id;
        $article->update($data);

        $old_assets = $this->article_image->where('article_id', $id)->get();
        foreach ($old_assets as $asset) {
            Storage::delete($asset->filename);
        }
        $this->article_image->where('article_id', $id)->delete();
        foreach ($article_assets as $asset) {
            $asset['article_id'] = $id;
            $this->article_image->create($asset);
        }

        return redirect('/admin/article');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = $this->article->find(decrypt($id));
        if(!empty($article->background_img)) {
            Storage::delete($article->background_img);
        }
        $article->delete();
        return response()->json(['status' => 200]);
    }

    /**
     * Display create article view
     *
     * @return \Illuminate\Http\Response
     */
    public function newArticle()
    {
        return view('web.admin.article.create-article');
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
                return $this->article->datatable();
                break;
        }
    }
}
