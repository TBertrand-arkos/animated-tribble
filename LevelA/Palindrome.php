<?php

namespace Hackathon\LevelA;

class Palindrome
{
    private $str;

    public function __construct($str)
    {
        $this->str = $str;
    }

    /**
     * This function creates a palindrome with his $str attributes
     * If $str is abc then this function return abccba
     *
     * @TODO
     * @return string
     */
    public function generatePalindrome()
    {
        $encoding = mb_detect_encoding($this->str);
    
        $length   = mb_strlen($this->str, $encoding);
        $reversed = '';
        while ($length-- > 0) {
            $reversed .= mb_substr($this->str, $length, 1, $encoding);
        }
    
        return $this->str . $reversed;
    }
}
