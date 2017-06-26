<?php

namespace App\Entities;

use Carbon\Carbon;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;

class Asset
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var Product
     */
    private $product;

    /**
     * @var string
     */
    private $purchaseReference;

    /**
     * @var DateTimeInterface
     */
    private $purchasedAt;

    /**
     * @var string
     */
    private $serial;

    /**
     * @var ArrayCollection
     */
    private $assignments;

    /**
     * Asset constructor.
     * @param Product $product
     * @param string $purchaseReference
     * @param DateTimeInterface $purchasedAt
     * @param string $serial
     */
    public function __construct(Product $product, string $purchaseReference, DateTimeInterface $purchasedAt, string $serial)
    {
        $this->product = $product;
        $this->purchaseReference = $purchaseReference;
        $this->purchasedAt = $purchasedAt;
        $this->assignments = new ArrayCollection();
        $this->serial = $serial;
    }

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->id;
    }

    /**
     * @return Product
     */
    public function product(): Product
    {
        return $this->product;
    }

    /**
     * @return DateTimeInterface
     */
    public function purchasedAt(): DateTimeInterface
    {
        return $this->purchasedAt;
    }

    /**
     * @return string
     */
    public function purchaseReference(): string
    {
        return $this->purchaseReference;
    }

    /**
     * @return Assignable
     */
    public function currentLocation(): Assignable
    {
        return $this->assignments()->first() ? $this->assignments->first()->location() : new NullLocation();
    }

    /**
     * @return Assignment
     */
    public function currentAssignment(): Assignment
    {
        return $this->assignments->first();
    }

    /**
     * @return Assignment[]|ArrayCollection
     */
    public function assignments()
    {
        return $this->assignments;
    }

    /**
     * @param Assignable $location
     * @param Member $assignedBy
     * @param string $notes
     */
    public function assign(Assignable $location, Member $assignedBy, string $notes)
    {
        $this->assignments[] = new Assignment(Carbon::now(), $assignedBy, $this, $location, $notes);
    }

    /**
     * @return string
     */
    public function serial(): string
    {
        return $this->serial;
    }

}