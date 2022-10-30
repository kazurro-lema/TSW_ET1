<?php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$gasto = $view->getVariable("gasto");
$errors = $view->getVariable("errors");

$view->setVariable("title", "View Gasto");

?>

<card-form>
	<mat-card class="mat-card">
		<mat-card-header class="mat-card-header card-title">
			<?= htmlentities($gasto->getNombreGasto()) ?>
		</mat-card-header>
		<card-fieldset>
			<form action="index.php?controller=gastos&amp;action=edit" method="POST">
				<section>
					<form-element style="flex: 1 1 100%;">
						<label class="label" for="nombre_gasto"><?= i18n("nombre_gasto") ?></label>
						<input type="text" name="nombre_gasto" value="<?= isset($_POST["nombre_gasto"]) ? $_POST["nombre_gasto"] : $gasto->getNombreGasto() ?>" disabled>
					</form-element>

					<form-element style="flex: 1 1 33.33%;">
						<label class="label" for="cantidad_gasto"><?= i18n("cantidad_gasto") ?></label>
						<input type="text" name="cantidad_gasto" value="<?= isset($_POST["cantidad_gasto"]) ? $_POST["cantidad_gasto"] : $gasto->getCantidadGasto() ?>" disabled>
					</form-element>

					<form-element style="flex: 1 1 33.33%;">
						<label class="label" for="tipo_gasto"><?= i18n("tipo_gasto") ?></label>
						<select name="tipo" selected value="<?= $gasto->getTipo() ?>" disabled>
							<option value="alimentacion">Alimentacion</option>
							<option value="ocio">Ocio</option>
							<option value="liquidaciones">Liquidaciones</option>
							<option value="pagos">Pagos</option>
						</select>
					</form-element>

					<form-element style="flex: 1 1 33.33%;">
						<label class="label" for="entidad"><?= i18n("entidad") ?></label>
						<input type="text" name="entidad" value="<?= isset($_POST["entidad"]) ? $_POST["entidad"] : $gasto->getEntidad() ?>" disabled>
					</form-element>

					<form-element style="flex: 1 1 100%;">
						<label class="label" for="descripcion"><?= i18n("descripcion") ?></label>
						<textarea name="descripcion" rows="4" cols="50" value="<?= isset($_POST["descripcion"]) ? $_POST["descripcion"] : $gasto->getDescripcion() ?>" disabled><?= htmlentities($gasto->getDescripcion()) ?></textarea>
					</form-element>

					<form-element style="flex: 1 1 50%;">
						<label class="label" for="fecha"><?= i18n("fecha") ?></label>
						<input type="date" name="fecha" value="<?= isset($_POST["fecha"]) ? $_POST["fecha"] : $gasto->getFecha() ?>" disabled>
					</form-element>

					<form-element style="flex: 1 1 50%;">
						<label class="label" for="fichero"><?= i18n("fichero") ?></label>
						<input type="file" name="fichero" value="<?= isset($_POST["fichero"]) ? $_POST["fichero"] : $gasto->getFichero() ?>" disabled>
					</form-element>

					<div class="form-button-panel">
						<button class="submit-button"><a href="index.php?controller=gastos&amp;action=edit&amp;id=<?= $gasto->getId() ?>"><?= i18n("Edit") ?></a></button>
						<button class="submit-button">
							<form method="POST" action="index.php?controller=gastos&amp;action=delete" id="delete_gasto_<?= $gasto->getId(); ?>" style="display: inline">

								<input type="hidden" name="id" value="<?= $gasto->getId() ?>">
								<a href="#" onclick="
                    if (confirm('<?= i18n("are you sure?") ?>')) {
                            document.getElementById('delete_gasto_<?= $gasto->getId() ?>').submit()
                    }"><?= i18n("Delete") ?></a>
							</form>
						</button>
					</div>

				</section>
			</form>
		</card-fieldset>
	</mat-card>
</card-form>