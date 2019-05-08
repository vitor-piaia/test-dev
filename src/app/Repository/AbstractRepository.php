<?php

namespace App\Repository;

use App\Filter\FilterInterface;
use App\Order\OrderInterface;
use App\Repository\Contracts\SortInterface;
use App\Utilities\Utils;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;
use App\Repository\Contracts\CriteriaInterface;
use App\Repository\Contracts\RepositoryInterface;
use Illuminate\Support\Facades\DB;

abstract class AbstractRepository implements RepositoryInterface, CriteriaInterface, SortInterface
{
    /**
     * @var App
     */
    private $app;

    /**
     * @var Model $model
     */
    protected $model;

    /**
     * @var FilterInterface
     */
    protected $criteria;

    /**
     * @var OrderInterface
     */
    protected $order;

    /**
     * @var bool
     */
    protected $skipCriteria = false;

    public function __construct(App $app, Collection $criteria, Collection $order)
    {
        $this->app = $app;
        $this->criteria = $criteria;
        $this->order = $order;
        $this->makeModel();
        $this->resetScope();
    }

    /**
     * Devolve namespace da model do repositorio
     * @return string
     */
    abstract public function model();

    /**
     * Criação da instância da model utilizando IoC
     * @throws \Exception
     */
    private function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        $this->model = $model;
    }

    /**
     * Consulta de todos os registros
     * @param array $columns
     * @return mixed
     */
    public function all(array $columns = array('*'))
    {
        $this->applyCriteria();
        $this->applyOrder();
        return $this->model->get($columns);
    }

    /**
     * Consulta de registros paginados
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate(int $perPage = 20, array $columns = array('*'))
    {
        $this->applyCriteria();
        $this->applyOrder();

        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @param mixed $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id, string $attribute = 'id')
    {
        if ($this->model instanceof Model) {
            $data = $this->model->fill($data);
            $data = $this->toArrayAbstract($data);
        }

        return $this->model->where($attribute, '=', $id)->update($data);
    }

    /**
     * @param array $data
     * @param array $keys
     * @param bool $userChange
     * @return bool
     */
    public function updateMultiple(array $data, array $keys, bool $userChange = true)
    {
        $model = $this->model;
        foreach ($keys as $field => $attribute) {
            $model = $model->where($field, $attribute);
        }

        if ($userChange) {
            $data['usualt'] = Utils::currentUser()['id'];
        }

        if ($this->model instanceof Model) {
            $data = $this->model->fill($data)->toArray();
        }
        return $model->update($data);
    }

    /**
     * Exclusão de registro pelo id
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * Exclusão de todos os registros
     * @return int
     */
    public function deleteAll()
    {
        $model = $this->model;
        if ($model instanceof Builder) {
            $model = app()->make($this->model());
        }

        $table = $model->getTable();
        return DB::table($table)->delete();
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, array $columns = array('*'))
    {
        return $this->model->find($id, $columns);
    }

    /**
     * @param string $field
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy(string $field, $value, array $columns = array('*'))
    {
        return $this->model->where($field, '=', $value)->first($columns);
    }

    /**
     * Reseta o escopo de filtro para retornar o skipScriteria ao valor default
     * @return $this
     */
    public function resetScope()
    {
        $this->skipCriteria(false);
        return $this;
    }

    /**
     * Na próxima consulta irá desconsiderar o filtro
     * @param bool $status
     * @return $this
     */
    public function skipCriteria(bool $status = true)
    {
        $this->skipCriteria = $status;
        return $this;
    }

    /**
     * Recupera todos os filtros
     * @return FilterInterface
     */
    public function getCriteria()
    {
        return $this->criteria;
    }

    /**
     * Efetua a consulta por um filtro específico
     * @param FilterInterface $criteria
     * @return $this
     */
    public function getByCriteria(FilterInterface $criteria)
    {
        $this->model = $criteria->apply($this->model, $this);
        return $this;
    }

    /**
     * @param FilterInterface $criteria
     * @return $this
     */
    public function pushCriteria(FilterInterface $criteria)
    {
        $this->criteria->push($criteria);
        return $this;
    }

    /**
     * @return $this
     */
    public function applyCriteria()
    {
        if ($this->skipCriteria === true) {
            return $this;
        }

        foreach ($this->getCriteria() as $criteria) {
            if ($criteria instanceof FilterInterface) {
                $this->model = $criteria->apply($this->model);
            }
        }

        return $this;
    }

    /**
     * @return OrderInterface
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param OrderInterface $order
     * @return $this
     */
    public function pushOrder(OrderInterface $order)
    {
        $this->order->push($order);
        return $this;
    }

    /**
     * @return $this
     */
    public function applyOrder()
    {
        foreach ($this->getOrder() as $order) {
            if ($order instanceof OrderInterface) {
                $this->model = $order->apply($this->model);
            }
        }

        return $this;
    }

    /**
     * Eager loading na consulta a se efetuar
     * @param string|array $relations
     * @return $this
     */
    public function with($relations)
    {
        if (!is_array($relations)) {
            if (!is_string($relations)) {
                throw new \InvalidArgumentException('$relations must be array or string');
            }

            $relations = [$relations];
        }

        $this->model = $this->model->with($relations);
        return $this;
    }

    /**
     * Transforma o objeto Eloquent em array.
     * @param $data
     * @return mixed
     */
    private function toArrayAbstract($data)
    {
        return $data->getAttributes();
    }
}
