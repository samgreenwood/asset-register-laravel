<?php

namespace App\Repositories;

interface NodeRepository {
    /**
     * @return Node[]
     */
    public function all();

    /**
     * @param $id
     * @return Node
     */
    public function findById($id);

}