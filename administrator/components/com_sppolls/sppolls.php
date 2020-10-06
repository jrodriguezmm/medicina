<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_sppolls
 *
 * @license     MIT
 */
defined('_JEXEC') or die;
if(file_exists(JPATH_COMPONENT.'/vendor/autoload.php')){
  include JPATH_COMPONENT.'/vendor/autoload.php';
}

if(!JFactory::getUser()->authorise('core.manage','com_sppolls')){
  return JError::raiseWarning(404,JText::_('JERROR_ALERTNOAUTHOR'));
}
if(file_exists(JPATH_COMPONENT.'/helpers/sppolls.php')){
  JLoader::register('SppollsHelper', JPATH_COMPONENT . '/helpers/sppolls.php');
}

// Execute the task.
$controller=JControllerLegacy::getInstance('Sppolls');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
