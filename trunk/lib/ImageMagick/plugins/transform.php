<?php
class myMagick_transform
{
    public function rotate (myMagick $p,$degrees=45){
        $cmd   = $p->getBinary('convert');
        $cmd .= ' -background "transparent" -rotate ' . $degrees ;
        $cmd .= '  "' . $p->getSource().'"' ;
        $cmd .= ' "' . $p->getDestination().'"' ;

        $p->execute($cmd);
        $p->setSource($p->getDestination());
        $p->setHistory($p->getDestination());
        return  $p ;
    }

    /**
     * Flips the image vericaly
     * @return unknown_type
     */
    public function flipVertical(myMagick $p){
        $cmd  = $p->getBinary('convert');
        $cmd .= ' -flip ' ;
        $cmd .= ' "' . $p->getSource() .'"';
        $cmd .= ' "' . $p->getDestination() .'"';

        $p->execute($cmd);
        $p->setSource($p->getDestination());
        $p->setHistory($p->getDestination());
        return  $p ;
    }

    /**
     * Flips the image horizonaly
     * @return unknown_type
     */
    public function flipHorizontal(myMagick $p){
        $cmd  = $p->getBinary('convert');
        $cmd .= ' -flop ' ;
        $cmd .= ' "' . $p->getSource() .'"';
        $cmd .= ' "' . $p->getDestination().'"' ;

        $p->execute($cmd);
        $p->setSource($p->getDestination());
        $p->setHistory($p->getDestination());
        return  $p ;
    }

    /**
     * Flips the image horizonaly and verticaly
     * @return unknown_type
     */
    public function reflection(myMagick $p, $size = 60, $transparency = 50){
    	$p->requirePlugin('info');

    	$source = $p->getSource();

    	//invert image
    	$this->flipVertical($p);

    	//crop it to $size%
        list($w, $h) = $p->getInfo($p->getDestination());
        $p->crop($w, $h * ($size/100),0,0,myMagickGravity::None);

        //make a image fade to transparent
        $cmd  = $p->getBinary('convert');
        $cmd .= ' "' . $p->getSource() .'"';
        $cmd .= ' ( -size ' . $w.'x'. ( $h * ($size/100)) .' gradient: ) ';
        $cmd .= ' +matte -compose copy_opacity -composite ';
        $cmd .= ' "' . $p->getDestination().'"' ;

        $p->execute($cmd);

        //apply desired transparency, by creating a transparent image and merge the mirros image on to it with the desired transparency
        $file = dirname($p->getDestination()) . '/'. uniqid() . '.png';

        $cmd  = $p->getBinary('convert');
        $cmd .= '  -size ' . $w.'x'. ( $h * ($size/100)) .' xc:none  ';
        $cmd .= ' "' . $file .'"' ;

        $p->execute($cmd);

        $cmd   = $p->getBinary('composite');
        $cmd .= ' -dissolve ' . $transparency ;
        $cmd .= ' "' . $p->getDestination() .'"' ;
        $cmd .= ' ' . $file ;
        $cmd .= ' "' . $p->getDestination() .'"' ;

        $p->execute($cmd);

        unlink($file);

        //append the source and the relfex
        $cmd  = $p->getBinary('convert');
        $cmd .= ' "' . $source .'"' ;
        $cmd .= ' "' . $p->getDestination().'"' ;
        $cmd .= ' -append ';
        $cmd .= ' "' . $p->getDestination().'"' ;

        $p->execute($cmd);

        $p->setSource($p->getDestination());
        $p->setHistory($p->getDestination());
        return  $p ;
    }

}
?>