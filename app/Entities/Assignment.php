<?php

namespace App\Entities;

use Carbon\Carbon;
use DateTimeInterface;

class Assignment
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var DateTime
     */
    private $assignedAt;

    /**
     * @var Member
     */
    private $assignedBy;

    /**
     * @var Asset
     */
    private $asset;

    /**
     * @var string
     */
    private $notes;

    /**
     * @var Assignable
     */
    private $previousLocation;

    /**
     * @var Assignbale
     */
    private $location;

    /**
     * Assignment constructor.
     * @param DateTimeInterface $assignedAt
     * @param Member $assignedBy
     * @param Asset $asset
     * @param string $notes
     * @param Assignable $location
     */
    public function __construct(DateTimeInterface $assignedAt, Member $assignedBy, Asset $asset, Assignable $location, string $notes)
    {
        $this->assignedAt = $assignedAt;
        $this->assignedBy = $assignedBy;
        $this->previousLocation = $asset->currentLocation();
        $this->asset = $asset;
        $this->location = $location;
        $this->notes = $notes;
    }

    /**
     * @return DateTimeInterface
     */
    public function assignedAt(): DateTimeInterface
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->assignedAt);
    }

    /**
     * @return Member
     */
    public function assignedBy(): Member
    {
        return $this->assignedBy;
    }

    /**
     * @return Assignable
     */
    public function location(): Assignable
    {
        return $this->location;
    }

    /**
     * @return Assignable
     */
    public function previousLocation(): Assignable
    {
        return $this->previousLocation ?? new NullLocation();
    }

    /**
     * @return string
     */
    public function notes(): string
    {
        return $this->notes;
    }

}