<?php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$gastos = $view->getVariable("gastos");
$currentuser = $view->getVariable("currentusername");

$view->setVariable("title", "Gastos");

?>

<h1><?= i18n("Gastos") ?></h1>

<?php foreach ($gastos as $gasto) : ?>

	<bill-card>
		<div class="bill-card">
			<mat-avatar>
				<mat-icon class="material-icons">payments</mat-icon>
			</mat-avatar>

			<div class="bill-info">
				<div class="bill-proccess">
					<span>
						<a href="index.php?controller=gastos&amp;action=view&amp;id=<?= $gasto->getId() ?>"><?= htmlentities($gasto->getNombreGasto()) ?></a>
					</span>
				</div>
				<div>
					<div class="bill-name"><span><?= $gasto->getDescripcion() ?></span></div>
					<div class="bill-time-info"><span>Bill created: <span><?= $gasto->getFecha() ?></span></span></div>
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
								<span class="mat-button-wrapper">
									<mat-icon class="material-icons">delete</mat-icon>
								</span>
							</button>
						</my-bill-actions>
					</div>
				</div>
			</div>
		</div>
	</bill-card>
	
	<button class="submit-button">
		<form method="POST" action="index.php?controller=gastos&amp;action=delete" id="delete_gasto_<?= $gasto->getId(); ?>" style="display: inline">

			<input type="hidden" name="id" value="<?= $gasto->getId() ?>">
			<a href="#" onclick="
                    if (confirm('<?= i18n("are you sure?") ?>')) {
                            document.getElementById('delete_gasto_<?= $gasto->getId() ?>').submit()
                    }"><?= i18n("Delete") ?></a>
		</form>
	</button>

<?php endforeach; ?>