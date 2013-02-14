<?php
/**
 * Description of sfWidgetDatepicker
 *
 * @author Rodrigo Santellan
 */
class  sfWidgetFormInputAutocomplete extends sfWidgetFormInput
{
    public function configure($options = array(), $attributes = array())
    {
      $this->addRequiredOption('choices');
    }

    public function render($name, $value = null, $attributes = array(), $errors = array())
    {
        $response = sfContext::getInstance()->getResponse();
        
        $attributes['class'] = 'autocompleteInput';

        $stringOptions = " ";
        foreach($this->getOption('choices') as $choice)
        {
          $stringOptions .= '"'.$choice.'",';
        }
        $stringOptions = substr($stringOptions, 0, -1);
        $js = '
<style>
	.ui-button { margin-left: -1px; }
	.ui-button-icon-only .ui-button-text { padding: 0; }
	.ui-autocomplete-input { margin: 0; padding: 1px 0 1px 0; }
</style>

<script>

var autoCompleteInputTags = ['.$stringOptions.'];
console.info(autoCompleteInputTags);

$(function() {
   	$( "#'.$this->generateId($name).'" ).autocomplete( { source: autoCompleteInputTags} );
});
</script>';

        $value_data = '';

       return parent::render($name, $value, $attributes, $errors).$js;
    }
}