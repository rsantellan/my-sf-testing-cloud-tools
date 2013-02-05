<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of myDefaultCultureFilter
 *
 * @author rodrigo
 */
class myDefaultCultureFilter extends sfBasicSecurityFilter{
  
  public function execute($filterChain) {
    
    if ($this->isFirstCall())
    {
      $has_multiple_lang = sfConfig::get( 'sf_show_multiple_language', true );
      if(!$has_multiple_lang)
      {
        $default_language = sfConfig::get('sf_default_culture');
        $this->getContext()->getUser()->setCulture($default_language);
      }
    }
    parent::execute($filterChain);
  }

  
}


