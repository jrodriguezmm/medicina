<?php
/*-------------------------------------------------------------------------
# mod_improved_ajax_login - Improved AJAX Login and Register
# -------------------------------------------------------------------------
# @ author    Balint Polgarfi
# @ copyright Copyright (c) 2012-2019 Offlajn.com  All Rights Reserved.
# @ license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# @ website   http://www.offlajn.com
-------------------------------------------------------------------------*/
$revision = '2.6.308';
$revision = '2.7.308';
?><?php
defined('_JEXEC') or die('Restricted access');

if (defined('mod_improved_ajax_login')) return;
else define('mod_improved_ajax_login', 1);

$er = error_reporting();
if ($er & E_STRICT || $er & E_DEPRECATED)
  error_reporting($er & ~E_STRICT & ~E_DEPRECATED);

if (!extension_loaded('gd') || !function_exists('gd_info')) {
  echo "{$module->name} needs the <a href='http://php.net/manual/en/book.image.php'>GD module</a> enabled
	in your PHP runtime environment. Please consult with your System Administrator and he will enable it!";
  return;
}

require_once(dirname(__FILE__).'/helpers/functions.php');


$db = JFactory::getDBO();
$lang = JFactory::getLanguage();
$lang->load('com_media', JPATH_ADMINISTRATOR);
$module->instanceid = $module->module.'-'.$module->id;
$root = rtrim(JUri::root(true), '/').'/';
$maxfilesize = ini_get('upload_max_filesize');
$maxfilesize = str_replace(array('M', 'k'), array('*1024*1024', '*1024'), $maxfilesize);

// init params
if ($params->get('moduleclass_sfx', '') != @$params->get('advancedTab')->moduleclass_sfx) {
  $params->set('moduleclass_sfx', $params->get('advancedTab')->moduleclass_sfx);
  $db->setQuery("UPDATE `#__modules` SET params = '".addslashes($params->toString())."' WHERE id = {$module->id} LIMIT 1");
  $db->query();
}
require_once(dirname(__FILE__).'/params/offlajndashboard/library/flatArray.php');
$params->loadArray(offflat_array($params->toArray()));

// For demo parameter editor
if(defined('DEMO')){
  ${'_SESSION'}['module_id'] = $module->id;
  if(!isset(${'_SESSION'}[$module->module.'a'][$module->id])){
    ${'_SESSION'}[$module->module.'a'] = array();
    $a = $params->toArray();
    $a['params'] = $a;
    $params->loadArray($a);
    ${'_SESSION'}[$module->module."_orig"] = $params->toString();
    ${'_SESSION'}[$module->module.'a'][$module->id] = true;
    ${'_SESSION'}[$module->module."_params"] = $params->toString();
    header('LOCATION: '.$_SERVER['REQUEST_URI']);
  }
  if(isset(${'_SESSION'}[$module->module."_params"])){
    $params = new JRegistry();
    $params->loadJSON(${'_SESSION'}[$module->module."_params"]);
  }
  $a = $params->toArray();
  $params->loadArray(o_flat_array($a['params']));
  $themesdir = JPATH_SITE.'/modules/'.$module->module.'/themes/';
  $xmlFile = $themesdir.$params->get('theme', 'elegant').'/theme.xml';
  $xml = new SimpleXMLElement(file_get_contents($xmlFile));
  $skins = $xml->params[0]->param[0];
  $sks = array();
  foreach($skins->children() AS $skin){
    $sks[] = $skin->getName();
  }
  DojoLoader::addScript('window.skin = new Skinchanger({theme: "'.$params->get('theme', 'elegant').'",skins: '.json_encode($sks).'});');
  if(isset($_REQUEST['skin']) && $skins->{$_REQUEST['skin']}){
    $skin = $skins->{$_REQUEST['skin']}[0];
    foreach($skin AS $s){
      $name = $s->getName();
      $value = (string)$s;
      $params->set($name, $value);
    }
    ${'_SESSION'}[$module->module."_params"] = $params->toString();
  }
}

// init popups
if (isset($module->view)) $loginpopup = $params->set('loginpopup', $module->view == 'reg');
else $loginpopup = $params->get('loginpopup', 1) > 0;
if (!$loginpopup || isset($module->view)) $params->set('wndcenter', 1);
$regpopup = intval($params->get('registerpopup', 1) > 0 || @$module->view == 'log');
$socialpos = $params->get('socialpos','bottom');

$theme = $params->get('theme', 'elegant');
${'_SESSION'}['ologin'] = array();

// init oauth
$oauths = '{}';
if ($params->get('social', 1)) {
  $db->setQuery('SELECT name, alias, app_id, app_secret, auth, token, userinfo FROM `#__offlajn_oauths` WHERE published = 1');
  $oauth_list = $db->loadObjectList('alias');
  if ($oauth_list) {
    $oauths = array();
    $domain = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' || $_SERVER['SERVER_PORT'] == 443 ? 'https://' : 'http://').$_SERVER['SERVER_NAME'];
    $redirect = urlencode($domain.$root.'index.php?option=com_improved_ajax_login&task=');
    foreach ($oauth_list as $alias => $oauth) {
      $oauths[$alias] = $oauth->auth?
        "{$oauth->auth}&client_id={$oauth->app_id}&redirect_uri=$redirect{$oauth->alias}" :
        JURI::root().'index.php?option=com_improved_ajax_login&redirect=1&task='.$oauth->alias;
    }
    $oauths = json_encode($oauths);
  }
}

// Load image helper
require_once(dirname(__FILE__).'/classes/ImageHelper.php');

// Build the CSS
require_once(dirname(__FILE__).'/classes/cache.class.php');
$cache = new OfflajnMenuThemeCache('default', $module, $params);
$cache->addCss(dirname(__FILE__).'/themes/clear.css.php');
$cache->addCss(dirname(__FILE__)."/themes/$theme/theme.css.php");
$cache->assetsAdded();

// Set up enviroment variables for the cache generation
$module->url = "{$root}modules/{$module->module}/";
$cache->addCssEnvVars('module', $module);
$themeurl = "{$module->url}themes/$theme/";
$oh7 = new OfflajnHelper7($cache->cachePath, $cache->cacheUrl);
$cache->addCssEnvVars('themeurl', $themeurl);
$cache->addCssEnvVars('helper', $oh7);

// Add cached contents to the document
$cacheFiles = $cache->generateCache();
$document = JFactory::getDocument();
$document->addCustomTag('<link rel="stylesheet" href="'.$cacheFiles[0].'" type="text/css" />');

// get usermenu or redirection link
$userParams = JComponentHelper::getParams('com_users');
$allowUserRegistration = $userParams->get('allowUserRegistration');

$updateUsersConfig = 0;
$allowReg = $params->get('registration', 'def');
if ($allowReg == 'hide' && @$module->view == 'reg') $allowReg = 1;

if ($allowReg != 'def') {
  if ($allowReg == 'hide') $allowUserRegistration = 0;
  elseif ($allowUserRegistration != $allowReg) {
    $allowUserRegistration = $allowReg;
    $userParams->set('allowUserRegistration', $allowReg);
    $updateUsersConfig = 1;
  }
}
$regp = explode('|*|', $params->get('regpage', 'joomla|*|'));
// redirect when no form manager support
$regredirect = in_array($regp[0], array('community', 'easysocial', 'custom'));
if ($regp[0] == 'community') { // CB fix
  $allowUserRegistration = 1;
  if ($allowUserRegistration != '0') {
    $userParams->set('allowUserRegistration', '0');
    $updateUsersConfig = 1;
  }
}

$user = JFactory::getUser();
$guest = $user->get('guest', 0);
// init captcha
$reCaptcha = '';
$reCaptchaVer = '';
if (
  $guest &&
  ($regp[0] == 'joomla' || $params->get('forgotpass', 1) || $params->get('forgotname', 0)) &&
  ($plgCaptcha = JPluginHelper::getPlugin('captcha', 'recaptcha'))
) {
  $captcha = is_string($plgCaptcha->params) ? new JRegistry($plgCaptcha->params) : $plgCaptcha->params;
  $reCaptcha = !$captcha->get('public_key', '') || !$captcha->get('private_key', '') ? 'empty' : $captcha->get('public_key');
  $reCaptchaVer = $captcha->get('version', '2.0');

  if ($reCaptcha && $userParams->get('captcha') != 'recaptcha' || !$reCaptcha && $userParams->get('captcha') != '0') {
    $userParams->set('captcha', $reCaptcha? 'recaptcha' : '0');
    $updateUsersConfig = 1;
  }
}

if ($regp[0] == 'joomla') {
  // init send mail (disable notification to administrators at com_users)
  $sendmail = $params->get('sendmail', 'extended');
  if ($userParams->get('mail_to_admin') != $sendmail) {
    $userParams->set('mail_to_admin', $sendmail);
    $updateUsersConfig = 1;
  }
}

if ($updateUsersConfig) {
  $db->setQuery("UPDATE `#__extensions` SET params = '".addslashes($userParams->toString())."' WHERE element = 'com_users'");
  $db->query();
}

$return = JRequest::getVar('return', '');
if ($return) { // fix for redirect to private area on J!348
  $url = call_user_func('base'.'64_decode', $return);
  if (stripos($url, 'http') !== 0) {
    $url = JFactory::getURI()->toString(array('scheme', 'host', 'port')) .'/'. ltrim($url, '/');
    $return = call_user_func('base'.'64_encode', $url);
  }
} else {
  $itemid = $params->get($guest? 'login' : 'logout');
  if ($itemid) {
    if (version_compare(JVERSION, '3.4.6','ge')) {
      $url = "index.php?Itemid=".$itemid;
    } else {
      $item = JFactory::getApplication()->getMenu()->getItem($itemid);
      if ($item) $url = JRoute::_($item->link.(strpos($item->link, '?') ? '&' : '?') .'Itemid='. $itemid, false);
      // stay on the same page
      else $url = JFactory::getURI()->toString(array('scheme', 'host', 'port', 'path', 'query', 'fragment'));
    } // stay on the same page
  } else $url = JFactory::getURI()->toString(array('scheme', 'host', 'port', 'path', 'query', 'fragment'));
  $return = call_user_func('base'.'64_encode', $url);
}

// init profil links
$myp = explode('|*|', $params->get('mypage', 'joomla|*|'));
$mypages = array(
  'joomla' => 'index.php?option=com_users&view=profile&layout=edit',
  'virtuemart' => 'index.php?option=com_virtuemart&view=user',
  'hikashop' => 'index.php?option=com_hikashop&view=user&layout=cpanel',
  'community' => 'index.php?option=com_comprofiler',
  'jomsocial' => 'index.php?option=com_community&view=profile',
  'easysocial' => 'index.php?option=com_easysocial&view=profile&layout=edit',
  'k2' => 'index.php?option=com_users&view=profile&layout=edit',
  'custom' => isset($myp[1]) ? $myp[1] : ''
);
$mypage = JRoute::_($mypages[$myp[0]]);
// init registration links
if ($guest) {
  $regpages = array(
    'joomla' => 'index.php?option=com_users&view=registration',
    'virtuemart' => 'index.php?option=com_virtuemart&view=user',
    'hikashop' => 'index.php?option=com_hikashop&view=user&layout=form',
    'community' => 'index.php?option=com_comprofiler&task=registers',
    'jomsocial' => 'index.php?option=com_community&view=register&task=register',
    'easysocial' => 'index.php?option=com_easysocial&view=registration',
    'k2' => 'index.php?option=com_users&view=registration',
    'custom' => isset($regp[1]) ? $regp[1] : ''
  );
  $regpage = JRoute::_($regpages[$regp[0]]);
  if (!$params->get('socialregauto', 1) && $regp[0] == 'joomla') ${'_SESSION'}['ologin']['regpage'] = $regp[0];
  else ${'_SESSION'}['ologin']['regpage'] = 'auto';
} else {
  // Show cart
  if ($params->get('showcart', 1)
  &&  file_exists(JPATH_SITE.'/components/com_virtuemart/router.php')) {
    $lang->load('com_virtuemart');
    $mycart = JText::_('COM_VIRTUEMART_CART_SHOW');
    $mycartURL = 'index.php?option=com_virtuemart&view=cart';
  } else $mycart = 0;
}

// init language
$username = JText::_('JGLOBAL_USERNAME');
$password = JText::_('JGLOBAL_PASSWORD');
$email = JText::_('JGLOBAL_EMAIL');

$usernamemail = $username.' / '.$email;
if ($auth = $params->get('username', 1))
  if ($auth == 2) $auth = $usernamemail;
  else $auth = $username;
else $auth = $email;
$icontype = $params->get('icontype', 'socialIco');

// Add scripts
if (version_compare(JVERSION, '3.0.0', 'l')) {
  if ($params->get('jquery', 1)) {
    $document->addScript('https://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js');
    $document->addScript($root.'media/offlajn/jquery.noconflict.js');
  }
} else {
  JHtml::_('jquery.framework');
}

$windowAnim = explode('|*|', $params->get('popupcomb'));
$windowAnim = @$windowAnim[4];
/*GENERATE RANDOM*/
if ($windowAnim == "0"){
  $anims = array(1, 2, 4, 5, 6, 8, 9, 11, 13, 14, 15, 17, 18, 19, 20);
  $rand_key = array_rand($anims, 1);
  $windowAnim=$anims[$rand_key];
}

$instance = "
document[(_el=document.addEventListener)?'addEventListener':'attachEvent'](_el?'DOMContentLoaded':'onreadystatechange',function(){
  if (!_el && document.readyState != 'complete') return;
  new ImprovedAJAXLogin({
    id: {$module->id},
    isGuest: $guest,
    oauth: $oauths,
    bgOpacity: ".(int)$params->get('blackoutcomb', 40)."/100,
    returnUrl: '$url',
    border: parseInt('{$params->get('popupcomb', '|*|3')}'.split('|*|')[1]),
    padding: ".(int)$params->get('buttoncomb', 3).",
    useAJAX: {$params->get('ajax', 0)},
    openEvent: '{$params->get('openevent', 'onclick')}',
    wndCenter: {$params->get('wndcenter', 1)},
    regPopup: $regpopup,
    dur: 300,
    timeout: 0,
    base: '$root',
    theme: '$theme',
    socialProfile: '".($params->get('socialprofil', 0)? $mypage : '')."',
    socialType: '$icontype',
    cssPath: '{$cacheFiles[0]}',
    regPage: '{$regp[0]}',
    captcha: '{$reCaptcha}',
    captchaVer: '{$reCaptchaVer}',
    showHint: {$params->get('showhint', 0)},
    geolocation: ".($params->get('geolocation', 1) > 0 && $regp[0] == 'joomla'? 'true':'false').",
    windowAnim: '$windowAnim',
    maxfilesize: $maxfilesize
  });
});\n";

$custom_js = !$params->get('custom_js') ? '' : "
document[(_el=document.addEventListener)?'addEventListener':'attachEvent'](_el?'DOMContentLoaded':'onreadystatechange',function(){
  if (!_el && document.readyState != 'complete') return;
  var $ = window.jq183||jQuery;
  {$params->get('custom_js')}
});\n";

if ($reCaptchaVer == "2.0" && $guest) {
	$file = 'https://www.google.com/recaptcha/api.js?render=explicit&hl=' . JFactory::getLanguage()->getTag();
	JHtml::_('script', $file);
}
$ignoreJS = $params->get('ignorejs', 1) ? ' data-cfasync="false"' : '';
$v = $params->get('nocache', 0) || !isset($revision) ? '_='.time() : 'v='.$revision;
$document->addScript("{$root}modules/{$module->module}/script/improved_ajax_login.js?$v");
$document->addScript($themeurl.'theme.js?'.$v);
$document->addCustomTag("<script$ignoreJS>$instance</script>");
if ($custom_js) $document->addCustomTag("<script$ignoreJS>$custom_js</script>");
$custom_css = $params->get('custom_css', '');
if ($custom_css) $document->addStyleDeclaration($custom_css);

// check two factor authentication
require_once JPATH_ADMINISTRATOR . '/components/com_users/helpers/users.php';
$twofactormethods = method_exists('UsersHelper', 'getTwoFactorMethods') ? UsersHelper::getTwoFactorMethods() : array();

// init user menu
if (!$guest && ($usermenu = $params->get('usermenu', 0))) {
  require_once JPATH_SITE.'/modules/mod_menu/helper.php';
  $menuparams = new JObject(array(
    'menutype' => $usermenu,
    'startLevel' => 0,
    'endLevel' => 0,
    'showAllChildren' => 1
  ));
  $menulist = modMenuHelper::getList($menuparams);
}

// Load template
include(dirname(__FILE__)."/themes/$theme/tmpls/tmpl25.php");

// Init Texts for JS
$ialText = array(
  'COM_USERS_REGISTER_REQUIRED' => JText::_('COM_USERS_REGISTER_REQUIRED'),
  'COM_USERS_REGISTRATION' => JText::_('COM_USERS_REGISTRATION'),
  'IAL_PLEASE_WAIT' => JText::_('IAL_PLEASE_WAIT'),
  'IAL_VERY_WEAK' => JText::_('IAL_VERY_WEAK'),
  'IAL_WEAK' => JText::_('IAL_WEAK'),
  'IAL_REASONABLE' => JText::_('IAL_REASONABLE'),
  'IAL_STRONG' => JText::_('IAL_STRONG'),
  'IAL_VERY_STRONG' => JText::_('IAL_VERY_STRONG'),
  'COM_MEDIA_FIELD_MAXIMUM_SIZE_LABEL' => JText::_('COM_MEDIA_FIELD_MAXIMUM_SIZE_LABEL'),
  'COM_MEDIA_ERROR_WARNFILETOOLARGE' => JText::_('COM_MEDIA_ERROR_WARNFILETOOLARGE')
) ?>
<script>var ialText = <?php echo json_encode($ialText) ?>;</script>