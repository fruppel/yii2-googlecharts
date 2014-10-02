<?php

namespace fruppel\googlecharts;

use Yii;
use yii\base\Widget;
use yii\web\View;

/**
 * Google Charts widget class
 *
 * @package fruppel\googlecharts
 */
class GoogleCharts extends Widget
{
	/**
	 * @var array $options additional configuration options
	 * @see https://google-developers.appspot.com/chart/interactive/docs/customizing_charts
	 */
	public $options = [];

	/**
	 * @inheritdoc
	 */
	public function run()
	{
		$this->registerAssets();

		echo '<div id="chart_div" style="width:400px; height:300px"></div>';
	}

	protected function registerAssets()
	{
		$view = $this->getView();
		$view->registerJsFile('https://www.google.com/jsapi', ['position' => View::POS_HEAD]);
		$js = <<< JS
google.load('visualization', '1.0', {'packages':['corechart']});
google.setOnLoadCallback(drawChart);

function drawChart() {
      // Create the data table.
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Topping');
      data.addColumn('number', 'Slices');
      data.addRows([
        ['Mushrooms', 3],
        ['Onions', 1],
        ['Olives', 1],
        ['Zucchini', 1],
        ['Pepperoni', 2]
      ]);

      // Set chart options
      var options = {'title':'How Much Pizza I Ate Last Night',
                     'width':400,
                     'height':300};

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      chart.draw(data, options);
}
JS;

		$view->registerJs($js, View::POS_HEAD);
	}
}