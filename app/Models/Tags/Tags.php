<?php

namespace App\Models\Tags;

use App\Models\ModelMetaProperties;

class Tags
{
    use ModelMetaProperties;

    /**
     * TagsEloquent instance.
     *
     * @var App\Models\Tags\TagsEloquent
     */
    protected $tags;

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
    protected $sort = 'display_order';

    /**
     * Sort direction for queries made by this instance.
     *
     * @var string
     */
    protected $direction = 'asc';

    /**
     * Create new instances for dependencies.
     *
     * @param App\Models\Tags\TagsEloquent $tags
     * @param array $relationships
     *
     */
    public function __construct(TagsEloquent $tags, array $relationships = [])
    {
        $this->tags          = $tags;
        $this->relationships = $relationships;
    }

    /**
     * Get all tags
     *
     * @return \Illuminate\Database\Eloquent\Model|Collection|static
     */
    public function all()
    {
        return $this->tags
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
        return $this->tags->count();
    }

    /**
     * Get all tags with nested relationships
     *
     * @param  array $relationships
     * @return \Illuminate\Database\Eloquent\Model|Collection|static
     */
    public function allWith($relationships)
    {
        if (! $relationships = $this->validateRelationships($relationships)) {
            return null;
        }

        return $this->tags
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
            return $this->tags->findOrFail($id);
        }

        return $this->tags->find($id);
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
            return $this->tags->where($where)->firstOrFail();
        }

        return $this->tags->where($where)->first();
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
        $store = $this->tags->find($id);

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
        return $this->tags->create($data);
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

        return $this->tags->destroy($id);
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
            if (! method_exists($this->tags, $relationship)) {
                return false;
            }
        }

        return true;
    }
}
