<?php

namespace App\Services\Interface;

use Apps\Models\ViewModels\RoomsViewModel; 

interface IRoomService {
    public function getRoomById(int $roomId);
    public function getNextRoom(array $currentRoom, string $dir);
    public function markDiscovered(int $roomId);
        
}