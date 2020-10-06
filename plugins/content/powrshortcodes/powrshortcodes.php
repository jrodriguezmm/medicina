<?php
/**
 * Joomla! POWr Plugin
*
* @version 3.0
* @author POWr.io
* @package POWr
* @subpackage powr
* @license GNU/GPL
*
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/*
class PlgSystempowrshortcodesInstallerScript
{
 public function install($parent)
 {
  trigger_error('IN INSTALL 1');
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
class PlgContentpowrshortcodesInstallerScript
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
*/
/*
class PlgSystempowrshortcodesInstallerScript
{
 public function install($parent)
 {
  echo('IN INSTALL 3');
  // Enable plugin
  $db  = JFactory::getDbo();
  $query = $db->getQuery(true);
  $query->update('#__extensions');
  $query->set($db->quoteName('enabled') . ' = 1');
  $query->where($db->quoteName('element') . ' = ' . $db->quote('PLUGIN_NAME_GOES_HERE'));
  $query->where($db->quoteName('type') . ' = ' . $db->quote('plugin'));
  $db->setQuery($query);
  $db->execute();
 }
}
class PlgContentpowrshortcodesInstallerScript
{
 public function install($parent)
 {
  echo('IN INSTALL 4');
  // Enable plugin
  $db  = JFactory::getDbo();
  $query = $db->getQuery(true);
  $query->update('#__extensions');
  $query->set($db->quoteName('enabled') . ' = 1');
  $query->where($db->quoteName('element') . ' = ' . $db->quote('PLUGIN_NAME_GOES_HERE'));
  $query->where($db->quoteName('type') . ' = ' . $db->quote('plugin'));
  $db->setQuery($query);
  $db->execute();
 }
}
*/




if(!class_exists('PowrHelper')){
	class PowrHelper{
	    public $local_mode = false;
	    public $powr_token;
	
		function __construct() {
			$this->get_powr_token(); //Get powr token
			$this->add_powr_js(); //Add powr.js
		}
	
		//Generate a powr token
		public function generate_powr_token(){
	      $alphabet = 'abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789';
	      $pass = array(); //remember to declare $pass as an array
	      $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	      for ($i = 0; $i < 10; $i++) { //Add 10 random characters
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	      }
	      $pass_string = implode($pass) . time(); //Add the current time to avoid duplicate keys
	      return $pass_string; //turn the array into a string
	    }
	    
	    //Get powr token (or create it if it doesn't exist)
	    public function get_powr_token(){
			$db = JFactory::getDBO(); //Initialize JFactory;
			//Make sure table exists:
			$query = "CREATE TABLE IF NOT EXISTS `#__powr` ( `data_type` VARCHAR(50) NOT NULL, `value` VARCHAR(50) NOT NULL, PRIMARY KEY (`data_type`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
			$db->setQuery($query);
			$result = $db->query();
			
			//Get powr_token:
			$query = "SELECT value FROM #__powr WHERE data_type = 'powr_token'";
			$db->setQuery($query);
			$result = $db->loadAssoc();
			$powr_token = $result['value'];
	
			//If powr token is null, set it;
			if($powr_token == NULL){
				$powr_token = $this->generate_powr_token();
				$query = "INSERT INTO #__powr (data_type, value) VALUES ('powr_token','$powr_token')";
				$db->setQuery($query);
				$db->query();	
			}
			
			//Set powr token:
			$this->powr_token = $powr_token;
			//echo "POWR TOKEN IS $this->powr_token";
	    }
	    
	    public function add_powr_js(){
			global $POWR_JS_ADDED; //Global flag that powr js has been added
			if($POWR_JS_ADDED){
				return;
			}
			if($this->local_mode){//Determine JS url:
				$js_url = '//localhost:3000/powr_local.js';
			}else{
				$js_url = JURI::base(). "plugins/content/powrshortcodes/powr_joomla.js";
			}    	
			$js = "(function(d){
					  var js, id = 'powr-js', ref = d.getElementsByTagName('script')[0];
					  if (d.getElementById(id)) {return;}
					  js = d.createElement('script'); js.id = id; js.async = true;
					  js.src = '$js_url';
					  js.setAttribute('powr-token','$this->powr_token');
					  js.setAttribute('external-type','joomla');
					  ref.parentNode.insertBefore(js, ref);
					}(document));";				
			$document = JFactory::getDocument();  
			$document->addScriptDeclaration($js); //Add js to doc
			$POWR_JS_ADDED=true;
	    }
	}
}	
//Add powr helper
new PowrHelper();
?>