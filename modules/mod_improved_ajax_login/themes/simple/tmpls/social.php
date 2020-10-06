<?php
/*-------------------------------------------------------------------------
# mod_improved_ajax_login - Improved AJAX Login and Register
# -------------------------------------------------------------------------
# @ author    Balint Polgarfi
# @ copyright Copyright (c) 2012-2019 Offlajn.com  All Rights Reserved.
# @ license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# @ website   http://www.offlajn.com
-------------------------------------------------------------------------*/
?><?php defined('_JEXEC') or die('Restricted access'); ?>

<div class="ial-socials ial-col<?php echo $count = count($oauth_list) ?>">
<?php foreach($oauth_list as $oauth): ?>
  <?php if ($count > 1): // ICON ?>
  <div class="socialIco" data-oauth="<?php echo $oauth->alias ?>" title="<?php echo JText::_("IAL_LOGIN_WITH_".strtoupper($oauth->alias)) ?>"></div>
  <?php else: // BUTTON ?>
  <div class="socialIco" data-oauth="<?php echo $oauth->alias ?>"><i></i> <span><?php echo JText::_("IAL_LOGIN_WITH_".strtoupper($oauth->alias)) ?></span></div>
  <?php endif ?>
<?php endforeach ?>
  <br style="clear:both" />
</div>