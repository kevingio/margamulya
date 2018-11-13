<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Jenssegers\Agent\Agent;
use App\Models\Article;
use App\Models\ArticleView;
use App\Models\Jemaat;
use App\Models\Calendar;
use App\Models\Warta;
use App\Models\File;
use Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Article $article, Jemaat $jemaat, Calendar $calendar, Warta $warta, File $file, ArticleView $article_view, Agent $agent)
    {
        $articles = $article->with('user')->orderBy('created_at', 'desc')->take(15)->get();
        $this->latest_articles = $this->latestArticles($articles);
        $this->calendars = $calendar->where('date', '>=', date('Y-m-d'))->take(15)->get();
        $this->article = $article;
        $this->warta = $warta;
        $this->jemaat = $jemaat;
        $this->file = $file;
        $this->event = $calendar;
        $this->article_view = $article_view;
        $this->isMobile = $agent->isMobile();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function latestArticles($articles)
    {
        foreach ($articles as $article) {
            if(!empty($article->background_img)) {
                $article->background_img = Storage::url($article->background_img);
            }
        }
        return $articles;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $birthday = $this->jemaat->getBirthday();
        $anniversary = $this->jemaat->getAnniversary();

        $events = $this->event->where('date', '<=', date('Y-m-d'))->take(4)->get();
        foreach ($events as $event) {
            if(!empty($event->thumbnail)) {
                $event->thumbnail = Storage::url($event->thumbnail);
            }
            $event->date = date('l, d F Y', strtotime($event->date));
            $event->start_hour = date('H:i', strtotime($event->start_hour));
            $event->end_hour = date('H:i', strtotime($event->end_hour));
        }

        $files = $this->file->with('calendar')->whereNull('mime_type')->orderBy('created_at', 'desc')->take(4)->get();
        foreach ($files as $file) {
            $temp = explode('?v=', $file->filename);
            $file->filename = $temp[1];
            $file->thumbnail = "https://img.youtube.com/vi/".$temp[1]."/2.jpg";
        }

        return view('web.home.index')
                ->with('latest_articles', $this->latest_articles)
                ->with('calendars', $this->calendars)
                ->with('events', $events)
                ->with('birthday', $birthday)
                ->with('anniversary', $anniversary)
                ->with('files', $files);
    }

    /**
     * Show the directory page
     *
     * @return \Illuminate\Http\Response
     */
    public function directory()
    {
        return view('web.directory.index')
                ->with('latest_articles', $this->latest_articles)
                ->with('calendars', $this->calendars);
    }

    /**
     * Show the article page
     *
     * @return \Illuminate\Http\Response
     */
    public function article()
    {
        $articles = $this->article->with('user')->orderBy('created_at', 'desc')->simplePaginate(15);
        foreach ($articles as $article) {
            if(!empty($article->background_img)) {
                $article->background_img = Storage::url($article->background_img);
            }
        }
        return view('web.article.index')
                ->with('latest_articles', $this->latest_articles)
                ->with('articles', $articles)
                ->with('calendars', $this->calendars);
    }

    /**
     * Show detail article
     *
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function showArticle($id)
    {
        $data['ip_address'] = request()->ip();
        $data['article_id'] = $id;
        $is_viewed = $this->article_view->where('ip_address', $data['ip_address'])->where('article_id', $data['article_id'])->first();
        if(empty($is_viewed)) {
            $this->article_view->create($data);
        }
        $article = $this->article->with(['user', 'article_view'])->find($id);
        if(!empty($article->background_img)) {
            $article->background_img = Storage::url($article->background_img);
        }
        $articles = $this->article->with('user')->where('id', '!=', $id)->orderBy('created_at', 'desc')->take(15)->get();
        $latest_articles = $this->latestArticles($articles);
        return view('web.article.detail')
                ->with('latest_articles', $latest_articles)
                ->with('calendars', $this->calendars)
                ->with('article', $article)
                ->with('isMobile', $this->isMobile);
    }

    /**
     * Show the event page
     *
     * @return \Illuminate\Http\Response
     */
    public function event()
    {
        $events = $this->event->where('date', '<=', date('Y-m-d'))->simplePaginate(15);
        foreach ($events as $event) {
            if(!empty($event->thumbnail)) {
                $event->thumbnail = Storage::url($event->thumbnail);
            }
            $event->date = date('l, d F Y', strtotime($event->date));
        }
        return view('web.event.index')
                ->with('latest_articles', $this->latest_articles)
                ->with('events', $events);
    }

    /**
     * Show detail event
     *
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function showEvent($id)
    {
        $event = $this->event->with('user')->find($id);
        $event->date = date('l, d F Y', strtotime($event->date));
        $event->start_hour = date('H:i', strtotime($event->start_hour));
        $event->end_hour = date('H:i', strtotime($event->end_hour));

        $photos = $this->file->whereNotNull('mime_type')
                            ->where('calendar_id', $event->id)
                            ->get();
        foreach ($photos as $photo) {
            $photo->filename = Storage::url($photo->filename);
        }
        $videos = $this->file->whereNull('mime_type')
                            ->where('calendar_id', $event->id)
                            ->get();
        foreach ($videos as $video) {
            $temp = explode('?v=', $video->filename);
            $video->filename = $temp[1];
            $video->thumbnail = "https://img.youtube.com/vi/".$temp[1]."/2.jpg";
        }
        return view('web.event.detail')
                ->with('latest_articles', $this->latest_articles)
                ->with('event', $event)
                ->with('photos', $photos)
                ->with('videos', $videos)
                ->with('isMobile', $this->isMobile);
    }

    /**
     * Show the warta jemaat page
     *
     * @return \Illuminate\Http\Response
     */
    public function wartaJemaat()
    {
        $wartas = $this->warta->with('user')->where('type', 'jemaat')->orderBy('created_at', 'desc')->simplePaginate(15);
        return view('web.warta-jemaat.index')
                ->with('latest_articles', $this->latest_articles)
                ->with('calendars', $this->calendars)
                ->with('wartas', $wartas);
    }

    /**
     * Show detail warta jemaat
     *
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function showWartaJemaat($id)
    {
        $warta = $this->warta->find($id);
        $warta->path = Storage::url($warta->path);
        $wartas = $this->warta->with('user')->where('type', 'jemaat')->where('id', '!=', $id)->orderBy('created_at', 'desc')->take(15)->get();
        return view('web.warta-jemaat.detail')
                ->with('latest_articles', $this->latest_articles)
                ->with('calendars', $this->calendars)
                ->with('warta', $warta)
                ->with('wartas', $wartas)
                ->with('isMobile', $this->isMobile);
    }

    /**
     * Show the warta umum page
     *
     * @return \Illuminate\Http\Response
     */
    public function wartaUmum()
    {
        $wartas = $this->warta->with('user')->where('type', 'umum')->orderBy('created_at', 'desc')->simplePaginate(15);
        return view('web.warta-umum.index')
                ->with('latest_articles', $this->latest_articles)
                ->with('calendars', $this->calendars)
                ->with('wartas', $wartas);
    }

    /**
     * Show detail warta umum
     *
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function showWartaUmum($id)
    {
        $warta = $this->warta->find($id);
        $warta->path = Storage::url($warta->path);
        $wartas = $this->warta->with('user')
                                ->where('type', 'umum')
                                ->where('id', '!=', $id)
                                ->orderBy('created_at', 'desc')
                                ->take(15)
                                ->get();
        return view('web.warta-umum.detail')
                ->with('latest_articles', $this->latest_articles)
                ->with('calendars', $this->calendars)
                ->with('warta', $warta)
                ->with('wartas', $wartas)
                ->with('isMobile', $this->isMobile);
    }

    /**
     * Show the warta jemaat page
     *
     * @param string $page
     * @return \Illuminate\Http\Response
     */
    public function showMenuAbout($page)
    {
        switch ($page) {
            case 'gpib':
                return view('web.about.gpib.index')->with('latest_articles', $this->latest_articles)
                                            ->with('calendars', $this->calendars);
                break;
            case 'gpib-margamulya':
                return view('web.about.margamulya.index')->with('latest_articles', $this->latest_articles)
                                            ->with('calendars', $this->calendars);
                break;

            default:
                return redirect()->back();
                break;
        }
    }

    /**
     * Send contact form to admin via email
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendMailContact(Request $request)
    {
        $data = $request->all();
        $mail = Mail::send('emails.contact-form', $data, function($message) {
            $message->to('inforkom@gpibmargamulya.or.id', 'GPIB Marga Mulya Admin')
                    ->subject('Website Interaction')
                    ->from('no-reply@gpibmargamulya.or.id','GPIB Marga Mulya Web');
        });
        return response()->json(['status' => 200]);
    }

    /**
     * Searching articles, wartas, and events
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchSuggestions(Request $request)
    {
        $birthday = $this->jemaat->getBirthday();
        $anniversary = $this->jemaat->getAnniversary();

        $query = $request->q;
        $articles = $this->article->with('user')
                                    ->selectRaw("title as value, concat('article/',id) as data")
                                    ->where('title', 'like', "%{$query}%")
                                    ->orderBy('created_at', 'desc')
                                    ->take(5)
                                    ->get();
        $wartas = $this->warta->with('user')
                                    ->selectRaw("title as value, concat('warta-',type,'/',id) as data")
                                    ->where('title', 'like', "%{$query}%")
                                    ->orderBy('created_at', 'desc')
                                    ->take(5)
                                    ->get();

        $events = $this->event->where('date', '<=', date('Y-m-d'))
                                ->selectRaw("title as value, concat('event/',id) as data")
                                ->where('title', 'like', "%{$query}%")
                                ->orderBy('date')
                                ->take(5)
                                ->get();

        foreach ($events as $event) {
            if(!empty($event->thumbnail)) {
                $event->thumbnail = Storage::url($event->thumbnail);
            }
            $event->date = date('l, d F Y', strtotime($event->date));
        }

        $results = array_merge($articles->toArray(), $wartas->toArray(), $events->toArray());

        return response()->json([
            'suggestions' => $results
        ]);
    }
}
