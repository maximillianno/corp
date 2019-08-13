<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Repositories\ArticlesRepository;
use App\Repositories\MenuRepository;
use App\Repositories\PortfolioRepository;
use App\Repositories\SliderRepository;
use App\Slider;
use Arr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends SiteController
{
    /**
     * IndexController constructor.
     * @param Request $request
     */
    public function __construct(Request $request, SliderRepository $sliderRepository,
                                PortfolioRepository $portfolioRepository, ArticlesRepository $articlesRepository)
    {
        parent::__construct(new MenuRepository(new Menu()));

        $this->s_rep = $sliderRepository;
        $this->p_rep = $portfolioRepository;
        $this->a_rep = $articlesRepository;

        $this->template = env('THEME').'.index';
        $this->bar = 'right';

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(Request $request)
    {
        //
//        dd($this);

//        pathinfo($request, PATHINFO_EXTENSION);



        $portfolios = $this->getPortfolio();

        $content = view(env('THEME').'.content')->with(compact('portfolios'))->render();
        $this->vars = Arr::add($this->vars, 'content', $content);

        $articles = $this->getArticles();
        $this->contentRightBar = view(env('THEME').'.indexBar')->with(compact('articles'))->render();



        $sliderItems = $this->getSliders();

        $slides = view(env('THEME').'.slider')->with('sliders', $sliderItems)->render();
        $this->vars = Arr::add($this->vars, 'slides', $slides);



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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function getSliders()
    {
        $sliders = $this->s_rep->get();

        if($sliders->isEmpty()){

            return false;
        }
        $sliders->transform(function($item, $key){

            $item->img = \Config::get('settings.slider_path').'/'.$item->img;

            return $item;
        });

        return $sliders;

    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getPortfolio()
    {
        $portfolio = $this->p_rep->get('*', \Config::get('settings.home_port_count'));
        return $portfolio;

    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getArticles()
    {
        $articles = $this->a_rep->get(['title', 'created_at', 'img', 'alias'], \Config::get('settings.home_articles_count'));
        return $articles;

    }
}
