<?php

namespace App\Types;

use App\Entities\NullLocation;
use App\Repositories\MemberRepository;
use App\Repositories\NodeRepository;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class Assignable extends Type
{
    /**
     * Gets the SQL declaration snippet for a field of this type.
     *
     * @param array $fieldDeclaration The field declaration.
     * @param \Doctrine\DBAL\Platforms\AbstractPlatform $platform The currently used database platform.
     *
     * @return string
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getVarcharTypeDeclarationSQL($fieldDeclaration);
    }

    /**
     * Gets the name of this type.
     *
     * @return string
     */
    public function getName()
    {
        return 'assignable';
    }

    /**
     * @param \App\Entities\Node $value
     * @param AbstractPlatform $platform
     * @return Product
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return app(NodeRepository::class)->findById($value) ??
               app(MemberRepository::class)->findById($value) ??
               new NullLocation();
    }

    /**
     * @param \App\Entities\Node $value
     * @param AbstractPlatform $platform
     * @return mixed
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->uuid();
    }
}