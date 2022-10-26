<?php

namespace Hackathon\LevelK;

use Error;

class Brute
{
    private $hash;
    public $origin;
    private $method; // md5 - crc32 - base64 - sha1

    public function __construct($hash)
    {
        $this->hash = $hash;
    }

    /**
     * @TODO :
     *
     * Cette méthode essaye de trouver par la force à quel mot de 4 lettres correspond ce hash.
     * Sachant que nous ne connaissons pas le hash (enfin si... il suffit de regarder les commentaires de l'attribut privé $methode.
     */
    public function force()
    {
        $methods = array('md5', 'crc32', 'base64', 'sha1');
        for ($m = 0; $m < count($methods); $m++) {
            $str = 'aaaa';
            $this->method = $methods[$m];
            while ($str !== 'zzzz') {
                if ($this->method === 'md5') {
                    if (md5($str) === $this->hash) {
                        $this->origin = $str;
                        return;
                    }
                } elseif ($this->method === 'crc32') {
                    if (crc32($str) == $this->hash) {
                        $this->origin = $str;
                        return;
                    }
                } elseif ($this->method === 'base64') {
                    if (base64_encode($str) === $this->hash) {
                        $this->origin = $str;
                        return;
                    }
                } else {
                    if (sha1($str) === $this->hash) {
                        $this->origin = $str;
                        return;
                    }
                }
                $str++;
            }
        }
    }
}
