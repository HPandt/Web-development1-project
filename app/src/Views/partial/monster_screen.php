<?php

use App\Models\MonsterModel;
use App\Models\ViewModels\MonstersViewModel;

/** @var MonsterViewModel $monsterVm
 * @var MonstersViewModel $monstersVm
  */
?>

<div class="monster-screen">
    <div class="monster-list d-flex flex-wrap justify-content-center">
        <?php foreach($monstersVm->monsters as $monster): ?>
            <div class="monster-card card m-2" style="width: 18rem;">
                <img src="<?php echo htmlspecialchars($monster->img); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($monster->name); ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($monster->name); ?></h5>
                    <p class="card-text">
                        HP: <?php echo htmlspecialchars($monster->hp); ?><br>
                        Strength: <?php echo htmlspecialchars($monster->strength); ?><br>
                        Agility: <?php echo htmlspecialchars($monster->agility); ?><br>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
