<?php

	namespace Clique;

	use stdClass;

	class TweetFormat
	{

		const LIMIT = 140;

		public static function parse(stdClass $event)
		{
			$hashtags = ' #clique';
			$string = $event->raid . ', ' . $event->when->format('F j, Y, g:i a') . ' GMT+' . ($event->when->getOffset() / 3600);
			$team = (($event->team !== null) ? ' | Team:' . implode(', ', (array)$event->team) : ' | Team:Unknown');

			// Gav: Can we tweet with the team?
			if(strlen($team) + strlen($string) <= self::LIMIT){
				$string .= $team;

				if(strlen($string) + strlen($hashtags) <= 140){
					$string .= $hashtags;
				}
			}

			return substr($string, 0, 140);
		}
	}