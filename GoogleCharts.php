<?php

namespace fruppel\googlecharts;

use Yii;
use yii\base\InvalidConfigException;
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
	 * @var array $data DataTable object
	 */
	public $data = [];

	/**
	 * @var array $options Additional configuration options
	 */
	public $options = [];

	/**
	 * @var string $packages A list of Google chart libraries to load. The default 'corechart' library defines the
	 * most basic charts
	 */
	public $packages = 'corechart';

	/**
	 * @var bool $responsive If set to boolean true the widget adapts to the parent container on resize
	 */
	public $responsive = false;

	/**
	 * @var string $version Which version of the visualization to load. 1.0 is always the current production
	 * version.
	 */
	public $version = '1.0';

	/**
	 * @var string $visualization The google.visualization library. This library defines all the core utility
	 * classes and functions.
	 */
	public $visualization = '';

	/**
	 * @throws InvalidConfigException
	 */
	public function init()
	{
		parent::init();
		if (!$this->visualization) {
			throw new InvalidConfigException("'visualization' needs to be set, e.g. 'PieChart' or 'BarChart'");
		}

		if ($this->responsive) {
			$this->options['width'] = '100%';
		}

		$this->data = json_encode($this->data);
		$this->options = json_encode($this->options);
	}

	/**
	 * @inheritdoc
	 */
	public function run()
	{
		$this->registerAssets();

		echo '<div id="googlechart_' . $this->getId() . '"></div>';
	}

	protected function registerAssets()
	{
		$view = $this->getView();
		$view->registerJsFile('https://www.google.com/jsapi', ['position' => View::POS_HEAD]);
		$js = "
			google.load('visualization', '" . $this->version . "', {'packages':['" . $this->packages . "']});
			google.setOnLoadCallback(drawChart);

			function drawChart() {
		      // Create the data table.
		      var data = new google.visualization.DataTable(JSON.parse('" . $this->data . "'));

		      // Set chart options
		      var options = " . $this->options . ";

		      // Instantiate and draw our chart, passing in some options.
		      var chart = new google.visualization." . $this->visualization . "(document.getElementById('googlechart_". $this->getId() . "'));
		      chart.draw(data, options);
			}";

		$view->registerJs($js, View::POS_HEAD);

		if ($this->responsive) {
			$view->registerJs("$(window).resize(drawChart)", View::POS_END);
		}
	}
}