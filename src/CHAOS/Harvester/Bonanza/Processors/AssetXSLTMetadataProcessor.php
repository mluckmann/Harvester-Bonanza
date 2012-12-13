<?php
namespace CHAOS\Harvester\Bonanza\Processors;

use CHAOS\Harvester\Processors\XSLTMetadataProcessor;

class AssetXSLTMetadataProcessor extends XSLTMetadataProcessor {
	
	const ACTORS_PATTERN = '/(?P<Name>.*?), ?(?P<Role>.*?); ?/';
	const COLOPHON_PATTERN = '/(?P<Role>.*?): ?(?P<Name>.*?)\. ?/';
	
	public static function xslt_contributors ($actors) {
		return XSLTMetadataProcessor::preg_explode_to_xml($actors, self::ACTORS_PATTERN, 'Contributor', 'Person', 'http://www.danskkulturarv.dk/DKA.xsd', true);
	}
	
	public static function xslt_creators ($colophon) {
		return XSLTMetadataProcessor::preg_explode_to_xml($colophon, self::COLOPHON_PATTERN, 'Creator', 'Person', 'http://www.danskkulturarv.dk/DKA.xsd', true);
	}
	
	public static function xslt_contributors_2 ($actors) {
		return XSLTMetadataProcessor::preg_explode_to_xml($actors, self::ACTORS_PATTERN, 'Contributors', 'Contributor', 'http://www.danskkulturarv.dk/DKA2.xsd', true);
	}
	
	public static function xslt_creators_2 ($colophon) {
		return XSLTMetadataProcessor::preg_explode_to_xml($colophon, self::COLOPHON_PATTERN, 'Creators', 'Creator', 'http://www.danskkulturarv.dk/DKA2.xsd', true);
	}
	
	public static function xslt_actors_for_description($actors) {
		$matches = array();
		if(strlen(trim($actors)) > 0 && preg_match_all(self::ACTORS_PATTERN, $actors, $matches) == 0) {
			return trim($actors);
		} else {
			return '';
		}
	}
	
	public static function xslt_colophon_for_description($colophon) {
		$matches = array();
		if(strlen(trim($colophon)) > 0 && preg_match_all(self::COLOPHON_PATTERN, $colophon, $matches) == 0) {
			return trim($colophon);
		} else {
			return '';
		}
	}
}