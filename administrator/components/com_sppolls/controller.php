<?php


defined('_JEXEC') or die;


class SppollsController extends JControllerLegacy{


  public function display($cachable=false,$urlparams=false){
    $view   = $this->input->get('view','polls');
    $layout = $this->input->get('layout','default');
    $id     = $this->input->getInt('id');
    $this->input->set('view',$view);
    // Check for edit form.
    if($view == 'poll' && $layout == 'edit' && !$this->checkEditId('com_sppolls.edit.poll',$id)){
      // Somehow the person just went to the form - we don't allow that.
      $this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID',$id));
      $this->setMessage($this->getError(),'error');
      $this->setRedirect(JRoute::_('index.php?option=com_sppolls&view=polls',false));

      return false;
    }

    parent::display($cachable,$urlparams);

    return $this;
  }

}
