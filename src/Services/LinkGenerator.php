<?php
namespace App\Services;

class LinkGenerator {

    public function generate(string $str)
    {
        static $map = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $hash = \bcadd(sprintf('%u',crc32($str)) , 0x100000000);
        $str = "";
        do
        {
            $str = $map[bcmod($hash, 62) ] . $str;
            $hash = bcdiv($hash, 62);
        }
        while ($hash >= 1);
        return $str;
    }
}