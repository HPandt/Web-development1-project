 <?php

use App\Models\CharacterModel;
use App\Models\ViewModels\CharacterViewModel;
 /** @var CharacterViewModel $characters  
  * @var CharacterModel $character
 */
 
 ?>
 <div class="row">
    <div class="col-8">
        <div class="player-screen">
            <div class="col-7">
                <div class="card">
                    <div class="card-body">
                        <img class="img character-img" src="<?php echo htmlspecialchars($character->img); ?>" alt="Character Avatar" class="character-avatar mb-3">
                        <h5 class="card-title"><?php echo htmlspecialchars($character->name); ?></h5>
                </div>
            </div>
            <div class="col-5">
              <div class="stats">
                    <h2>Character Stats</h2>
                    <ul>
                        <?php require_once(__DIR__ . '/character_stats.php'); ?>
                    </ul>
                </div>
            </div>             
        </div>
    </div>
    <div class="col-4">
         <?php require_once(__DIR__ . '/../direction_arrows.php'); ?>
    </div>
 </div>
