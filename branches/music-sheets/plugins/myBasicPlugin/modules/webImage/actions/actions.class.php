<?php

/**
 * webImage actions.
 *
 * @package    testing
 * @subpackage webImage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class webImageActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    try{

        $param = $request->getParameter ( 'p' );
        $response = $this->getResponse();
        $ruta = base64_decode($param, true);
        $cachePath = sfConfig::get('sf_cache_dir') . DIRECTORY_SEPARATOR. 'images'.DIRECTORY_SEPARATOR.'web';
        $filePath = $cachePath.$ruta;
		sfContext::getInstance()->getLogger()->info('>>>>>>> ruta de la imagen en el modulo webImage. >>>>>>>>>>' . $filePath);
        if (file_exists($filePath))
        {
          $response->setContentType('image/jpeg'); 
          $response->setContent ( file_get_contents($filePath));
        }
        else
        {
            $response->setStatusCode(404); //404 Not Found
        }
    }catch(Exception $e){
        
        $response->setStatusCode(404); //404 Not Found
    }
    sfConfig::set('sf_web_debug', false);  
    $this->setLayout ( false );
    return sfView::NONE;
  }
}
