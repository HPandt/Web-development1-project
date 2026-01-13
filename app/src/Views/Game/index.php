
<?php require_once(__DIR__ . '/partial/header.php'); ?>

<div class="container py-5">
	<div class="row justify-content-center align-items-center" style="min-height:60vh;">
		<div class="col-md-6 col-lg-5">
			<div class="card shadow-sm">
				<div class="card-body p-4">
					<h2 class="card-title text-center mb-3">Dungeon Crawler</h2>

					<?php if(!empty($_GET['error'])): ?>
						<div class="alert alert-danger" role="alert">
							<?php echo htmlspecialchars($_GET['error']); ?>
						</div>
					<?php endif; ?>

					<button type="button" class="btn btn-primary w-100">Start Game</button>
                    <button type="button" class="btn btn-secondary w-100" disabled>Load Game</button>
                    <button type="button" class="btn btn-danger w-100">Exit Game</button>
				</div>
			</div>
		</div>
	</div>
</div>


<?php require_once(__DIR__ . '/partial/footer.php'); ?>