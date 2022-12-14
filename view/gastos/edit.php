<?php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$gasto = $view->getVariable("gasto");
$errors = $view->getVariable("errors");

$view->setVariable("title", "Edit Gasto");

?>

<card-form>
	<mat-card class="mat-card">
		<mat-card-header class="mat-card-header card-title">
			<div class="mat-card-header-text"></div> <?= i18n("Modify gasto") ?>
		</mat-card-header>
		<card-fieldset>
			<form action="index.php?controller=gastos&amp;action=edit" method="POST">
				<section>
					<form-element style="flex: 1 1 100%;">
						<label class="label" for="nombre"><?= i18n("nombre_gasto") ?></label>
						<input type="text" name="nombre_gasto" value="<?= isset($_POST["nombre_gasto"]) ? $_POST["nombre_gasto"] : $gasto->getNombreGasto() ?>" required>
						<?= isset($errors["nombre_gasto"]) ? i18n($errors["nombre_gasto"]) : "" ?>
					</form-element>

					<form-element style="flex: 1 1 33.33%;">
						<label class="label" for="nombre"><?= i18n("cantidad_gasto") ?> </label>
						<input type="text" name="cantidad_gasto" value="<?= isset($_POST["cantidad_gasto"]) ? $_POST["cantidad_gasto"] : $gasto->getCantidadGasto() ?>" required>
						<?= isset($errors["cantidad_gasto"]) ? i18n($errors["cantidad_gasto"]) : "" ?>
					</form-element>

					<form-element style="flex: 1 1 33.33%;">
						<label class="label" for="tipo"><?= i18n("tipo") ?></label>
						<select id="tipo" name="tipo" value="<?= $gasto->getTipo() ?>" required>
							<option value="alimentacion">Alimentacion</option>
							<option value="ocio">Ocio</option>
							<option value="liquidaciones">Liquidaciones</option>
							<option value="pagos">Pagos</option>
						</select>
					</form-element>

					<script>
						let selectType = document.getElementById("tipo");
						selectType.value = '<?= $gasto->getTipo() ?>';
					</script>

					<form-element style="flex: 1 1 33.33%;">
						<label class="label" for="entidad"><?= i18n("entidad") ?></label>
						<input type="text" name="entidad" value="<?= isset($_POST["entidad"]) ? $_POST["entidad"] : $gasto->getEntidad() ?>">
						<?= isset($errors["entidad"]) ? i18n($errors["entidad"]) : "" ?>
					</form-element>

					<form-element style="flex: 1 1 100%;">
						<label class="label" for="descripcion"><?= i18n("descripcion") ?></label>
						<textarea name="descripcion" rows="4" cols="50" value="<?= isset($_POST["descripcion"]) ? $_POST["descripcion"] : $gasto->getDescripcion() ?>"><?= htmlentities($gasto->getDescripcion()) ?></textarea>
						<?= isset($errors["descripcion"]) ? i18n($errors["descripcion"]) : "" ?>
					</form-element>

					<form-element style="flex: 1 1 50%;">
						<label class="label" for="fecha"><?= i18n("fecha") ?></label>
						<input type="date" name="fecha" value="<?= isset($_POST["fecha"]) ? $_POST["fecha"] : $gasto->getFecha() ?>" required>
						<?= isset($errors["fecha"]) ? i18n($errors["fecha"]) : "" ?>
					</form-element>

					<form-element style="flex: 1 1 50%;">
						<label class="label" for="fichero"><?= i18n("fichero") ?></label>
						<input type="file" name="fichero" value="<?= isset($_POST["fichero"]) ? $_POST["fichero"] : $gasto->getFichero() ?>">
						<?= isset($errors["fichero"]) ? i18n($errors["fichero"]) : "" ?>
					</form-element>

					<input type="hidden" name="id" value="<?= $gasto->getId() ?>">

					<div class="form-button-panel">
						<input class="submit-button" type="submit" name="submit" value="<?= i18n("Edit") ?>">
					</div>

				</section>
			</form>
		</card-fieldset>
	</mat-card>
</card-form>