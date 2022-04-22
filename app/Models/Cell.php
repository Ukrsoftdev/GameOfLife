<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    use HasFactory;

    /**
     * @var int|null
     */
    private int|null $key = null;

    /**
     * @var int
     */
    private int $status = 0;

    /**
     * @var array
     */
    private array $neighbors = [];


    /**
     * @return int|null
     */
    public function getKey(): int|null
    {
        return $this->key;
    }

    /**
     * @param int $key
     * @return void
     */
    public function setKey(int $key): void
    {
        $this->key = $key;
    }

    /**
     * @param int $status
     * @return void
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param array $neighbors
     * @return void
     */
    public function setNeighbors(array $neighbors): void
    {
        foreach ($neighbors as $key => $cell) {
            $this->neighbors[$key] = $cell;
        }
    }

    /**
     * @return array
     */
    public function getNeighbors(): array
    {
        return $this->neighbors;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        if ($this->key === null) {
            return parent::toArray();
        }
        return [$this->key => $this->status];
    }
}
