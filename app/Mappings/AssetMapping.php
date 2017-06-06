<?php

namespace App\Mappings;

use App\Entities\Asset;
use App\Entities\Assignment;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;

class AssetMapping extends EntityMapping
{
    /**
     * @return string
     */
    public function mapFor()
    {
        return Asset::class;
    }

    /**
     * @param Fluent $builder
     */
    public function map(Fluent $builder)
    {
        $builder->increments('id');
        $builder->string('purchaseReference');
        $builder->dateTime('purchasedAt');
        $builder->field('product', 'product')->name('product_id');
        $builder->hasMany(Assignment::class)->mappedBy('asset')->cascadePersist()->fetchEager()->orderBy('assignedAt', 'DESC');
    }
}