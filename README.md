Google Charts widget for Yii2
=================

A wrapper for Google's charts API (see https://developers.google.com/chart/) to use it with Yii2.

Installation
------------
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

```
composer require fruppel/yii2-googlecharts
```


Usage
-----
Example 1: 3D PieChart with data in DataTable format

![demo](https://cloud.githubusercontent.com/assets/3985601/4497539/fb54bd70-4a6f-11e4-89a3-7c96c9fd9f0e.jpg)
```
<?php
use \fruppel\googlecharts\GoogleCharts;
...
?>

<?= GoogleCharts::widget([
	'id' => 'my-id',
	'visualization' => 'PieChart',
	'data' => [
		'cols' => [
            [
	            'id' => 'topping',
                'label' => 'Topping',
				'type' => 'string'
            ],
	        [
		        'id' => 'slices',
		        'label' => 'Slices',
		        'type' => 'number'
	        ]
        ],
        'rows' => [
	        [
		        'c' => [
					['v' => 'Mushrooms'],
			        ['v' => 3]
		        ],
	        ],
	        [
		        'c' => [
			        ['v' => 'Onions'],
			        ['v' => 1]
		        ]
	        ],
	        [
		        'c' => [
			        ['v' => 'Olives'],
			        ['v' => 1]
		        ]
	        ],
	        [
		        'c' => [
			        ['v' => 'Zucchini'],
                    ['v' => 1]
		        ]
	        ],
	        [
		        'c' => [
			        ['v' => 'Pepperoni'],
                    ['v' => 2]
		        ]
	        ],
        ]
    ],
    'options' => [
        'title' => 'How Much Pizza I Ate Last Night',
        'width' => 400,
        'height' => 300,
        'is3D' => true,
    ],
    'responsive' => true,
]) ?>
```

Example 2: AreaChart with data array (will be converted to DataTable) 

![demo2](https://cloud.githubusercontent.com/assets/3985601/4530310/b1ce75fc-4d7f-11e4-923f-79500c7df15b.jpg)
```
<?php
use \fruppel\googlecharts\GoogleCharts;
...
<?= GoogleCharts::widget([
	'visualization' => 'AreaChart',
		'options' => [
			'title' => 'Company Performance',
			'hAxis' => [
				'title' => 'Year',
				'titleTextStyle' => [
					'color' => '#333'
				]
			],
			'vAxis' => [
				'minValue' => 0
			]
		],
	'dataArray' => [
	        ['Year', 'Sales', 'Expenses'],
	        ['2013',  1000,      400],
	        ['2014',  1170,      460],
	        ['2015',  660,       1120],
	        ['2016',  1030,      540]
	]
])
?>

```

Render charts as png image
--------------------------
Set the $asPng option to true like the example below
```
<?= GoogleCharts::widget([
	'asPng' => true,
	...
```
Note: This works currently only for core charts and geocharts.
See the charts documentation for more information: https://developers.google.com/chart/interactive/docs/printing
