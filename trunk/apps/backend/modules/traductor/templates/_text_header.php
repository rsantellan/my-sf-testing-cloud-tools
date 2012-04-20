<?php
use_helper('Text');
$index = 0;
foreach ($header_text as $key => $value):

    $txt = explode('_', $key);
    $name = $txt[0];
    array_shift($txt);
?>
<div class="accordion-header" text-page="<?php echo $name ?>">
    <input type="hidden" class="full_key" value="<?php echo $full_keys[$index] ?>" />
    <div style="font-size: 10px; margin: 5px;">
        <span><?php echo $name ?></span> / <span><?php echo implode(' ', $txt)?></span>
    </div>

    <div style="margin-left: 5px; margin-bottom: 5px;">
        <?php $file_content = strip_tags(html_entity_decode($value[0])); ?>
        <span class="translation_text"><?php echo truncate_text($file_content, 100); ?></span>
    </div>
	<a href="javascript:void(0)" onclick="return myTranslator.getInstance().loadTexts('<?php echo $name ?>', '<?php echo $full_keys[$index] ?>')">Editar</a>
    
</div>
<div class="accordion-body <?php echo $name ?>"></div>

<?php
$index++;
endforeach; ?>