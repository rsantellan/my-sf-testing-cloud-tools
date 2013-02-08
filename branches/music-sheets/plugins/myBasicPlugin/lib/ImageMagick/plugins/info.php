<?php
class myMagick_info
{
    public function getInfo(myMagick $p, $file='')
    {
        if ($file == '') $file = $p->getSource();
        return getimagesize  ($file);
    }

    public function getWidth(myMagick $p, $file=''){
        list($width, $height, $type, $attr) = $this->getInfo($p, $file);
        return $width;
    }

    public function getHeight(myMagick $p, $file=''){
        list($width, $height, $type, $attr)	 = $this->getInfo($p, $file);
        return $height;
    }


    public function getBits(myMagick $p, $file=''){
        if ($file == '') $file = $p->getSource();
        $info =  getimagesize  ($file);
        return $info["bits"];
    }

    public function getMime(myMagick $p, $file=''){
        if ($file == '') $file = $p->getSource();
        $info =  getimagesize  ($file);
        return $info["mime"];
    }
}
?>