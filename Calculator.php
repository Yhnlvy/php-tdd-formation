<?php

class Calculator
{
    public function addStringNumbers($str)
    {
        //$numberArray = explode(",", $str);
        //$pattern = "/(,|\n)/";
        $parsedInput = $this->parseInput($str);
        $delimiters = $parsedInput[0];
        $numbers = $parsedInput[1];
        $numberArray = $this->multiexplode($delimiters, $numbers);
        $numberArray = array_map("intval", $numberArray);
        $L =  count($numberArray);
        $res = 0;
        for($i = 0; $i < $L; $i++){
            $current = $numberArray[$i];
            if ($current < 0) {
                throw new Exception('Negatives not allowed');
            }
            if ($current > 1000) {
                $current = 0;
            }
            $res = $res + $current;
        }
        return 0;
    }

    public function parseInput($input)
    {
        $firstDigit = (string) preg_match("/\D+/", $input);
        $firstDigitPos = strpos($input, $firstDigit);
        $numbers = substr($input, $firstDigitPos);
        $defaultDelimiters = array(',', '\n');
        $delimiters = substr($input, 0, $firstDigitPos);
        if (strlen($delimiters) == 0) {
            $delimiters = $defaultDelimiters;
        } else {
            preg_match_all('~//(.*?)\n~', $delimiters, $delimiters);
            $delimiters = $delimiters[1][0];
            // Retrieve the delimiters between brackets
            preg_match_all("/\[(.*?)\]/", $delimiters, $matches);
            if ($matches[1]) {
                $delimiters = array_merge($defaultDelimiters, $matches[1]);
            } else {
                $delimiters = $defaultDelimiters;
            }
        }
        
        return Array($delimiters, $numbers);
    }

    public function multiexplode ($delimiters, $string) {
    //Example : $delimiters = array(',', '\n', '|', '%')
    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
    }
 
}

?>