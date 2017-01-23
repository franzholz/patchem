<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\\CMS\\Extensionmanager\\Domain\\Repository\\ConfigurationItemRepository'] = array(
	'className' => 'Bugfix\\Patchem\\Domain\\Repository\\ConfigurationItemRepository'
);


