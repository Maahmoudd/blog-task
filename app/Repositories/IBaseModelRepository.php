<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

interface IBaseModelRepository
{
    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    public function update($id, array $attributes);
    public function updateBulk(array $attributes, array $uniqueColumns, array $updateColumns);

    /**
     * Instead of writing lots of repetitive code, just use this to check and update a parameter
     * in the model if its null
     *
     * Used instead of insertOrUpdate as we just want to update if its not null
     *
     * @param $model
     * @param $fieldName
     * @param $newValue
     * @return mixed
     */
    public function setAttributeIfNull(&$model, $fieldName, $newValue);

    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model;

    /**
     * Get All Models of this Model
     *
     * @return Collection
     */
    public function all(): Paginator;

    public function delete($id);
}
