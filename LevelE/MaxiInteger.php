<?php

namespace Hackathon\LevelE;

class MaxiInteger
{
    private $value;
    private $reverse;

    public function __construct($value)
    {
        $this->setValue($value);
    }

    /**
     * @FIX : CAN BE UPDATED
     *
     * @param MaxiInteger $other
     * @return $this|MaxiInteger
     */
    public function add(MaxiInteger $other)
    {
        if (is_null($other)) {
            return $this;
        }

        /**
         * You can delete this part of the code
         */
        $maxLength = max(strlen($this->getValue()), strlen($other->getValue()));
        if ($maxLength) {
            $other = $other->fillWithZero($maxLength);
            $this->setValue($this->fillWithZero($maxLength)->getValue());
        }

        return $this->realSum($this, $other);
    }

    /**
     * @TODO
     *
     * @param MaxiInteger $a
     * @param MaxiInteger $b
     * @return MaxiInteger
     */
    private function realSum($a, $b)
    {
        $a_bis = $a->reverse;
        $b_bis = $b->reverse;
        $retenue = 0;
        $res = "";

        for ($i = 0; $i < strlen($a_bis); $i++) {
            $sum = $a_bis[$i] + $b_bis[$i] + $retenue;
            $retenue = 0;
            if ($sum > 9) {
                $sum -= 10;
                $retenue = 1;
            }
            $res .= $sum;
        }

        if ($retenue) {
            $res .= $retenue;
        }

        return new MaxiInteger(strrev($res));
    }

    private function setValue($value)
    {
        $this->value = $value;
        $this->reverse = $this->createReverseValue($value);
    }

    public function getValue()
    {
        return $this->value;
    }

    private function getNthOfMaxiInteger($n)
    {
        return $this->value[$n];
    }
    private function createReverseValue($value)
    {
        return strrev($value);
    }

    private function fillWithZero($totalLength)
    {
        return new self(strrev(str_pad($this->reverse, $totalLength, '0')));
    }
}
