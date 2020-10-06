<?php
/*------------------------------------------------------------------------
# com_improved_ajax_login - Improved AJAX Login & Register
# ------------------------------------------------------------------------
# author    Balint Polgarfi
# copyright Copyright (c) 2012-2019 Offlajn.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.offlajn.com
-------------------------------------------------------------------------*/
$revision = '2.6.308';
$revision = '2.7.308';
?>
<?php
defined('_JEXEC') or die( 'Restricted access' );

  $task = JRequest::getCmd('task');
  if ($task == 'login' || $task == 'register') return;

  $mainframe = JFactory::getApplication();
  $db = JFactory::getDBO();
  $v15 = version_compare(JVERSION,'1.6.0','lt');
  $v30 = version_compare(JVERSION,'3.0.0','ge');

  require JPATH_SITE.'/plugins/system/improved_ajax_login/oauth.php';
