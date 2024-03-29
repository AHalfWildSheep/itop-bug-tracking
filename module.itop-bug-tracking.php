<?php
//
// iTop module definition file
//

use iTop\BugTracking\Utils;

SetupWebPage::AddModule(
	__FILE__, // Path to the current file, all other file names are relative to the directory containing this file
	'itop-bug-tracking/0.1.0',
	array(
		// Identification
		//
		'label' => 'Bug tracking',
		'category' => 'business',

		// Setup
		//
		'dependencies' => array(
			
		),
		'mandatory' => false,
		'visible' => true,

		// Components
		//
		'datamodel' => array(
			'model.itop-bug-tracking.php',
		),
		'webservice' => array(
			
		),
		'data.struct' => array(
			// add your 'structure' definition XML files here,
		),
		'data.sample' => array(
			// add your sample data XML files here,
		),
		
		// Documentation
		//
		'doc.manual_setup' => '', // hyperlink to manual setup documentation, if any
		'doc.more_information' => '', // hyperlink to more information, if any 

		// Default settings
		//
		'settings' => array(
			'duplicate_params' => array(
					'summary' => array('weight_factor' => 1),
					'description' => array('weight_factor' => 2),
				)
		),
	)
);


?>
