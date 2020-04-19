<?php

namespace iTop\BugTracking\Utils;
use CMDBSource;
class IndexUtils {
	/**
	 * Create indexes on specified columns
	 * @param $aColumns array Columns that will benefit from fulltext indexes
	 **/
	public static function CreateIndexes($sTable, $aColumns)
	{
		// For each columns in our table
		foreach ($aColumns as $sColumn)
		{
			// Check if our columns has already an index
			$sQuery = "SHOW INDEX FROM `$sTable` WHERE Key_name = '".$sTable.'_'.$sColumn."'";
			$aColumnIndex = CMDBSource::QueryToArray($sQuery);
			if (empty($aColumnIndex))
			{
				// We add a fulltext index to our columns
				$sQuery = "CREATE FULLTEXT INDEX ".$sTable.'_'.$sColumn." INDEX ON ".$sTable.'('.$sColumn.')';
				CMDBSource::Query($sQuery);
			}
		}
	}
}