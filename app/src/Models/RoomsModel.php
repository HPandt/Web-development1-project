<?php 

namespace App\Models;

class RoomsModel{
    public int $id;
    public int $dungeon_id;
    public ?string $description;
    public string $type;
    public ?int $north_room_id;
    public ?int $south_room_id;
    public ?int $east_room_id;
    public ?int $west_room_id;
    public bool $discovered;

}
