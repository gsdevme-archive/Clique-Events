<?php

	namespace Clique;

	//	Static Class for Stream Context
	class Stream
	{
		const HEADER_LINE_FEED = "\r\n";
		const HEADER_USER_AGENT = 'Mozilla/5.0 Event Polling BOT';
		const STREAM_METHOD_DEFAULT = 'GET';

		private static $_steam;

		//	Returns a stream context resource
		public static function getContext($method = null)
		{
			if(!is_resource(self::$_steam)){
				if($method === null){
					$method = self::STREAM_METHOD_DEFAULT;
				}

				self::$_steam = stream_context_create(array(
					'http' => array(
						'method' => self::STREAM_METHOD_DEFAULT,
						'header' =>
							'Accept-language: en' . self::HEADER_LINE_FEED .
							'User-Agent: ' . self::HEADER_USER_AGENT . self::HEADER_LINE_FEED,
						'max_redirects' => 1,
						'follow_location' => 0,
						'timeout' => 10
					)
				));
			}

			return self::$_steam;
		}
	}