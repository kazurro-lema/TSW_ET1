<?php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$gastos = $view->getVariable("gastos");
$currentuser = $view->getVariable("currentusername");

$view->setVariable("title", "Gastos");

?>

<figure class="highcharts-figure">
	<div id="container"></div>
	<p class="highcharts-description">
	</p>
</figure>

<script>
	window.docReady(() => {
		createAndAddLineChart();
	});

	function createAndAddLineChart() {

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

		let mesesIntervalo = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

		Highcharts.chart('container', {
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false,
				type: 'pie'
			},
			title: {
				text: 'Tipos de gastos'
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.y:.1f}%</b>'
			},
			accessibility: {
				point: {
					valueSuffix: '%'
				}
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: true,
						format: '<b>{point.name}</b>: {point.percentage:.1f} %'
					}
				}
			},
			series: [{
				name: 'Brands',
				colorByPoint: true,
				data: datos
			}]
		});
	};
</script>