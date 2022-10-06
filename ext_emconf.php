<?php

########################################################################
# Extension Manager/Repository config file for ext: "patchem"
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Patches for the Extension Manager',
	'description' => 'Collection of patches for the Extension Manager',
	'category' => 'be',
	'author' => 'Franz Holzinger',
	'author_email' => 'franz@ttproducts.de',
	'shy' => '',
	'dependencies' => 'em',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'obsolete',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author_company' => '',
	'version' => '0.1.3',
	'constraints' => array(
		'depends' => array(
            'php' => '5.4.0-7.99.99',
			'typo3' => '6.2.0-8.99.99',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
);

