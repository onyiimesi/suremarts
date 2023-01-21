<?php 

  function slug($text){ 

    // replace non letter or digits by -
    $rand = rand(1000,9999999);
    $text = preg_replace('/[\-\s]+/', '-', $text.'-'.$rand);

    // trim
    $text = trim($text, '-');

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // lowercase
    $text = strtolower($text);

    // remove unwanted characters
    $text = preg_replace('/[^\-\s\pN\pL]+/u', '', $text);

    if (empty($text))
    {
      return 'n-a';
    }

    return $text;
  }