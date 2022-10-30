<?php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$filters = $view->getVariable("filters");
$gastos = $view->getVariable("gastos");
$gastosOnLast12Months = $view->getVariable("gastosOnLast12Months");
$currentuser = $view->getVariable("currentusername");

$view->setVariable("title", "Gastos");

?>

<card-form>
	<mat-card class="mat-card">
		<mat-card-header class="mat-card-header card-title" id="filterDropDown">
			<?= i18n("Charts") ?>
			<mat-icon class='material-icons material-symbols-outlined'>unfold_more</mat-icon>
		</mat-card-header>
		<card-fieldset id="filter">
			<form action="index.php?controller=gastos&amp;action=charts" method="POST">
				<section>
				<form-element style="flex: 1 1 100%;">
						<label class="label"><?= i18n("tipo") ?></label>
						<select name="tipo[]" multiple>
							<option value="alimentacion">Alimentacion</option>
							<option value="ocio">Ocio</option>
							<option value="liquidaciones">Liquidaciones</option>
							<option value="pagos">Pagos</option>
						</select>
					</form-element>

					<form-element style="flex: 1 1 50%;">
						<label class="label"><?= i18n("FechaIni") ?></label>
						<input type="date" name="fechaIni" value="<?= isset($_POST["fechaIni"]) ? $_POST["fechaIni"] : $filters->getFechaIni() ?>">
					</form-element>

					<form-element style="flex: 1 1 50%;">
						<label class="label"><?= i18n("FechaFin") ?></label>
						<input type="date" name="fechaFin" value="<?= isset($_POST["fechaFin"]) ? $_POST["fechaFin"] : $filters->getFechaFin() ?>">
					</form-element>

					<div class="form-button-panel">
						<input class="submit-button" type="submit" name="submit" value="<?= i18n("Filtrar") ?>">
					</div>
				</section>
			</form>
		</card-fieldset>
	</mat-card>
</card-form>

<div>
	<div class="chart-dashboard">
		<figure class="highcharts-figure">
			<div id="container"></div>
			<p class="highcharts-description">
			</p>
		</figure>
	</div>

	<div class="chart-dashboard">
		<figure class="highcharts-figure">
			<div id="container2"></div>
			<p class="highcharts-description">
			</p>
		</figure>
	</div>
</div>

<script>
	window.docReady(() => {
		createAndAddPieChart();
		createAndAddLineChart();
	});

	$("#filterDropDown").click(function() {

		$("#filter").slideToggle("slow");
	});

	function createAndAddPieChart() {

		let datos = [];
		let hashmap = new Map();

		<?php foreach ($gastos as $gasto) : ?>

			$cantidad = 0;

			if(hashmap.get('<?php echo $gasto->getTipo(); ?>') != null){
				$cantidad = hashmap.get('<?php echo $gasto->getTipo(); ?>');
			}

			hashmap.set('<?php echo $gasto->getTipo(); ?>', $cantidad + <?php echo $gasto->getCantidadGasto(); ?>);
		<?php endforeach; ?>

		hashmap.forEach((value, key) => {

			datos.push({
				name: key,
				y: value,
			});
		});

		Highcharts.chart('container2', {
			chart: {
				type: 'pie'
			},
			title: {
				text: 'Tipos de gastos'
			},
			tooltip: {
				formatter: function() {
					return '<b>' + this.point.name + '</b>: ' + this.y+ '€';
				}
			},
			plotOptions: {
				pie: {
					shadow: false
				}
			},
			series: [{
				name: 'Brands',
				colorByPoint: true,
				data: datos,
				innerSize: '40%',
				showInLegend: true,
				dataLabels: {
					enabled: false
				}
			}]
		});
	};

	function getLast12Months() {

		let mesesIntervalo = [];
		const month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

		let monthNum = new Date().getMonth();

		for (var i = 0; i < 12; i++) {

			monthNum += 1;

			if (monthNum > 11) {
				monthNum = 0;
			}

			let name = month[monthNum];
			mesesIntervalo.push(name);
		}

		return mesesIntervalo;
	}

	function createAndAddLineChart() {

		let hashmap = new Map();
		const mesesIntervalo = getLast12Months();

		// Init hasMap with 0 values

		<?php foreach ($gastosOnLast12Months as $gasto) : ?>

			hashmap.set('<?php echo $gasto->getTipo(); ?>', [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]);
		<?php endforeach; ?>

		// Associate payments to his date and his type

		<?php foreach ($gastosOnLast12Months as $gasto) : ?>

			month = new Date('<?php echo $gasto->getFecha(); ?>').getMonth();

			arr = hashmap.get('<?php echo $gasto->getTipo(); ?>');
			arr[month] += 1;

			hashmap.set('<?php echo $gasto->getTipo(); ?>', arr);
		<?php endforeach; ?>

		// Create the structure for the series highcharts

		let datos = [];

		hashmap.forEach((value, key) => {

			datos.push({
				name: key,
				data: value,
			});
		});

		Highcharts.chart('container', {
			title: {
				text: 'Tipos de Gastos del último año'
			},

			yAxis: {
				title: {
					text: 'Gastos'
				}
			},

			xAxis: {
				categories: mesesIntervalo
			},

			legend: {
				layout: 'vertical',
				align: 'right',
				verticalAlign: 'middle'
			},

			plotOptions: {
				series: {
					label: {
						connectorAllowed: false
					}
				}
			},

			series: datos,

			responsive: {
				rules: [{
					condition: {
						maxWidth: 500
					},
					chartOptions: {
						legend: {
							layout: 'horizontal',
							align: 'center',
							verticalAlign: 'bottom'
						}
					}
				}]
			}

		});
	}
</script>