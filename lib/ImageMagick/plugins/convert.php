<?php
class myMagick_convert
{
    public function convert(myMagick $p)
    {
        $cmd = $p->getBinary('convert');
        $cmd .= ' -quality ' . $p->getImageQuality();
        $cmd .= ' "' . $p->getSource() .'"  "'. $p->getDestination().'"';

        $p->execute($cmd);
        $p->setSource($p->getDestination());
        $p->setHistory($p->getDestination());
        return  $p ;
    }

    public function save(myMagick $p)
    {
        return $p->convert($p);
    }
}
?>