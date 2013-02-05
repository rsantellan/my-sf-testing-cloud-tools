<?php
class myMagick_enhancements
{
    public function denoise(myMagick $p,  $amount=1){
        $cmd   = $p->getBinary('convert');
        $cmd .= ' -noise '.$amount ;
        $cmd .= ' -background "none" "' . $p->getSource() .'"';
        $cmd .= ' "' . $p->getDestination() .'"';

        $p->execute($cmd);
        $p->setSource($p->getDestination());
        $p->setHistory($p->getDestination());
        return  $p ;
    }


    public function sharpen(myMagick $p, $amount =10){
        $cmd   = $p->getBinary('convert');
        $cmd .= ' -sharpen 2x' .$amount ;
        $cmd .= ' -background "none" "' . $p->getSource() .'"';
        $cmd .= ' "' . $p->getDestination() .'"';

        $p->execute($cmd);
        $p->setSource($p->getDestination());
        $p->setHistory($p->getDestination());
        return  $p ;
    }

    public function smooth(myMagick $p){
        $cmd   = $p->getBinary('convert');
        $cmd .= ' -despeckle -despeckle -despeckle ' ;
        $cmd .= ' -background "none" "' . $p->getSource() .'"';
        $cmd .= ' "' . $p->getDestination() .'"';

        $p->execute($cmd);
        $p->setSource($p->getDestination());
        $p->setHistory($p->getDestination());
        return  $p ;
    }

    public function saturate(myMagick $p, $amount=200){
        $cmd   = $p->getBinary('convert');
        $cmd .= ' -modulate 100,' .$amount ;
        $cmd .= ' -background "none" "' . $p->getSource().'"' ;
        $cmd .= ' "' . $p->getDestination().'"' ;

        $p->execute($cmd);
        $p->setSource($p->getDestination());
        $p->setHistory($p->getDestination());
        return  $p ;
    }

    public function contrast(myMagick $p,$amount=10){
        $cmd   = $p->getBinary('convert');
        $cmd .= ' -sigmoidal-contrast ' .$amount. 'x50%' ;
        $cmd .= ' -background "none" "' . $p->getSource().'"'  ;
        $cmd .= ' "' . $p->getDestination().'"'  ;

        $p->execute($cmd);
        $p->setSource($p->getDestination());
        $p->setHistory($p->getDestination());
        return  $p ;
    }


    public function edges(myMagick $p,$amount=10){
        $cmd   = $p->getBinary('convert');
        $cmd .= ' -adaptive-sharpen 2x' .$amount ;
        $cmd .= ' -background "none" "' . $p->getSource() .'"';
        $cmd .= ' "' . $p->getDestination() .'"';

        $p->execute($cmd);
        $p->setSource($p->getDestination());
        $p->setHistory($p->getDestination());
        return  $p ;
    }

}
?>