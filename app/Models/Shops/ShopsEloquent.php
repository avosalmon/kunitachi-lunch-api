<?php

namespace App\Models\Shops;

use Illuminate\Database\Eloquent\Model;

class ShopsEloquent extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shops';

    /**
     * Get tags which are related to this product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tags\TagsEloquent', 'shop_tags', 'shop_id', 'tag_id')->orderBy('display_order', 'asc')->withTimestamps();
    }

    /**
     * Get images which are related to this product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function images()
    {
        return $this->belongsToMany('App\Models\Images\ImagesEloquent', 'shop_images', 'shop_id', 'image_id')->withTimestamps();
    }
}
