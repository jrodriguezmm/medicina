<?php
/**
 * @package     POWr Icon
 * @subpackage  plg_powricon
 *
 * @copyright   Copyright (C) 2016 POWr Inc. All rights reserved.
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

defined( '_JEXEC' ) or die( 'Restricted access' );
//Seto active on install
class PlgEditorsXtdPowriconInstallerScript
{
 public function install($parent)
 {
  trigger_error('IN INSTALL 3');
  // Enable plugin
  $db  = JFactory::getDbo();
  $query = $db->getQuery(true);
  $query->update('#__extensions');
  $query->set($db->quoteName('enabled') . ' = 1');
  $query->where($db->quoteName('element') . ' = ' . $db->quote('powricon'));
  $query->where($db->quoteName('type') . ' = ' . $db->quote('plugin'));
  $db->setQuery($query);
  $db->execute();
 }
}
?>
