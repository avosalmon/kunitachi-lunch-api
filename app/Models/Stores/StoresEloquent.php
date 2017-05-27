<?php

namespace App\Models\Stores;

use Illuminate\Database\Eloquent\Model;

class StoresEloquent extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stores';

    /**
     * Get tags which are related to this product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tags\TagsEloquent', 'store_tags', 'store_id', 'tag_id')->orderBy('display_order', 'asc')->withTimestamps();
    }

    /**
     * Get images which are related to this product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function images()
    {
        return $this->belongsToMany('App\Models\Images\ImagesEloquent', 'store_images', 'store_id', 'image_id')->withTimestamps();
    }
}
