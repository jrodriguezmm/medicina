<?php
/**
 * @package     POWr Shortcodes
 * @subpackage  plg_powrshortcodes
 *
 * @copyright   Copyright (C) 2014 - 2015 POWr Inc. All rights reserved.
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

defined( '_JEXEC' ) or die( 'Restricted access' );
//Set to active on install
class PlgContentPowrshortcodesInstallerScript
{
 public function install($parent)
 {
  trigger_error('IN INSTALL 2');
  // Enable plugin
  $db  = JFactory::getDbo();
  $query = $db->getQuery(true);
  $query->update('#__extensions');
  $query->set($db->quoteName('enabled') . ' = 1');
  $query->where($db->quoteName('element') . ' = ' . $db->quote('powrshortcodes'));
  $query->where($db->quoteName('type') . ' = ' . $db->quote('plugin'));
  $db->setQuery($query);
  $db->execute();
 }
}
?>