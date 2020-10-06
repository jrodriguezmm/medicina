
<?php

/**
* @package     Sppolls
*
* @copyright   Copyright (C) 2010 - 2018 JoomShaper. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/

defined('_JEXEC') or die;

class SppollsModelPoll extends JModelAdmin
{
	protected $text_prefix = 'COM_SPPOLLS';

	public function getTable($name = 'Poll', $prefix = 'SppollsTable', $config = array())
	{
		return JTable::getInstance($name, $prefix, $config);
	}

	public function getForm($data = array(), $loadData = true)
	{
		$app = JFactory::getApplication();
		$form = $this->loadForm('com_sppolls.poll','poll',array('control' => 'jform', 'load_data' => $loadData));

		if (empty($form))
		{
			return false;
		}

		return $form;
	}

	public function loadFormData()
	{
		$data = JFactory::getApplication()
			->getUserState('com_sppolls.edit.poll.data',array());

		if (empty($data))
		{
			$data = $this->getItem();
		}

		return $data;
	}

	protected function canDelete($record)
	{
		if (!empty($record->id))
		{
			if ($record->published != -2) {
				return ;
			}

			$user = JFactory::getUser();

			return parent::canDelete($record);
		}

	}

	protected function canEditState($record)
	{
		return parent::canEditState($record);
	}

	public function getItem($pk = null)
	{
		return parent::getItem($pk);
	}
}
	
