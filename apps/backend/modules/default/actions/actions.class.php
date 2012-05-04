<?php

/**
 * Description of actionsclass
 *
 * @author Rodrigo Santellan
 */
class defaultActions extends sfActions {

  public function executeIndex(sfWebRequest $request) 
  {
	if (!$request->getParameter('sf_culture')) {
	  if ($this->getUser()->isFirstRequest()) {
		$culture = $request->getPreferredCulture(array('en', 'es'));
		$this->getUser()->setCulture($culture);
		$this->getUser()->isFirstRequest(false);
	  } else {
		$culture = $this->getUser()->getCulture();
	  }

	  $this->redirect('localized_homepage');
	}
  }

}