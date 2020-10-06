<?php
/**
* Joomla! POWr Survey
*
* @version 2.0
* @author POWr.io
* @package POWr Survey
* @subpackage POWr
* @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
*
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

if(!class_exists('PowrHelper')){
    class PowrHelper{
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
		    $js_url = JURI::base()."modules/mod_powrsurvey/powr_joomla.js";
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
//Create Helper
new PowrHelper();
echo "<div class='powr-survey' label='joomla_$module->id'></div>";
?>