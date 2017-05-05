<?php

namespace App\Http\Models\Stores;

use App\Http\Models\ModelMetaProperties;

class Stores
{
    use ModelMetaProperties;

    /**
     * StoresEloquent instance.
     *
     * @var App\Http\Models\Stores\StoresEloquent
     */
    protected $stores;

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
     * @param App\Http\Models\Stores\StoresEloquent $stores
     * @param array $relationships
     *
     */
    public function __construct(StoresEloquent $stores, array $relationships)
    {
        $this->stores        = $stores;
        $this->relationships = $relationships;
    }

    /**
     * Get all stores
     *
     * @return \Illuminate\Database\Eloquent\Model|Collection|static
     */
    public function all()
    {
        return $this->stores
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
        return $this->stores->count();
    }

    /**
     * Get all stores with nested relationships
     *
     * @param  array $relationships
     * @return \Illuminate\Database\Eloquent\Model|Collection|static
     */
    public function allWith($relationships)
    {
        if (! $relationships = $this->validateRelationships($relationships)) {
            return null;
        }

        return $this->stores
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
            return $this->stores->findOrFail($id);
        }

        return $this->stores->find($id);
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
            return $this->stores->where($where)->firstOrFail();
        }

        return $this->stores->where($where)->first();
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
        $store = $this->stores->find($id);

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
        return $this->stores->create($data);
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

        return $this->stores->destroy($id);
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
            if (! method_exists($this->stores, $relationship)) {
                return false;
            }
        }

        return true;
    }
}
