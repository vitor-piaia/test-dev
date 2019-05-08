<?php

namespace App\Repository\Contracts;

interface RepositoryInterface
{
    /**
     * Consulta de todos os registros
     * @param array $columns
     * @return mixed
     */
    public function all(array $columns = array('*'));

    /**
     * Consulta de registros paginados
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate(int $perPage = 20, array $columns = array('*'));

    /**
     * Adição de registros
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Atualização de registro
     * @param array $data
     * @param mixed $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id, string $attribute = 'id');

    /**
     * Exclusão de registro pelo id
     * @param $id
     * @return mixed
     */
    public function destroy($id);

    /**
     * Exclusão de todos os registros
     * @return int
     */
    public function deleteAll();

    /**
     * Consulta de registro
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, array $columns = array('*'));

    /**
     * Consulta de registro a partir de campo
     * @param string $field
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy(string $field, $value, array $columns = array('*'));

    /**
     * Eager loading na consulta a se efetuar
     * @param string|array $relations
     * @return mixed
     */
    public function with($relations);
}