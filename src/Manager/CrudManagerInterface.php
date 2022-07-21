<?php

namespace App\Manager;

interface CrudManagerInterface {

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed;

    /**
     * @param int $id
     * @return mixed
     */
    public function read(int $id): mixed;

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update(array $data, int $id): mixed;

    /**
     * @param int $id
     */
    public function delete(int $id): void;

    /**
     * @return mixed
     */
    public function readAll(): mixed;
}