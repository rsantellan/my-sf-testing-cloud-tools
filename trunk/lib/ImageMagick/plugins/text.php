<?php
class myMagick_text
{
    /**
     * Draws an image with the submited string, usefull for water marks
     *
     * @param $text String - the text to draw an image from
     * @param $format myMagickTextObject - the text configuration
     */
    public function fromString(myMagick $p, $text = '', myMagickTextObject $format = null){

        if(is_null($format)) $format = new myMagickTextObject();

        $cmd  = $p->getBinary('convert');

        if ($format->background !== false)
            $cmd .= ' -background "' . $format->background . '"';

        if ($format->color !== false)
            $cmd .= ' -fill "' . $format->color . '"' ;

        if ($format->font !== false)
            $cmd .= ' -font ' . $format->font ;

        if ($format->fontSize !== false)
            $cmd .= ' -pointsize ' . $format->fontSize ;

        if (($format->pText != '') && ($text = '') )
            $text = $format->pText ;

        $cmd .= ' label:"'. $text .'"';
        $cmd .= ' "' . $p->getDestination().'"' ;

        $p->execute($cmd);
        $p->setSource($p->getDestination());
        $p->setHistory($p->getDestination());
        return  $p ;
    }
}


?>