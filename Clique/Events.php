<?php

	namespace Clique;

	use DateTime;
	use DateTimeZone;
	use Exception;

	class Events
	{
		const EVENTS_URL = 'http://cliqueguild.com/events/%u/';
		const EVENT_GRAB_URL = 'http://cliqueguild.com/';

		const CONNECTION_ERROR_MESSAGE = 'Failed to connect to Clique.. Perhaps Ava has tripped over some CAT5 cable';

		private $_today;
		private $_events;
		private $_playerDictionary = array();

		//	Sets current Date/Time
		public function __construct()
		{
			$this->_today = new DateTime(null, new DateTimeZone('UTC'));
		}

		public function setPlayerDictionary($dictionary)
		{
			$this->_playerDictionary = $dictionary;
		}

		//	Gets the current active Event
		public function getCurrentEvent()
		{
			try{
				$html = file_get_contents(self::EVENT_GRAB_URL, false, Stream::getContext());
			}catch(Exception $e){
				throw new Exceptions\Connection(self::CONNECTION_ERROR_MESSAGE);
			}

			$event = XPath::get($html, '//img[@class="bordered"]/..');

			if(($event) && ($event->length === 1)){
				return $this->getEvent((int)preg_replace('/[^0-9]/', null, $event->item(0)->getAttribute('href')));
			}

			return null;
		}

		//	Gets event information based on EventId
		public function getEvent($eventId)
		{
			try{
				$html = file_get_contents(sprintf(self::EVENTS_URL, $eventId), false, Stream::getContext());
			}catch(Exception $e){
				throw new Exceptions\Connection(self::CONNECTION_ERROR_MESSAGE);
			}

			$description = XPath::get($html, '//tr[@class="even"][1]/td');

			if(($description) && ($description->length === 1)){
				$players = array();
				$description = $description->item(0)->nodeValue;

				foreach($this->_playerDictionary as $player => $playerName){
					if(stripos($description, $player) !== false){
						$players[$playerName] = true;
					}
				}

				$players = array_keys($players);
				sort($players);

				return (object)array(
					'team' => $players,
					'eventId' => (int)$eventId
				);
			}

			return false;
		}

	}