<?php

namespace App\Repositories;

use App\Entities\Node;

class StaticNodeRepository implements NodeRepository {

    /**
     * StaticNodeRepository constructor.
     */
    public function __construct()
    {
        $this->nodeData = [];

        if (($handle = fopen(storage_path('app/nodes.csv'), "r")) !== FALSE) {

            while (($data = fgetcsv($handle, null, ",")) !== FALSE) {
                $this->nodeData[$data[0]] = new Node($data[0], $data[1]);
            }

            fclose($handle);
        }
    }

    /**
     * @return Node[]
     */
    public function all()
    {
        return collect($this->nodeData);
    }

    /**
     * @param $id
     * @return Node
     */
    public function findById($id)
    {
        return array_key_exists($id, $this->nodeData) ? $this->nodeData[$id] : null;
    }

}