<?php
/*-------------------------------------------------------------------------
# mod_vertical_menu - Vertical Menu
# -------------------------------------------------------------------------
# @ author    Balint Polgarfi
# @ copyright Copyright (C) 2015 Offlajn.com  All Rights Reserved.
# @ license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# @ website   http://www.offlajn.com
-------------------------------------------------------------------------*/
?><?php
defined('_JEXEC') or die('Restricted access');

class JElementOfflajnMiniColor extends JOfflajnFakeElementBase
{
  var $_moduleName = '';

	var	$_name = 'OfflajnMiniColor';

	function universalfetchElement($name, $value, &$node){
  	$this->loadFiles();
    $value = htmlspecialchars(html_entity_decode($value, ENT_QUOTES), ENT_QUOTES);
    $id = $this->generateId($name);

    $alpha = $node->attributes('alpha') == 1 ? true : false;
		$position = $node->attributes('position') ? $node->attributes('position') : 'bottom left';

		if ($alpha) {
			if (preg_match('/^(\w\w)(\w\w)(\w\w)(\w\w)$/', $value, $m))
				$value = sprintf('rgba(%d, %d, %d, %.2f)', hexdec($m[1]), hexdec($m[2]), hexdec($m[3]), hexdec($m[4])/255);
			elseif (preg_match('/^\w{6}$/', $value, $m))
				$value = '#'.$value;
		} elseif ($value[0] != '#') $value = '#'.$value;

    $url='';
    if(defined('WP_ADMIN')){
      $url = smartslider_url('joomla/');
    }else{
      $url = JURI::root(true);
    }
    DojoLoader::addScript('jQuery("#'.$id.'").minicolors({opacity: '.($alpha ? 'true' : 'false').', position: "'.$position.'"});');
		return '<div class="offlajnminicolor"><input type="text" name="'.$name.'" id="'.$id.'" value="'.$value.'" class="color" /></div>';
	}

}

if(version_compare(JVERSION,'1.6.0','ge')) {
  class JFormFieldOfflajnMiniColor extends JElementOfflajnMiniColor {}
}