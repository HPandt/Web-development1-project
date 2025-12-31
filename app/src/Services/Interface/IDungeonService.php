<?php

namespace App\Services\Interface;

interface IDungeonService {
    public function createCharacter($userId, $characterName, $classType);
    public function updateCharacter($userId, $characterName, $classType);
    public function createItem();
    public function updateItem();
    public function createRoom($dungeonId, $name, $description, $monsters, $items, $exits);
    public function updateRoom($dungeonId, $roomId, $name, $description, $monsters, $items, $exits);
}