<?php
/*-------------------------------------------------------------------------
# mod_improved_ajax_login - Improved AJAX Login and Register
# -------------------------------------------------------------------------
# @ author    Balint Polgarfi
# @ copyright Copyright (c) 2012-2019 Offlajn.com  All Rights Reserved.
# @ license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# @ website   http://www.offlajn.com
-------------------------------------------------------------------------*/
?><?php
defined('_JEXEC') or die('Restricted access'); ?>
<div id="<?php echo $module->instanceid ?>" class="<?php echo $params->get('moduleclass_sfx') ?>">

<?php if ($guest): // LOGIN ?>
  <?php if (@$module->view != 'reg'): ?>
    <?php $logTmpl = $myp[0] == 'community' ? '/cbLog25.php' : '/log25.php' ?>
    <?php if ($loginpopup): ?>
      <a class="logBtn selectBtn" onclick="return false" href="<?php echo JRoute::_('index.php?option=com_users&view=login') ?>">
        <?php if (!$params->get('wndcenter', 0)): ?>
      		<span class="loginBtn leftBtn">
      			<?php echo JText::_('JLOGIN') ?>
      		</span><span class="loginBtn rightBtn">&nbsp;<img src="<?php echo JURI::root()."modules/{$module->module}/themes/elegant/images/arrow.png" ?>" alt="\/" width="10" height="7"/>&nbsp;</span>
        <?php else: ?>
          <span class="loginBtn"><?php echo JText::_('JLOGIN') ?></span>
        <?php endif ?>
      </a>
    	<div class="ial-window">
        <div class="loginWndInside">
          <div class="ial-arrow-up">
            <div style="position:relative">
    					<div class="upArrowOutside"></div>
    					<div class="upArrowInside"></div>
            </div>
    			</div>
    			<span class="ial-close loginBtn"><img src="<?php echo JURI::root()."modules/{$module->module}/themes/elegant/images/x.png" ?>" alt="x" width="8" height="10"/></span>
          <?php if ($loginpopup) require dirname(__FILE__).$logTmpl // LOGIN FORM ?>
        </div>
    	</div>
    <?php else: ?>
      <?php require dirname(__FILE__).$logTmpl // LOGIN FORM ?>
      <?php if ($regpopup): ?><div class="loginBrd"></div><?php endif ?>
    <?php endif ?>
    <?php if ($params->get('forgotpass', 1)): ?>
    <a class="resetBtn selectBtn" style="display:none"></a>
    <div class="ial-window">
      <div class="loginWndInside">
  		<span class="ial-close loginBtn"><img src="<?php echo JURI::root()."modules/{$module->module}/themes/elegant/images/x.png" ?>" alt="x" width="8" height="10"/></span>
        <?php require dirname(__FILE__)."/reset25.php"; // RESET FORM ?>
      </div>
    </div>
    <?php endif ?>
    <?php if ($params->get('forgotname', 0)): ?>
    <a class="remindBtn selectBtn" style="display:none"></a>
    <div class="ial-window">
      <div class="loginWndInside">
  		<span class="ial-close loginBtn"><img src="<?php echo JURI::root()."modules/{$module->module}/themes/elegant/images/x.png" ?>" alt="x" width="8" height="10"/></span>
        <?php require dirname(__FILE__)."/remind25.php"; // REMIND FORM ?>
      </div>
    </div>
    <?php endif ?>
  <?php endif ?>

	<?php if ($allowUserRegistration): // REGISTRATION ?>
    <?php if (@$module->view == 'reg' || !$regpopup): ?>
      <div class="loginInside">
        <?php require dirname(__FILE__).'/reg25.php' // REGISTRATION FORM ?>
      </div>
    <?php elseif ($allowReg != 'hide'): ?>
  	  <a class="regBtn selectBtn <?php if (!$loginpopup) echo 'fullWidth' ?>" href="<?php echo $regpage ?>">
      <?php if (!$regredirect && !$params->get('wndcenter', 0)): ?>
    		<span class="loginBtn leftBtn">
    			<?php echo JText::_('JREGISTER') ?>
    		</span><span class="loginBtn rightBtn">&nbsp;<img src="<?php echo JURI::root()."modules/{$module->module}/themes/elegant/images/arrow.png" ?>" alt="\/" width="10" height="7"/>&nbsp;</span>
      <?php else: ?>
        <span class="loginBtn"><?php echo JText::_(@$module->view == 'log' || !$loginpopup? 'MOD_LOGIN_REGISTER':'JREGISTER') ?></span>
      <?php endif ?>
  		</a>
    <?php endif ?>
  <?php endif ?>


	<div class="ial-window">
    <div class="loginWndInside">
      <div class="ial-arrow-up">
        <div style="position:relative">
					<div class="upArrowOutside"></div>
					<div class="upArrowInside"></div>
        </div>
			</div>
			<span class="ial-close loginBtn"><img src="<?php echo JURI::root()."modules/{$module->module}/themes/elegant/images/x.png" ?>" alt="x" width="8" height="10"/></span>
      <?php if ($allowUserRegistration && @$module->view != 'reg' && (!$regredirect || isset(${'_SESSION'}['oauth']['twitter'])) && $regpopup) require dirname(__FILE__).'/reg25.php' // REGISTER FORM ?>
    </div>
	</div>

<?php else: // LOGOUT ?>
  <a class="userBtn selectBtn" onclick="return false" href="<?php echo $mypage ?>">
	  <span class="loginBtn leftBtn">
			<?php echo $params->get('name')? $user->get('name') : $user->get('username')?>
		</span><span class="loginBtn rightBtn">&nbsp;<img src="<?php echo JURI::root()."modules/{$module->module}/themes/elegant/images/arrow.png" ?>" alt="\/" width="10" height="7"/>&nbsp;</span>
	</a>
	<div class="ial-usermenu">
    <div class="loginWndInside">
      <div class="ial-arrow-up">
        <div style="position:relative">
					<div class="upArrowOutside"></div>
					<div class="upArrowInside"></div>
        </div>
			</div>
			<div class="loginLst">
        <?php if($params->get('profile', 1)):?>
				<a class="settings" href="<?php echo $mypage ?>"><?php echo JText::_('COM_USERS_PROFILE_MY_PROFILE') ?></a>
        <?php endif ?>
				<?php if ($mycart): ?>
				<a class="cart" href="<?php echo JRoute::_($mycartURL) ?>" ><?php echo $mycart ?></a>
				<?php endif ?>
				<?php if ($usermenu): ?>
					<?php foreach ($menulist as $mi): ?>
            <?php
            $linkAttrs = 'class="mitem"';
            if($mi->params->get('menu_image')) $linkAttrs = 'class="mitem customicon" style="background-image: url('.$mi->params->get("menu_image").');"';
            ?>
            <a <?php echo $linkAttrs; ?> target="<?php echo ($mi->browserNav) ?  "_blank" :  ""; ?>" href="<?php echo JRoute::_($mi->flink) ?>" ><?php echo $mi->title ?></a>
					<?php endforeach ?>
        <?php endif ?>
				<a class="logout" href="javascript:;" ><?php echo JText::_('JLOGOUT') ?></a>
			</div>
    </div>
  	<form action="<?php echo JRoute::_('index.php?option=com_users&task=user.logout') ?>" method="post" name="ialLogout" class="ial-logout hidden">
      <input type="hidden" value="com_users" name="option" />
      <input type="hidden" value="user.logout" name="task" />
  		<input type="hidden" name="return" value="<?php echo $return ?>" />
    	<?php echo JHtml::_('form.token') ?>
  	</form>
	</div>
<?php endif ?>
</div>