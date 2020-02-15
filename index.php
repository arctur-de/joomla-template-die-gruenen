<?php
/** 
 *------------------------------------------------------------------------------
 * @copyright     Copyright (C) 2016-2020 arctur.de. All Rights Reserved.
 * @authors       Arctur Internet Consulting GbR
 * @Link:         http://www.arctur.de 
 *------------------------------------------------------------------------------
 */
 
// no direct access
defined('_JEXEC') or die;

//check if t3 plugin is existed
if (!defined('T3')) {
	if (JError::$legacy) {
		JError::setErrorHandling(E_ERROR, 'die');
		JError::raiseError(500, JText::_('T3_MISSING_T3_PLUGIN'));
		exit;
	} else {
		throw new Exception(JText::_('T3_MISSING_T3_PLUGIN'), 500);
	}
}

$t3app = T3::getApp($this);

// get configured layout
$layout = $t3app->getLayout();

$t3app->loadLayout($layout);