<?php

namespace App\Models\ViewModels;

use App\Models\RoomsModel;

class RoomsViewModel{
    /**
     * @var RoomsModel[]
     */

    public array $rooms;

    public function __construct(array $rooms = []){
        $this->rooms = $rooms;
    }
}