<?php

class BugTrackingPlugin implements iApplicationUIExtension
{
	public function OnDisplayProperties($oObject, WebPage $oPage, $bEditMode = false)
	{
		if (get_class($oObject) === 'AHWSIssue')
		{
			$iMilestone = $oObject->Get('milestone_id');
			if (!is_int($iMilestone)) {
				return;
			}

			$oMilestone = MetaModel::GetObject('AHWSMilestone', $iMilestone, false);
			if ($oMilestone === null) {
				return;
			}

			$oStartDate = $oMilestone->Get('start_date');
			$oDueDate = $oMilestone->Get('due_date');

			$oDateFormat = AttributeDate::GetFormat();
			$oCurrentDate = date($oDateFormat);

			if ($oStartDate !== null && $oDueDate !== null && $oStartDate <= $oCurrentDate && $oDueDate >= $oCurrentDate)
			{
				$sTagLabel = Dict::S('BugTracking:AHWSIssue:Tag:Label');
				$oPage->add_ready_script(
					<<<JS
$('.ibo-object-details .ibo-panel--subtitle:first').append('<span class="ibo-object-details--tag ahws-object-details--tag--active-milestone"><span class="ibo-object-details--tag-icon"><span class="fas fa-flag"></span></span>$sTagLabel</span>');
JS
				);
			}
		}
	}

	public function OnDisplayRelations($oObject, WebPage $oPage, $bEditMode = false)
	{
	}

	public function OnFormSubmit($oObject, $sFormPrefix = '')
	{
	}

	public function OnFormCancel($sTempId)
	{
	}

	public function EnumUsedAttributes($oObject)
	{
		return array();
	}

	public function GetIcon($oObject)
	{
		return '';
	}

	public function GetHilightClass($oObject)
	{
		// Possible return values are:
		// HILIGHT_CLASS_CRITICAL, HILIGHT_CLASS_WARNING, HILIGHT_CLASS_OK, HILIGHT_CLASS_NONE
		return HILIGHT_CLASS_NONE;
	}

	public function EnumAllowedActions(DBObjectSet $oSet)
	{
		// No action
		return array();
	}
}