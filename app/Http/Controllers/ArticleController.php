<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use App\Menu;
use App\Repositories\ArticlesRepository;
use App\Repositories\CommentsRepository;
use App\Repositories\MenuRepository;
use App\Repositories\PortfolioRepository;
use App\Repositories\SliderRepository;
use Arr;
use Illuminate\Http\Request;

class ArticleController extends SiteController
{


    public function __construct(PortfolioRepository $portfolioRepository,
                                ArticlesRepository $articlesRepository,
                                CommentsRepository $commentsRepository)
    {
        parent::__construct(new MenuRepository(new Menu()));

        $this->p_rep = $portfolioRepository;
        $this->a_rep = $articlesRepository;
        $this->c_rep = $commentsRepository;

        $this->template = env('THEME').'.articles';
        $this->bar = 'right';

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $portfolios = $this->getPortfolios(\Config::get('settings.recent_portfolios'));
//
//        $content = view(env('THEME').'.articles_content')->with(compact('portfolios'))->render();
        $articles = $this->getArticles();

        $content = view(env('THEME').'.articles_content')->with('articles', $articles)->render();
        $this->vars = Arr::add($this->vars, 'content', $content);
        $comments = $this->getComments(\Config::get('settings.recent_comments'));

        $this->contentRightBar = view(env('THEME').'.articlesBar')->with(compact('articles', 'comments', 'portfolios'))->render();

        return $this->renderOutput();

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }

    public function articlesCat($id)
    {

    }


    private function getArticles($alias = false)
    {
        $articles = $this->a_rep->get('*', false, true);

        return $articles;


    }

    private function getComments($get)
    {
//        $comments = Comment::orderBy('created_at', 'desc')->take($get)->get();
        $comments = $this->c_rep->get('*', $get, false, 'desc');
        return $comments;
    }

    private function getPortfolios($get)
    {
        $portfolios = $this->p_rep->get('*', $get);
        return $portfolios;

    }


}
