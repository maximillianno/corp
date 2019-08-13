<?php

namespace App\Http\Controllers;

use App\Repositories\ArticlesRepository;
use App\Repositories\MenuRepository;
use App\Repositories\PortfolioRepository;
use App\Repositories\SliderRepository;
use Arr;
use Illuminate\Http\Request;
use Lavary\Menu\Menu;

class SiteController extends Controller
{
    //Repositories
    /**
     * @var PortfolioRepository
     */
    protected $p_rep;

    /**
     * @var SliderRepository
     */
    protected $s_rep;

    /**
     * @var ArticlesRepository
     */
    protected $a_rep;

    /**
     * @var MenuRepository
     */
    protected $m_rep;


    //Шаблон
    protected $template;

    //Переменные
    protected $vars;

    //Расположение бара
    protected $bar = 'no';

    /**
     * Отрендеренный контент с переданными статьями (indexBar.blade.php)
     * @var bool
     */
    protected $contentRightBar = false;
    protected $contentLeftBar = false;

    /**
     * SiteController constructor.
     * @param MenuRepository $menuRepository
     */
    public function __construct(MenuRepository $menuRepository)
    {
        $this->m_rep = $menuRepository;



    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    protected function renderOutput(){


        $menu = $this->getMenu();

        $navigation = view(env('THEME').'.navigation')->with($menu)->render();
        $this->vars = Arr::add($this->vars, 'navigation', $navigation);

        $this->vars = Arr::add($this->vars, 'bar', $this->bar);


        /**
         * Если контент бара отрендерен, то рендерим сам бар и записываем в переменные
         * для передачи в template под именем rightBar
         */
        if($this->contentRightBar){

            $rightBar = view(env('THEME').'.rightBar')->with('contentRightBar', $this->contentRightBar)->render();
            $this->vars = Arr::add($this->vars, 'rightBar', $rightBar);
        }

//        $this->vars = Arr::add($this->vars, 'menu', $menu);


        return view($this->template)->with($this->vars);
    }

    protected function getMenu()
    {

        $menu = $this->m_rep->get();

        $mBuilder = new Menu();
        $mBuilder->make('MyMenu', function ($m) use ($menu) {
//        $mBuilder = Menu::make('MyMenu', function ($m) use ($menu) {
            foreach ($menu as $item) {
                if ($item->parent_id == 0){
                    $m->add($item->title, $item->path)->id($item->id);
                } else {
                    if ($m->find($item->parent_id)){
                        $m->find($item->parent_id)->add($item->title, $item->path)->id($item->id);
                    }
                }

            }
        });
        $data = ['menu' => $menu, 'mBuilder' => $mBuilder->get('MyMenu')];
//        dd($data);
//        return $menu;
        return $data;
    }


}
