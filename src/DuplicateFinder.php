<?php


namespace iTop\BugTracking\Duplicate;
use CMDBSource;

class DuplicateFinder
{
	public static function getDuplicateBugs($aValues)
	{
		if(!empty($aValues))
		{
			$sQuery = "SELECT id FROM bug WHERE";
			$sFirst = true;
			foreach ($aValues as $sKey => $sValue)
			{
				$sValue = CMDBSource::GetMysqli()->real_escape_string(strip_tags($sValue));
				$sQuery .= ($sFirst ? ' ' : ' OR ') . "MATCH ( ".$sKey." )  AGAINST ('".$sValue."' IN NATURAL LANGUAGE MODE)";
				$sFirst = false;
			}
			$aRes = \CMDBSource::QueryToArray($sQuery);
		}
		return $aRes;
	}
}