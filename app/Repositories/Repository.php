<?php


namespace App\Repositories;


use App\Article;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    /**
     * @var Model|Article
     * @mixin \Eloquent
     */
    protected $model = false;

    /**
     * @return Collection
     */
    public function get($select = '*', $take = false, $pagination = false, $order = false, $category_id = false)
    {
        $builder = $this->model->select($select);

        if($take){
            $builder->take($take);
        }

        if($order == 'desc'){
            $builder->orderByDesc('created_at');
        }

//      TODO: переделать на ->where($where[0],$where[1]
        if ($category_id){
            $builder->where('category_id', $category_id);
        }

        if($pagination){
            return $this->check($builder->paginate(\Config::get('settings.paginate')));
        }
        return $this->check($builder->get());

    }

    /**
     * @param $get Collection
     * @return Collection
     */
    private function check($get)
    {
//        if ($get->isEmpty()){
//            //TODO: хз что тут вернуть
//            return $get;
//        }
        $get->transform(function($item, $key){
            if (is_string($item->img) && is_object(json_decode($item->img)) && json_last_error() == JSON_ERROR_NONE){
                $item->img = json_decode($item->img);
            }
           return $item;
        });
//        dd($get);
        return $get;
    }


}
