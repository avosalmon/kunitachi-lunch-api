<?php

namespace App\Models\Shops;

use App\Models\ModelMetaProperties;

class Shops
{
    use ModelMetaProperties;

    /**
     * ShopsEloquent instance.
     *
     * @var App\Models\Shops\ShopsEloquent
     */
    protected $shops;

    /**
     * Array of related relationship models.
     *
     * @var array
     */
    protected $relationships;

    /**
     * Offset for queries made by this instance.
     *
     * @var int
     */
    protected $offset = 0;

    /**
     * Limit for queries made by this instance.
     *
     * @var int
     */
    protected $limit = 10;

    /**
     * Sort column for queries made by this instance.
     *
     * @var string
     */
    protected $sort = 'id';

    /**
     * Sort direction for queries made by this instance.
     *
     * @var string
     */
    protected $direction = 'desc';

    /**
     * Create new instances for dependencies.
     *
     * @param App\Models\Shops\ShopsEloquent $shops
     * @param array $relationships
     *
     */
    public function __construct(ShopsEloquent $shops, array $relationships = [])
    {
        $this->shops         = $shops;
        $this->relationships = $relationships;
    }

    /**
     * Get all shops
     *
     * @return \Illuminate\Database\Eloquent\Model|Collection|static
     */
    public function all()
    {
        return $this->shops
                    ->skip($this->offset)
                    ->take($this->limit)
                    ->orderBy($this->sort, $this->direction)
                    ->get();
    }

    /**
     * Get count for store
     *
     * @return \Illuminate\Database\Eloquent\Model|Collection|static
     */
    public function count()
    {
        return $this->shops->count();
    }

    /**
     * Get all shops with nested relationships
     *
     * @param  array $relationships
     * @return \Illuminate\Database\Eloquent\Model|Collection|static
     */
    public function allWith($relationships)
    {
        if (! $this->validateRelationships($relationships)) {
            return null;
        }

        return $this->shops
                    ->with($relationships)
                    ->skip($this->offset)
                    ->take($this->limit)
                    ->orderBy($this->sort, $this->direction)
                    ->get();
    }

    /**
     * Get single store by id
     *
     * @param  int $id
     * @param  bool $throw
     * @return \Illuminate\Database\Eloquent\Model|Collection|static
     */
    public function find($id, $throw = false)
    {
        if ($throw) {
            return $this->shops->findOrFail($id);
        }

        return $this->shops->find($id);
    }

    /**
     * Get single store by specified column
     *
     * @param  array $where
     * @param  bool $throw
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function findBy($where, $throw = false)
    {
        if ($throw) {
            return $this->shops->where($where)->firstOrFail();
        }

        return $this->shops->where($where)->first();
    }

    /**
     * Update the specified store
     *
     * @param  int $id
     * @param  array $data
     * @return bool
     */
    public function update($id, $data)
    {
        $store = $this->shops->find($id);

        if ($store) {
            return $store->update($data);
        }

        return false;
    }

    /**
     * Create a new store
     *
     * @param  array $data
     * @return \Illuminate\Database\Eloquent\Model|Collection|static
     */
    public function create($data)
    {
        return $this->shops->create($data);
    }

    /**
     * Destroy the specified store
     *
     * @param  int $id
     * @return bool
     */
    public function destroy($id)
    {
        // TODO: detach all relationships
        //
        // foreach ($this->relationships as $relationship) {
        //     $relationship->detachAll($id);
        // }

        return $this->shops->destroy($id);
    }

    /**
     * Validate relationships
     *
     * @param  array $relationships
     * @return bool
     */
    protected function validateRelationships($relationships)
    {
        foreach ($relationships as $relationship) {
            if (! method_exists($this->shops, $relationship)) {
                return false;
            }
        }

        return true;
    }
}
