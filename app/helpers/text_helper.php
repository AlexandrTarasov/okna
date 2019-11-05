<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	/**
	 * Функция возвращает окончание для множественного числа слова на основании числа и массива окончаний
	 * param  $number Integer Число на основе которого нужно сформировать окончание
	 * param  $endingsArray  Array Массив слов или окончаний для чисел (1, 4, 5),
	 *         например array('яблоко', 'яблока', 'яблок')
	 * return String
	 */
	function getNumEnding($number, $endingArray)
	{
	    $number = $number % 100;
	    if ($number>=11 && $number<=19) {
	        $ending=$endingArray[2];
	    }
	    else {
	        $i = $number % 10;
	        switch ($i)
	        {
	            case (1): $ending = $endingArray[0]; break;
	            case (2):
	            case (3):
	            case (4): $ending = $endingArray[1]; break;
	            default: $ending=$endingArray[2];
	        }
	    }
	    return $ending;
	}
	




	function russianPhoneFormat($phone)
	{
				
		if(strlen($phone) == 12)
		{
			return sprintf("+%s (%s) %s %s %s",
              substr($phone, 0, 2),
              substr($phone, 2, 3),
              substr($phone, 5, 3),
              substr($phone, 8, 2),
              substr($phone, 10, 2)
            );	
            		
		} elseif(strlen($phone) == 10){
			return sprintf("(%s) %s %s %s",
              substr($phone, 0, 3),
              substr($phone, 2, 3),
              substr($phone, 5, 2),
              substr($phone, 8, 2)
            );	
		} else {
			return $phone;
		}
	}	
	