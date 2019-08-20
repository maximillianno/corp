<?php

namespace App\Http\Controllers;

use App\Article;
use App\Menu;
use App\Repositories\ArticlesRepository;
use App\Repositories\MenuRepository;
use App\Repositories\PortfolioRepository;
use App\Repositories\SliderRepository;
use Arr;
use Illuminate\Http\Request;

class ArticleController extends SiteController
{
    public function __construct(PortfolioRepository $portfolioRepository, ArticlesRepository $articlesRepository)
    {
        parent::__construct(new MenuRepository(new Menu()));

        $this->p_rep = $portfolioRepository;
        $this->a_rep = $articlesRepository;

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
//        $portfolios = $this->getPortfolio();
//
//        $content = view(env('THEME').'.articles_content')->with(compact('portfolios'))->render();
        $content = view(env('THEME').'.articles_content')->render();
        $this->vars = Arr::add($this->vars, 'content', $content);

        $articles = $this->getArticles();
        $this->contentRightBar = view(env('THEME').'.indexBar')->with(compact('articles'))->render();

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


    private function getArticles($alias = false)
    {
        $articles = $this->a_rep->get('*', false, true);

        return $articles;


    }
}
