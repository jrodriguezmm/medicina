<?php
/**
 * @package	AcyMailing for Joomla
 * @version	6.3.1
 * @author	acyba.com
 * @copyright	(C) 2009-2019 ACYBA S.A.R.L. All rights reserved.
 * @license	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('_JEXEC') or die('Restricted access');
?><?php

class plgSystemJceacym extends JPlugin
{
    public function onBeforeWfEditorRender(&$settings)
    {
        if (empty($_REQUEST['option']) || $_REQUEST['option'] != 'com_acym') {
            return;
        }

        if (!empty($_REQUEST['acycssfile'])) {
            $settings['content_css'] = $_REQUEST['acycssfile'];
        }
    }
}

