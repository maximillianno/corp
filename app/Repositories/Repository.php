<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    /**
     * @var Model
     */
    protected $model = false;

    /**
     * @return Collection
     */
    public function get($select = '*', $take = false, $pagination = false)
    {
        $builder = $this->model->select($select);

        if($take){
            $builder->take($take);
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
