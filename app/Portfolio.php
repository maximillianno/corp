<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Portfolio
 *
 * @property-read \App\Filter $filter
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Portfolio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Portfolio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Portfolio query()
 * @mixin \Eloquent
 */
class Portfolio extends Model
{
    //
    public function filter()
    {
        return $this->belongsTo('App\Filter', 'filter_alias', 'alias');

    }
}
