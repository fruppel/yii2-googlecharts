yii2-googlecharts
=================

Google Charts widget for Yii2 (see https://developers.google.com/chart/)

Installation
------------
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require "fruppel/yii2-googlecharts" "*"
```
or add

```json
"fruppel/yii2-googlecharts" : "*"
```

to the require section of your application's `composer.json` file.

Usage
-----
Example:

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
