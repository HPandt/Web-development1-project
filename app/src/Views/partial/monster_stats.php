<?php

use App\Models\ViewModels\MonstersViewModel;

/** @var MonstersViewModel $monstersVm  */

foreach ($monstersVm->monsters as $monster) { ?>
    <li>Health: <?php echo htmlspecialchars($monster->hp); ?></li>
    <li>Strength: <?php echo htmlspecialchars($monster->strength); ?></li>
    <li>Defense: <?php echo htmlspecialchars($monster->agility); ?></li>
<?php } ?>