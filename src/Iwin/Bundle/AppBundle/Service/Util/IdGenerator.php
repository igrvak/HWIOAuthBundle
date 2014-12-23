<?php
namespace Iwin\Bundle\AppBundle\Service\Util;

/**
 * Вспомогательный класс для генерации ID
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class IdGenerator
{
    /**
     * @param int $length
     * @return string
     */
    public static function getId($length = 40)
    {
        return substr(bin2hex(openssl_random_pseudo_bytes($length)), 5, $length);
    }
}