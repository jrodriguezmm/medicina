
	<?php
	
	/**
	* @package     Sppolls
	*
	* @copyright   Copyright (C) 2010 - 2018 JoomShaper. All rights reserved.
	* @license     GNU General Public License version 2 or later; see LICENSE.txt
	*/

	defined('_JEXEC') or die;

	use Joomla\Utilities\ArrayHelper;

	class SppollsControllerPolls extends JControllerAdmin
	{

		public function getModel($name = 'Poll', $prefix = 'SppollsModel', $config = array('ignore_request' => true))
		{
			$model = parent::getModel($name, $prefix, $config);
			return $model;
			
		}
	}
		
