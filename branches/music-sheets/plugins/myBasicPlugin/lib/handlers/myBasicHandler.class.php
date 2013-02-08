<?php

/*
 */

/**
 * Clase que contiene metodos basicos
 *
 * @author Rodrigo Santellan <rodrigo.santellan at inswitch.us>
 */
class myBasicHandler {

  /**
   *
   * @param boolean $response
   * @param array $options
   * @return json response
   */
  public static function JsonResponse($response, $options) {
    return json_encode(array(
                "response" => ($response ? "OK" : "ERROR"),
                "options" => $options
            ));
  }

  /**
   * Convierte un objecto en array
   * @param type $d
   * @return array 
   */
  public static function objectToArray($d) {
    if (is_object($d)) {
      // Gets the properties of the given object
      // with get_object_vars function
      $d = get_object_vars($d);
    }

    if (is_array($d)) {
      /*
       * Return array converted to object
       * Using __FUNCTION__ (Magic constant)
       * for recursive call
       */
      return array_map(array('myBasicHandler', __FUNCTION__), $d);
    } else {
      // Return array
      return $d;
    }
  }

  /**
   * Convierte un array en objecto
   * @param type $d
   * @return object 
   */
  public static function arrayToObject($d) {
    if (is_array($d)) {
      /*
       * Return array converted to object
       * Using __FUNCTION__ (Magic constant)
       * for recursive call
       */
      return (object) array_map(array('myBasicHandler', __FUNCTION__), $d);
    } else {
      // Return object
      return $d;
    }
  }

  /**
   * Encodea un string para ser usado en XML
   * @param <string> $str
   * @return <string>
   */
  public static function xmlEntities($str) {
    $xml = array('&#34;', '&#38;', '&#38;', '&#60;', '&#62;', '&#160;', '&#161;', '&#162;', '&#163;', '&#164;', '&#165;', '&#166;', '&#167;', '&#168;', '&#169;', '&#170;', '&#171;', '&#172;', '&#173;', '&#174;', '&#175;', '&#176;', '&#177;', '&#178;', '&#179;', '&#180;', '&#181;', '&#182;', '&#183;', '&#184;', '&#185;', '&#186;', '&#187;', '&#188;', '&#189;', '&#190;', '&#191;', '&#192;', '&#193;', '&#194;', '&#195;', '&#196;', '&#197;', '&#198;', '&#199;', '&#200;', '&#201;', '&#202;', '&#203;', '&#204;', '&#205;', '&#206;', '&#207;', '&#208;', '&#209;', '&#210;', '&#211;', '&#212;', '&#213;', '&#214;', '&#215;', '&#216;', '&#217;', '&#218;', '&#219;', '&#220;', '&#221;', '&#222;', '&#223;', '&#224;', '&#225;', '&#226;', '&#227;', '&#228;', '&#229;', '&#230;', '&#231;', '&#232;', '&#233;', '&#234;', '&#235;', '&#236;', '&#237;', '&#238;', '&#239;', '&#240;', '&#241;', '&#242;', '&#243;', '&#244;', '&#245;', '&#246;', '&#247;', '&#248;', '&#249;', '&#250;', '&#251;', '&#252;', '&#253;', '&#254;', '&#255;');
    $html = array('&quot;', '&amp;', '&amp;', '&lt;', '&gt;', '&nbsp;', '&iexcl;', '&cent;', '&pound;', '&curren;', '&yen;', '&brvbar;', '&sect;', '&uml;', '&copy;', '&ordf;', '&laquo;', '&not;', '&shy;', '&reg;', '&macr;', '&deg;', '&plusmn;', '&sup2;', '&sup3;', '&acute;', '&micro;', '&para;', '&middot;', '&cedil;', '&sup1;', '&ordm;', '&raquo;', '&frac14;', '&frac12;', '&frac34;', '&iquest;', '&Agrave;', '&Aacute;', '&Acirc;', '&Atilde;', '&Auml;', '&Aring;', '&AElig;', '&Ccedil;', '&Egrave;', '&Eacute;', '&Ecirc;', '&Euml;', '&Igrave;', '&Iacute;', '&Icirc;', '&Iuml;', '&ETH;', '&Ntilde;', '&Ograve;', '&Oacute;', '&Ocirc;', '&Otilde;', '&Ouml;', '&times;', '&Oslash;', '&Ugrave;', '&Uacute;', '&Ucirc;', '&Uuml;', '&Yacute;', '&THORN;', '&szlig;', '&agrave;', '&aacute;', '&acirc;', '&atilde;', '&auml;', '&aring;', '&aelig;', '&ccedil;', '&egrave;', '&eacute;', '&ecirc;', '&euml;', '&igrave;', '&iacute;', '&icirc;', '&iuml;', '&eth;', '&ntilde;', '&ograve;', '&oacute;', '&ocirc;', '&otilde;', '&ouml;', '&divide;', '&oslash;', '&ugrave;', '&uacute;', '&ucirc;', '&uuml;', '&yacute;', '&thorn;', '&yuml;');
    $str = str_replace($html, $xml, $str);
    //$str = str_ireplace($html,$xml,$str);
    return $str;
  }

  /**
   * Original PHP code by Chirp Internet: www.chirp.com.au
   * Please acknowledge use of this code by including this header.
   * @param type $string
   * @param type $limit
   * @param type $break
   * @param type $pad
   * @return type 
   */
  public static function mdTruncateText($string, $limit, $break = " ", $pad = "...") {
    // return with no change if string is shorter than $limit
    if (strlen($string) <= $limit)
      return $string;

    $string = substr($string, 0, $limit);
    if (false !== ($breakpoint = strrpos($string, $break))) {
      $string = substr($string, 0, $breakpoint);
    }

    return $string . $pad;
  }

  static public function slugify($text, $separator = 'dash', $lowercase = TRUE) {
    $text = strip_tags($text);
    $text = preg_replace("`\[.*\]`U", "", $text);
    $text = preg_replace('`&(amp;)?#?[a-z0-9]+;`i', '-', $text);
    $text = htmlentities($text, ENT_COMPAT, 'utf-8');
    $text = preg_replace("`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);`i", "\\1", $text);
    $text = preg_replace(array("`[^a-z0-9]`i", "`[-]+`"), "-", $text);

    if ($lowercase === TRUE) {
      $text = strtolower($text);
    }

    if ($separator != 'dash') {
      $text = str_replace('-', '_', $text);
      $separator = '_';
    } else {
      $separator = '-';
    }

    return trim($text, $separator);
  }

}

