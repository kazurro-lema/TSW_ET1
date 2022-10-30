<?php require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$gasto = $view->getVariable("gasto");
$errors = $view->getVariable("errors");
$view->setVariable("title", "Add Gasto");
?>

<card-form>
	<mat-card class="mat-card">
		<mat-card-header class="mat-card-header card-title">
			<?= i18n("Create gasto") ?>
		</mat-card-header>
		<card-fieldset>
			<form action="index.php?controller=gastos&amp;action=add" method="POST">
				<section>
					<form-element style="flex: 1 1 100%; max-width: 100%;">
						<label class="label" for="nombre"><?= i18n("nombre_gasto") ?></label>
						<input type="text" name="nombre_gasto" required>
						<?= isset($errors["nombre_gasto"]) ? i18n($errors["nombre_gasto"]) : "" ?>
					</form-element>

					<form-element style="flex: 1 1 33.33%; max-width: 33.33%;">
						<label class="label" for="nombre"><?= i18n("cantidad_gasto") ?></label>
						<input type="text" name="cantidad_gasto" required>
						<?= isset($errors["cantidad_gasto"]) ? i18n($errors["cantidad_gasto"]) : "" ?>
					</form-element>

					<form-element style="flex: 1 1 33.33%; max-width: 33.33%;">
						<label class="label" for="nombre"><?= i18n("tipo_gasto") ?></label>
						<select name="tipo" selected required>
							<option value="alimentacion">Alimentacion</option>
							<option value="ocio">Ocio</option>
							<option value="liquidaciones">Liquidaciones</option>
							<option value="pagos">Pagos</option>
						</select>
					</form-element>

					<form-element style="flex: 1 1 33.33%; max-width: 33.33%;">
						<label class="label" for="nombre"><?= i18n("entidad") ?></label>
						<input type="text" name="entidad">
						<?= isset($errors["entidad"]) ? i18n($errors["entidad"]) : "" ?>
					</form-element>

					<form-element style="flex: 1 1 100%; max-width: 100%;">
						<label class="label" for="nombre"><?= i18n("descripcion") ?></label>
						<textarea name="descripcion" rows="4" cols="50"></textarea>
						<?= isset($errors["descripcion"]) ? i18n($errors["descripcion"]) : "" ?>
					</form-element>

					<form-element style="flex: 1 1 50%; max-width: 50%;">
						<label class="label" for="nombre"><?= i18n("fecha") ?></label>
						<input type="date" name="fecha" required>
						<?= isset($errors["fecha"]) ? i18n($errors["fecha"]) : "" ?>
					</form-element>

					<form-element style="flex: 1 1 50%; max-width: 50%;">
						<label class="label" for="nombre"><?= i18n("fichero") ?></label>
						<input type="file" name="fichero">
						<?= isset($errors["fichero"]) ? i18n($errors["fichero"]) : "" ?>
					</form-element>

					<div class="form-button-panel">
						<input class="submit-button" type="submit" name="submit" value="<?= i18n("Add") ?>">
					</div>

				</section>
			</form>
		</card-fieldset>
	</mat-card>
</card-form>