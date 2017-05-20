<?php

namespace App\Models\Tags;

use Illuminate\Database\Eloquent\Model;

class TagsEloquent extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tags';

    /**
     * Get stores which are related to this product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function stores()
    {
        return $this->belongsToMany('App\Models\Stores\StoresEloquent', 'store_tags', 'tag_id', 'store_id')->withTimestamps();
    }
}
