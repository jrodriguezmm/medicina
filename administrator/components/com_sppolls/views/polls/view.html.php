
<?php

/**
* @package     Sppolls
*
* @copyright   Copyright (C) 2010 - 2018 JoomShaper. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/

defined('_JEXEC') or die;

class SppollsViewPolls extends JViewLegacy
{
	protected $items;

	protected $state;

	protected $pagination;

	protected $model;

	public $filterForm, $activeFilters;

	public function display($tpl = null)
	{
		$this->items        	= $this->get('Items');
		$this->state       		= $this->get('State');
		$this->pagination   	= $this->get('Pagination');
		$this->model        	= $this->getModel('polls');
		$this->filterForm 		= $this->get('FilterForm');
		$this->activeFilters 	= $this->get('ActiveFilters');

		SppollsHelper::addSubmenu('polls');


		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500,implode('<br>', $errors));
			return false;
		}

		$this->addToolbar();
		$this->sidebar = JHtmlSidebar::render();

		foreach($this->items as &$item)
		{
			$item->cpolls = $this->model->formatPolls($item->polls);
		}
		
		return parent::display($tpl);
	}

	protected function addToolbar()
	{
		$state = $this->get('State');
		$canDo = SppollsHelper::getActions('com_sppolls','component');
		$user 	= JFactory::getUser();
		$bar 	= JToolbar::getInstance('toolbar');


		if ($canDo->get('core.create'))
		{
			JToolbarHelper::addNew('poll.add');
		}

		if ($canDo->get('core.edit'))
		{
			JToolbarHelper::editList('poll.edit');
		}

		if ($canDo->get('core.edit.state'))
		{
			JToolbarHelper::publish('polls.publish','JTOOLBAR_PUBLISH',true);
			JToolbarHelper::unpublish('polls.unpublish','JTOOLBAR_UNPUBLISH',true);
			JToolbarHelper::archiveList('polls.archive');
			JToolbarHelper::checkin('polls.checkin');
		}

		if ($state->get('filter.published') == -2 && $canDo->get('core.delete'))
		{
			JToolbarHelper::deleteList('','polls.delete','JTOOLBAR_EMPTY_TRASH');
		}
		elseif ($canDo->get('core.edit.state'))
		{
			JToolbarHelper::trash('polls.trash');
		}

		if ($canDo->get('core.admin'))
		{
			JToolbarHelper::preferences('com_sppolls');
		}

		JHtmlSidebar::setAction('index.php?option=com_sppolls&view=polls');

		JToolbarHelper::title(JText::_('COM_SPPOLLS_TITLE_POLLS'),'');
	}
}
	
