<?php

namespace App\Entities;

use Carbon\Carbon;
use DateTimeInterface;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="assets")
 */
class Asset
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var integer
     */
    private $id;

    /**
     * @var Product
     * @ORM\Column(type="string", name="product_id")
     */
    private $product;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $purchaseReference;

    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    private $purchasedAt;

    /**
     * @ORM\OneToMany(targetEntity="Assignment", mappedBy="asset")
     * @var Assignment[]
     */
    private $assignments;

    /**
     * Asset constructor.
     */
    public function __construct(Product $product, string $purchaseReference, DateTimeInterface $purchasedAt)
    {
        $this->product = $product;
        $this->purchaseReference = $purchaseReference;
        $this->purchasedAt = $purchasedAt;
        $this->assignments = new ArrayCollection();
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
     * @return DateTime
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
     * @param Assignable $assignable
     * @param User $assignedBy
     * @param string $
     */
    public function assign(Assignable $location, Member $assignedBy, string $notes)
    {
        $this->assignments[] = new Assignment(Carbon::now(), $assignedBy, $this, $location, $notes);
    }

}