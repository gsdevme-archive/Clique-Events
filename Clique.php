<?php

	function bootstrap(){
		$root = realpath(__DIR__) . '/';

		libxml_use_internal_errors(true);

		set_error_handler(function($errno, $errstr, $errfile, $errline ) {
			throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
		});

		spl_autoload_register(function($class) use ($root){
			$file = $root . str_replace('\\', '/', $class) . '.php';

			if(file_exists($file)){
				return require $file;
			}
		}, true, true);
	};

	bootstrap();
	$events = new \Clique\Events();

	$events->setPlayerDictionary(array(
		'Vil' => 'Vilmariand',
		'Vilmari' => 'Vilmariand',
		'Vilmariand' => 'Vilmariand',
		'Esbina' => 'Vilmariand',

		'Ava' => 'Avallach',
		'Avallach' => 'Avallach',

		'Chandak' => 'Chandak',
		'Chan' => 'Chandak',

		'Tenac' => 'Tenac',

		'Poke' => 'Poke',

		'Tray' => 'Tray',

		'Jeni' => 'Jeni',

		'Thefurian' => 'Thefurian',

		'Milaneir' => 'Milaneir',
		'Mila' => 'Milaneir',
		'Mil' => 'Milaneir',

		'Cronin' => 'Cronin',
		'Cron' => 'Cronin',
		'Cro' => 'Cronin',

		'Morb' => 'Morb',
		'Drunna' => 'Morb',

		'Maisham' => 'Maisham',
		'Maitia' => 'Maisham',
		'Mai' => 'Maisham',

		'Floggy' => 'Floggy',

		'Borric' => 'Borric',

		'Say' => 'Saylina',
		'Saylina' => 'Saylina',

	));

	$event = $events->getCurrentEvent();
	print_r($event);