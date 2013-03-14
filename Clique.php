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
		'Vil' => 'Vil',
		'Vilmari' => 'Vil',
		'Vilmariand' => 'Vil',
		'Esbina' => 'Vil',

		'Ava' => 'Ava',
		'Avallach' => 'Ava',

		'Chandak' => 'Chan',
		'Chan' => 'Chan',

		'Tenac' => 'Tenac',

		'Poke' => 'Poke',

		'Tray' => 'Tray',

		'Jeni' => 'Jeni',

		'Thefurian' => 'Thefurian',

		'Milaneir' => 'Mila',
		'Mila' => 'Mila',
		'Mil' => 'Mila',

		'Cronin' => 'Cro',
		'Cron' => 'Cro',
		'Cro' => 'Cro',

		'Morb' => 'Morb',
		'Drunna' => 'Morb',

		'Maisham' => 'Mai',
		'Maitia' => 'Mai',
		'Mai' => 'Mai',

		'Floggy' => 'Floggy',

		'Borric' => 'Borric',

		'Say' => 'Say',
		'Saylina' => 'Say',

	));

	//$event = $events->getCurrentEvent();
	$event = $events->getEvent(360);

	$tweet = $event->raid . ', ' . $event->when->format('F j, Y, g:i a') . ' GMT+' . ($event->when->getOffset() / 3600);
	$tweet .= ' | Team: ' . (($event->team !== null) ? implode(', ', $event->team) : 'Unknown') . ' #Clique';

	echo '<pre>' . print_r($tweet, true) . '</pre>';
	echo '<pre>' . print_r(strlen($tweet), true) . '</pre>';


	//print_r($event);
	//print_r(implode(', ', $event->team));