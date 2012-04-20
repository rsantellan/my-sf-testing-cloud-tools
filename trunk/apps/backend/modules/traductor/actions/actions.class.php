<?php

/**
 * traductor actions.
 *
 * @package    testing
 * @subpackage traductor
 * @author     Rodrigo Santellan
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class traductorActions extends sfActions {

  private $myI18nTranslator;
  var $selected_lang;

  /**
   * Executes index action
   *
   * @param sfRequest $request A request object
   */
  public function executeIndex(sfWebRequest $request) {
	$this->loadI18nTranslator($request);
	//cargo los datos para la vista
	$this->lang = $this->myI18nTranslator->getSelectedLang();

	$this->selected_catalogue = $this->myI18nTranslator->getSelectedCatalogue();

	if ($this->getUser()->hasAttribute('hasToPublish')) {
	  $this->display = 'block';
	} else {
	  $this->display = 'none';
	}

	$this->selectionForm = $this->getSfFormForSelection();
	$this->error = '';
	$this->newWordForm = $this->getSfFormNewWord();
	$this->appCount = count($this->myI18nTranslator->getApplicationList());
  }

  /**
   * Crea un formulario para agregar nuevas palabras
   * @return sfForm 
   */
  private function getSfFormNewWord() {
	$form = new sfForm();
	if (count($this->myI18nTranslator->getApplicationList()) == 1) {
	  $form->setWidget('application', new sfWidgetFormSelect(array('choices' => $this->myI18nTranslator->getApplicationList(), 'default' => $this->myI18nTranslator->getSelectedApplication()), array('style' => 'display:none')));
	} else {
	  $form->setWidget('application', new sfWidgetFormSelect(array('label' => 'Aplicacion', 'choices' => $this->myI18nTranslator->getApplicationList(), 'default' => $this->myI18nTranslator->getSelectedApplication())));
	}
	$form->setWidget('page', new sfWidgetFormInput(array(), array('label' => 'Page')));
	$form->setWidget('tag', new sfWidgetFormInput(array(), array('label' => 'tag')));

	$form->setValidator('page', new sfValidatorString(array('required' => true)));
	$form->setValidator('tag', new sfValidatorString(array('required' => true)));
	$form->setValidator('application', new sfValidatorString(array('required' => false)));
	$form->getWidgetSchema()->setNameFormat('newWord[%s]');
	return $form;
  }

  /**
   * Crea un formulario para seleccionar los idiomas a seleccionar
   * @return sfForm 
   */
  private function getSfFormForSelection() {

	$form = new sfForm ();
	if (count($this->myI18nTranslator->getApplicationList()) == 1) {
	  $form->setWidget('application', new sfWidgetFormSelect(array('choices' => $this->myI18nTranslator->getApplicationList(), 'default' => $this->myI18nTranslator->getSelectedApplication()), array('style' => 'display:none')));
	} else {
	  $form->setWidget('application', new sfWidgetFormSelect(array('label' => 'Aplicacion', 'choices' => $this->myI18nTranslator->getApplicationList(), 'default' => $this->myI18nTranslator->getSelectedApplication())));
	}
	$form->setWidget('catalogue', new sfWidgetFormInputHidden(array('default' => 'messages')));
	$form->setWidget('language', new sfWidgetFormInputHidden(array('default' => $this->getUser()->getCulture())));
	$form->setWidget('base_language', new sfWidgetFormInputHidden(array('default' => sfConfig::get('sf_default_culture'))));
	$form->setWidget('pages', new sfWidgetFormChoice(array('label' => 'paginas disponibles', 'multiple' => true, 'choices' => $this->myI18nTranslator->getApplicationPages())));

	return $form;
  }

  /**
   * Hace la carga inicial de los catalogos xml con el request que se genera
   * @param sfWebRequest $request
   * @return traductorActions 
   */
  private function loadI18nTranslator(sfWebRequest $request) {

	if ($request->hasParameter('app')) {
	  $selected_app = $this->getRequestParameter('app');
	} elseif ($this->getUser()->hasFlash('selected_app')) {
	  $selected_app = $this->getUser()->getFlash('selected_app');
	} else {
	  $translatorSettings = sfConfig::get('sf_myI18nTranslator', '');
	  $arrApps = $translatorSettings['translate_apps'];
	  $selected_app = $arrApps[0];
	  // $selected_app = sfContext::getInstance ()->getConfiguration ()->getApplication ();
	}

	$this->getUser()->setFlash('selected_app', $selected_app);
	$restricted_apps = array();
	/*
	 * TODO: esto es para cuando tenga permisos
	  if (!$this->getUser()->isSuperAdmin()) {
	  $frontend = false;
	  $backend = false;
	  if ($this->getUser()->hasGroup('traductores del sitio español')) {
	  $restricted_apps['frontend'] = 'frontend';

	  $frontend = true;
	  }
	  if ($this->getUser()->hasGroup('traductores del admin español')) {
	  $restricted_apps['backend'] = 'backend';

	  $backend = true;
	  }
	  if ($this->getUser()->hasGroup('translators frontend english')) {
	  if (!$frontend)
	  $restricted_apps['frontend'] = 'frontend';
	  }
	  if ($this->getUser()->hasGroup('translators backend english')) {
	  if (!$backend)
	  $restricted_apps['backend'] = 'backend';
	  }
	  }
	 */
	$this->myI18nTranslator = new myI18nTranslatorHandler(array('selected_app' => $selected_app, 'restrict_to_applications' => $restricted_apps));


	// levanto el lenguage
	if ($request->hasParameter('lang')) {
	  $this->selected_lang = $request->getParameter('lang');
	} elseif ($this->getUser()->hasFlash('selected_lang'))
	  $this->selected_lang = $this->getUser()->getFlash('selected_lang');


	if (!in_array($this->selected_lang, $this->limitLangListByUserPermissions($this->myI18nTranslator->getLangList()))) {
	  $tmp = $this->limitLangListByUserPermissions($this->myI18nTranslator->getLangList());
	  $this->selected_lang = reset($tmp);

	  //unset($tmp);
	}

	$this->getUser()->setFlash('selected_lang', $this->selected_lang);

	// levanto el catalogo
	$selected_catalogue = $request->getParameter('catalogue');

	if ($this->getUser()->hasFlash('selected_catalogue')) {
	  $selected_catalogue = $this->getUser()->getFlash('selected_catalogue');
	}

	if (!in_array($selected_catalogue, $this->myI18nTranslator->getCatalogueList())) {
	  $tmp = $this->myI18nTranslator->getCatalogueList();
	  $selected_catalogue = reset($tmp);
	  unset($tmp);
	}

	$this->getUser()->setFlash('selected_catalogue', $selected_catalogue);


	$this->myI18nTranslator->setSelectedLang($this->selected_lang);
	$this->myI18nTranslator->setSelectedCatalogue($selected_catalogue);

	return $this;
  }

  /**
   * En caso de estar activados los permisos para los grupos solo devuelve los idiomas que la persona puede traducir.
   * 
   * @param type $lang_list array
   * @return type array
   */
  private function limitLangListByUserPermissions($lang_list) {
	return $lang_list;
	if (!sfConfig::get('sf_plugins_user_groups_permissions', false)) {
	  return $lang_list;
	}
	$result = array();
	foreach ($lang_list as $lang) {
	  if ($lang == "es") {
		if ($this->getUser()->hasGroup('traductores del sitio español') || $this->getUser()->hasGroup('traductores del admin español')) {
		  $result[$lang] = $lang;
		}
	  }
	  if ($lang == "en") {
		if ($this->getUser()->hasGroup('translators frontend english') || $this->getUser()->hasGroup('translators backend english')) {
		  $result[$lang] = $lang;
		}
	  }
	  if ($lang == "pt") {
		if ($this->getUser()->hasGroup('Tradutores site público em Português') || $this->getUser()->hasGroup('Site administradores tradutores em Português')) {
		  $result[$lang] = $lang;
		}
	  }
	}
	return $result;
  }

  /**
   * Retorna un listado de todas las paginas que se tiene conocimiento.
   * 
   * @param sfWebRequest $request
   * @return json array 
   */
  public function executeGetApplicationPagesAjax(sfWebRequest $request) {

	$this->loadI18nTranslator($request);

	$paginas = $this->myI18nTranslator->getApplicationPages();

	$index = 0;
	$salida = array();
	foreach ($paginas as $var) {
	  $salida[$index]['page'] = $var;
	  $index++;
	}
	return $this->renderText(json_encode($salida));
  }

  /**
   *
   *  Retorna un listado de los posibles idiomas
   * 
   * @param sfWebRequest $request
   * @return json Array 
   */
  public function executeGetLangsAjax(sfWebRequest $request) {
	$app = $request->getPostParameter('app');
	$i18n = sfContext::getInstance()->getI18N();
	$i18n_dir = sfConfig::get('sf_app_module_dir') . '/' . $app . '/i18n';

	// module is in modules dir, but i18n does not exists
	$i18n_dir = sfConfig::get('sf_root_dir') . DIRECTORY_SEPARATOR . 'apps' . DIRECTORY_SEPARATOR . $app . DIRECTORY_SEPARATOR . 'i18n';

	if (!is_dir($i18n_dir)) {
	  $this->logMessage('<-- Muere 1 -->');
	  unset($this->message_source);
	  return;
	}

	$this->message_source = $i18n->createMessageSource($i18n_dir);

	$catalogues = $this->message_source->catalogues();
	$options = array();
	$i = 0;
	foreach ($catalogues as $cat) {
	  $options[$i]['id'] = $cat[1];
	  $options[$i]['name'] = $cat[1];
	  $i++;
	}
	return $this->renderText(json_encode($options));
  }

  /**
   * Obtiene todos los textos para traducir
   * @param sfWebRequest $request
   * @return String HTML 
   */
  public function executeGetTranslationsFormsHeader(sfWebRequest $request) {
	$index = $request->getParameter('index');
	$selected_page = $request->getParameter('page');

	$baseLang = $request->getParameter('baselang');
	$baseIndex = $index;

	$this->loadI18nTranslator($request);


	$header_text = array();
	$full_keys = array();
	foreach ($this->myI18nTranslator->getMessages() as $key => $var) {
	  $exploded_key = explode('_', $key);


	  if ($selected_page == $exploded_key[0]) {
		array_push($full_keys, $key);
		$header_text[$key] = $var;
	  }
	}

	return $this->renderPartial('text_header', array('header_text' => $header_text, 'full_keys' => $full_keys));
  }

  /**
   *
   * Devuelve el formulario para editar
   * 
   * @param sfWebRequest $request
   * @return type 
   */
  public function executeGetContentToEdit(sfWebRequest $request) {
	//pagina seleccionada
	$key_page = $request->getParameter('key');
	//key completa pagina y texto a traducir
	$full_key = $request->getParameter('full_key');
	//id que neceista el formulario en este caso no nos interesa
	//porque siempre es 1 solo form
	$id = $request->getParameter('id', '1');
	//lenguage base que se usa como referencia para traducir
	$baseLang = $request->getParameter('base', '');
	$baseIndex = 1;

	$baseEnabled = ($baseLang != '' ? true : false);

	$this->loadI18nTranslator($request);

	$baseMdTranslator = new myI18nTranslatorHandler(array(
				'selected_app' => $this->myI18nTranslator->getSelectedApplication(),
				'selected_lang' => $baseLang,
				'selected_catalogue' => $this->myI18nTranslator->getSelectedCatalogue())
	);

	$showText = ($baseLang != $this->myI18nTranslator->getSelectedLang());

	if ($baseEnabled) { //si se eligio un base language levanta los datos del ms del leng original
	  $messagesBase = $baseMdTranslator->getMessages();
	}

	foreach ($this->myI18nTranslator->getMessages() as $key => $var) {
	  $exploded_key = explode('_', $key);

	  if ($baseEnabled) {
		$base = $messagesBase[$key][0];
	  } else {
		$base = " ";
	  }

	  if ($key == $full_key) {
		$form = $this->getSfFormForUpdate($full_key, $var, $id, $base);
		return $this->renderPartial('formList', array('form' => $form, 'index' => $baseIndex, 'page' => $key_page, 'showText' => $showText));
	  }
	}

	return $this->renderText('ERROR');
  }

  private function getSfFormForUpdate($key, $values, $id, $base) {
	$form = new sfForm ( );
	$form->setWidget('selected_lang_add', new sfWidgetFormInputHidden(array(), array('value' => $this->myI18nTranslator->getSelectedLang())));
	$form->setWidget('selected_catalogue_add', new sfWidgetFormInputHidden(array(), array('value' => $this->myI18nTranslator->getSelectedCatalogue())));
	$form->setWidget('translation_source_' . $id, new sfWidgetFormInputHidden(array(), array('value' => $key)));
	$form->setWidget('translation_source_text_' . $id, new sfWidgetFormInputText(array(), array('value' => $key)));
	$form->getWidget('translation_source_text_' . $id)->setDefault($key);
	$form->setWidget('translation_new_' . $id, new sfWidgetFormTextarea());
	$form->getWidget('translation_new_' . $id)->setDefault($values[0]);
	$form->setWidget('translation_base_' . $id, new sfWidgetFormInputText(array(), array('value' => $base)));
	$form->getWidget('translation_base_' . $id)->setDefault($base);

	return $form;
  }

}
