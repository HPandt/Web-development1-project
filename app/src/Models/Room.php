<?php

 class Room{


    // public function GetCurrentRoom($dungeonId){
        
    //     $fetchRoom = $this->pdo->prepare("SELECT * from rooms where dungeon_id=? AND discovered=1 ORDER BY id DESC LIMIT 1");
    //     $fetchRoom->execute([$dungeonId]);
    //     return $fetchRoom->fetch(PDO::FETCH_ASSOC);
    // }

    // public function moveToDirection($dungeonId, $direction){
    //     $current = $this->GetCurrentRoom($dungeonId);
    //     $room = $direction . '_room_id';
    //     if (!empty($current[$room])) {
    //         $updateRoom = $this->pdo->prepare("UPDATE rooms SET dicovered=1 WHERE id=?");
    //         $updateRoom->execute([$current[$room]]);
    //         $getRoom = $this->pdo->prepare("SELECT * FROM rooms WHERE id=?");
    //         $getRoom->execute([$current[$room]]);
    //         return $getRoom->fetch(PDO::FETCH_ASSOC);
    //     }
    //     return ['description' => "A wall blocks your path."];
    // }

    // public function randomizeRoom(){

    //     return 0;
    // }

 }
