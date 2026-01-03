





<div id="game-log">
    <?php foreach ($vm->getLog() as $line): ?>
        <div class="log-line">
            <?= htmlspecialchars($line) ?>
        </div>
    <?php endforeach; ?>
</div>


<script src="../../../public/js/gameLog.js"></script>