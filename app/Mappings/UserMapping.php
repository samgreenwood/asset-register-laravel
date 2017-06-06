<?php

namespace App\Mappings;

use App\Entities\User;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;

class UserMapping extends EntityMapping
{
    /**
     * @return string
     */
    public function mapFor()
    {
        return User::class;
    }

    /**
     * @param Fluent $builder
     */
    public function map(Fluent $builder)
    {
        $builder->increments('id');
        $builder->string('firstname');
        $builder->string('surname');
        $builder->string('nickname');
        $builder->field('member', 'member')->name('member_id');
    }
}