<?php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$gastos = $view->getVariable("gastos");
$currentuser = $view->getVariable("currentusername");

$view->setVariable("title", "Gastos");

?>

<card-form>
	<mat-card class="mat-card">
		<mat-card-header class="mat-card-header card-title">
			<?= i18n("Gastos") ?>
		</mat-card-header>

		<?php
			header('Content-Type: text/csv; charset=UTF-8');
			header('Content-Disposition: attachment; filename=data.csv');

			
		?>

		<?php foreach ($gastos as $gasto) : ?>

			<bill-card>
				<div class="bill-card">
					<mat-avatar>
						<mat-icon class="material-icons">payment</mat-icon>
					</mat-avatar>

					<div class="bill-info">
						<div class="bill-proccess">
							<span>
								<a href="index.php?controller=gastos&amp;action=view&amp;id=<?= $gasto->getId() ?>"><?= htmlentities($gasto->getNombreGasto()) ?></a>
							</span>
						</div>
						<div>
							<div class="bill-name"><span><?= $gasto->getDescripcion() ?></span></div>
							<div class="bill-time-info">
								<span><?= i18n("cantidad_gasto") ?>: <span><?= $gasto->getCantidadGasto() ?>€ </span> | </span>
								<span><?= i18n("fecha") ?>: <span><?= $gasto->getFecha() ?></span></span>
							</div>
						</div>
					</div>
					<div class="bill-actions">
						<div class="bill-actions-content">
							<div class="my-bill">
								<my-bill-actions>
									<button class="mat-icon-button btnOpenActions menu-actions">
										<a href="index.php?controller=gastos&amp;action=edit&amp;id=<?= $gasto->getId() ?>">
											<span class="mat-button-wrapper">
												<mat-icon class="material-icons">edit</mat-icon>
											</span>
										</a>
									</button>
								</my-bill-actions>
							</div>
							<div class="my-bill">
								<my-bill-actions>
									<button class="mat-icon-button btnOpenActions menu-actions">
										<form method="POST" action="index.php?controller=gastos&amp;action=delete" id="delete_gasto_<?= $gasto->getId(); ?>" style="display: inline">

											<input type="hidden" name="id" value="<?= $gasto->getId() ?>">
											<a href="#" onclick="
										if (confirm('<?= i18n("are you sure?") ?>')) {
														document.getElementById('delete_gasto_<?= $gasto->getId() ?>').submit()
										}">
												<span class="mat-button-wrapper">
													<mat-icon class="material-icons">delete</mat-icon>
												</span>
										</form>
										</a>
									</button>
								</my-bill-actions>
							</div>
						</div>
					</div>
				</div>
			</bill-card>

		<?php endforeach; ?>

	</mat-card>
</card-form>