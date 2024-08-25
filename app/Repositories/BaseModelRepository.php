<?php

namespace App\Repositories;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseModelRepository implements IBaseModelRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes)
    {
        return $this->model->find($id)->update($attributes);
    }

    public function updateBulk(array $attributes, array $uniqueColumns, array $updateColumns)
    {
        return $this->model->upsert($attributes, $uniqueColumns, $updateColumns);
    }

    public function setAttributeIfNull(&$model, $fieldName, $newValue)
    {
        if (is_null($model->$fieldName) && !is_null($newValue)) {
            $model->$fieldName = $newValue;
        }
    }

    public function all(): Paginator
    {
        return $this->model->simplePaginate(10);
    }

    /**
     * @param $id
     * @return Model|null
     */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }


    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }
}
