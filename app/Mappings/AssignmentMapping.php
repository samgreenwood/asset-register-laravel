<?php

namespace App\Mappings;

use App\Entities\Asset;
use App\Entities\Assignment;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;

class AssignmentMapping extends EntityMapping
{
    /**
     * @return string
     */
    public function mapFor()
    {
        return Assignment::class;
    }

    /**
     * @param Fluent $builder
     */
    public function map(Fluent $builder)
    {
        $builder->increments('id');
        $builder->string('assignedAt')->name('assigned_at');
        $builder->field('member', 'assignedBy')->name('assigned_by');
        $builder->text('notes');
        $builder->belongsTo(Asset::class, 'asset');
        $builder->field('assignable', 'previousLocation')->name('previous_location_id');
        $builder->field('assignable', 'location')->name('location_id');
    }
}