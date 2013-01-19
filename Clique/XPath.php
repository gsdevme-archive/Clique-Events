<?php

	namespace Clique;

	use DOMDocument;
	use DOMXPath;

	class XPath
	{

		//	Quick helper for XPATH
		public static function get($html, $query)
		{
			try{
				$dom = new DOMDocument();
				$dom->loadHTML($html);

				$xpath = new DOMXPath($dom);
				return $xpath->query($query);
			}catch(Exception $e){

			}

			return null;
		}
	}