<?php

namespace App\Services\Interface;


interface ICombatService {
    
    public function fight( int $characterId, int $monsterId, int $roomId ): array;
}