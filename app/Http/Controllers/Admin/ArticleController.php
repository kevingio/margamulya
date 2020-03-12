<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleImage;
use App\Models\ContributorType;
use Image;

class ArticleController extends Controller
{
    function __construct(Article $article, ArticleImage $article_image, ContributorType $contributorType)
    {
        $this->article = $article;
        $this->article_image = $article_image;
        $this->contributorType = $contributorType;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articleTypes = $this->contributorType->get();
        return view('web.admin.article.index', compact('articleTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articleTypes = $this->contributorType->get();
        return view('web.admin.article.create-article', compact('articleTypes'));
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
                $fileSize = filesize(storage_path('app' . $filepath));

				$img->removeAttribute('src');
                $img->setAttribute('src', str_replace('public','storage',$filepath));
                $article_assets[] = [
                    'filename' => $filepath,
                    'mime_type' => $mimetype,
                    'size' => $fileSize
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
        $article = $this->article->where(function ($query) {
                                    if (auth()->user()->role !== 'admin') {
                                        $query->where('user_id', auth()->id());
                                    }
                                })
                                ->findOrFail($id);
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
        $article = $this->article->where(function ($query) {
                                    if (auth()->user()->role !== 'admin') {
                                        $query->where('user_id', auth()->id());
                                    }
                                })->findOrFail($id);
        $data = $request->except('content');
		$content = $request->content;

        if($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'file|mimes:jpeg,jpg,gif,png',
            ]);

            if(!empty($article->background_img)) {
                $path = storage_path() . '/app/' . $article->background_img;
                if(file_exists($path)) {
                    unlink($path);
                }
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
                $fileSize = filesize(storage_path('app' . $filepath));

				$img->removeAttribute('src');
				$img->setAttribute('src', str_replace('public','storage',$filepath));
                $article_assets[] = [
                    'filename' => $filepath,
                    'mime_type' => $mimetype,
                    'size' => $fileSize
                ];
			}
		}

        $data['content'] = $dom->saveHTML();
        $data['user_id'] = auth()->user()->id;
        $article->update($data);

        $old_assets = $this->article_image->where('article_id', $id)->get();
        if(!empty($article_assets)) {
            foreach ($old_assets as $asset) {
                $path = storage_path() . '/app/' . $asset->filename;
                if(file_exists($path)) {
                    unlink($path);
                }
            }
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
            $path = storage_path() . '/app/' . $article->background_img;
            if(file_exists($path)) {
                unlink($path);
            }
        }
        $article->delete();
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
                return $this->article->datatable($request->type);
                break;
        }
    }
}
