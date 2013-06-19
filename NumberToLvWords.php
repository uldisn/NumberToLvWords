<?

class NumberToLvWords {
     public static $numb = array('nulle', 'viens', 'divi', 'trīs', 'četri', 'pieci', 'seši', 'septiņi', 'astoņi', 'deviņi', 'desmit');
     public static $tens = array('', 'vien', 'div', 'trīs', 'četr', 'piec', 'seš', 'septiņ', 'astoņ', 'deviņ');
     public static $bigones = array(100 => 'simti', 1000 => 'tūkstoši', 1000000 => 'miljoni', 1000000000 => 'miljardi');

     static function toWords($num){

         $num = number_format($num, 2, '.', '');
         $numParts = explode('.', $num);
         $lsString = '';

         if ($numParts[1] > 0){
             $santString = self::tenWords($numParts[1]) . (($numParts[1] % 10 == 1 && $numParts[1] != 11) ? 'santīms ' : 'santīmi ');
         }else{
             $santString = 'nulle santīmi';
         }

         $thousands = floor($numParts[0] / 1000);
         if (99 < $thousands){
	      return ('ERROR: Nevar konvertēt lielāku summu par 99 999.99');
	     }

         if (!empty($thousands)){
             $lsString = self::tenWords($thousands) . (($thousands % 10 == 1 && $thousands != 11) ? ' tūkstotis ' : 'tūkstoši ');
         }

         $hundreds = substr(floor($numParts[0] / 100), 0, 1);

         if (!empty($hundreds)){
             $lsString .= self::$numb[intval($hundreds)] . ($hundreds % 10 == 1 ? ' simts ' : ' simti ');
         }

         $tenLats = substr($numParts[0], -2);
         if ($tenLats < 100){
             $lsString .= self::tenWords($tenLats) . (($tenLats % 10 == 1 && $tenLats != 11) ? 'lats' : 'lati');
         }

         $text = $lsString . ' ' . $santString;
         return $text;
     }
  
     static function tenWords($num){
         if ($num > 19){
             $firstDigit = substr($num, 0, 1);
             $secondDigit = substr($num, 1, 1);
             if ($secondDigit == 0)
                 return self::$tens[$firstDigit] . 'desmit ';
             else
                 return self::$tens[$firstDigit] . 'desmit ' . self::$numb[$secondDigit] . ' ';
         }elseif($num <= 19 AND $num > 10){
             return self::$tens[$num % 10] . 'padsmit ';
         }elseif($num <= 10){
             return self::$numb[intval($num)] . ' ';
         }

     }
   
}