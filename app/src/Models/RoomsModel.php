<?php 

namespace App\Models;

class RoomsModel{
    public int $id;
    public int $dungeon_id;
    public ?string $description;
    public string $type;
    public ?int $northroom;
    public ?int $southroom;
    public ?int $eastroom;
    public ?int $westroom;
    public bool $discovered;

}
