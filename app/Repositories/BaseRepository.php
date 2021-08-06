<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Create Object
     *
     * @param array $data
     * @return Model
     */
    public function persist(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Fetch last collection
     *
     * @param string $id
     * @return Model
     */
    public function last()
    {
        return $this->model->orderBy('created_at', 'desc')->first();
    }

    /**
     * Fetch Collection
     *
     * @return Collection
     */
    public function get()
    {
        return $this->model->get();
    }

    /**
     * Delete Collection
     *
     * @param string $id
     *
     * @return boolean
     */
    public function delete(string $id)
    {
        return $this->findOrFail($id)->delete();
    }

    public function update(string $id, array $data)
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }
}
