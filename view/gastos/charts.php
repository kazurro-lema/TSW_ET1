<?php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$gastos = $view->getVariable("gastos");
$gastosOnLast12Months = $view->getVariable("gastosOnLast12Months");
$currentuser = $view->getVariable("currentusername");

$view->setVariable("title", "Gastos");

?>

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

<div class="options ng-trigger-openCloseFilters">
	<mat-tab-group class="mat-tab-group mat-tab-group-2 tabsGrcCatalog mat-primary">
		<mat-tab-header class="mat-tab-header">
			<div class="mat-tab-label-container">
				<div role="tablist" class="mat-tab-list" style="transform: translateX(0px);">
					<div class="mat-tab-labels">
						<div role="tab" class="mat-tab-label mat-tab-label-active" id="mat-tab-label-0-0" tabindex="0">
							<div class="mat-tab-label-content">
								<span><?= i18n("Filter") ?></span>
							</div>
						</div>
					</div>
					<mat-ink-bar class="mat-ink-bar" style="visibility: visible; left: 0px; width: 228px;"></mat-ink-bar>
				</div>
			</div>
		</mat-tab-header>
	</mat-tab-group>

</div>

<script>
	window.docReady(() => {
		createAndAddPieChart();
		createAndAddLineChart();
	});

	function createAndAddPieChart() {

		let datos = [];
		let hashmap = new Map();

		<?php foreach ($gastos as $gasto) : ?>

			hashmap.set('<?php echo $gasto->getTipo(); ?>', <?php echo $gasto->getCantidadGasto(); ?>);
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
					return '<b>' + this.point.name + '</b>: ' + this.y;
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
			arr[month] = <?php echo $gasto->getCantidadGasto(); ?>;

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