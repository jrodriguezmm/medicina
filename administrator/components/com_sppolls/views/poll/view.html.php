
<?php

/**
* @package     Sppolls
*
* @copyright   Copyright (C) 2010 - 2018 JoomShaper. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/

defined('_JEXEC') or die;

class SppollsViewPoll extends JViewLegacy
{
	protected $item;

	protected $form;

	public function display($tpl = null)
	{
		$this->item = $this->get('Item');
		$this->form = $this->get('Form');

		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br>',$errors));
			return false;
		}

		$this->addToolbar();

		return parent::display($tpl);
	}

	protected function addToolbar()
	{
		$input = JFactory::getApplication()->input;
		$input->set('hidemainmenu',true);

		$user = JFactory::getUser();
		$userId = $user->get('id');
		$isNew = $this->item->id == 0;
		$canDo = SppollsHelper::getActions('com_sppolls','component');

		JToolbarHelper::title(JText::_('COM_SPPOLLS_TITLE_POLLS_EDIT'), '');

		if ($canDo->get('core.edit'))
		{
			JToolbarHelper::apply('poll.apply','JTOOLBAR_APPLY');
			JToolbarHelper::save('poll.save','JTOOLBAR_SAVE');
			JToolbarHelper::save2new('poll.save2new');
		}

		JToolbarHelper::cancel('poll.cancel','JTOOLBAR_CLOSE');

	}
}
	
