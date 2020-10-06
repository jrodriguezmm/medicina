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

<?php if ($icontype == 'socialIco'): ?>
  <div class="ial-socials ial-col<?php $i = 0; echo $count = count($oauth_list) ?>">
    <?php foreach($oauth_list as $oauth): ?>
    <div class="socialIco-wrapper">
      <div class="socialIco" data-oauth="<?php echo $oauth->alias ?>" title="<?php echo JText::_("IAL_LOGIN_WITH_".strtoupper($oauth->alias)) ?>">
        <svg><use xlink:href="<?php echo '#svg-'.$oauth->alias ?>"/></svg>
      </div>
    </div>
    <?php if (($count > 4 ? 3 : 2) == ++$i && $count > 3): ?><br><?php endif ?>
    <?php endforeach ?>
  </div>
<?php else: ?>
  <div class="ial-socials ial-oauths">
    <?php foreach($oauth_list as $oauth): ?>
    <div class="socialIco-wrapper">
      <div class="socialIco" data-oauth="<?php echo $oauth->alias?>">
        <svg class="btnIco"><use xlink:href="<?php echo '#svg-'.$oauth->alias ?>"/></svg><?php echo JText::_("IAL_LOGIN_WITH_".strtoupper($oauth->alias)) ?>
      </div>
    </div>
    <?php endforeach ?>
  </div>
<?php endif ?>
