<?php

namespace App\Repositories;

interface MemberRepository {
    /**
     * @return Member[]
     */
    public function all();

    /**
     * @param $id
     * @return Member
     */
    public function findById($id);

}