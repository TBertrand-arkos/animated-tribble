<?php

namespace Hackathon\LevelC;

class RotationString
{
    /**
     * @TODO ! BAM
     *
     * @param $s1
     * @param $s2
     *
     * @return bool|int
     */
    public static function isRotation($s1, $s2)
    {
        if (strlen($s1) != strlen($s2))
            return false;

        if (strlen($s1) == strlen($s2))
            $s1 = $s1 . $s1;

        if (strpos($s1, $s2) > 0)
            return true;
        else
            return false;
    }

    public static function isSubString($s1, $s2)
    {
        $pos = strpos($s1, $s2);

        return $pos;
    }
}
