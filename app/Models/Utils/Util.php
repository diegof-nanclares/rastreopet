<?php

namespace Models\Utils;

/**
 * Class Util
 * @package Models\User
 */
class Util
{
    public static function getBaseUrl()
    {
        $protocol = true || isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $host = 'rastreopet.com';//$_SERVER['HTTP_HOST'];//'rastreopet.com';//$_SERVER['REMOTE_ADDR']; //$_SERVER['HTTP_HOST'];
        $baseUrl = $protocol . '://' . $host;
        return  $baseUrl;
    }

    public static function getMediaUrl(string $subfolder = '')
    {
        return  self::getBaseUrl() . dirname($_SERVER['PHP_SELF']) . '/static/img/' . $subfolder;
    }

    public static function generateSafePassword($password) {
        $options = [
            'cost' => 12, // number of times to apply it
        ];
        $hash = password_hash($password, PASSWORD_BCRYPT, $options);
        return $hash;
    }

    public static function getImageUrl($imageName, $subtree = '') {
        return self::getBaseUrl() . dirname($_SERVER['PHP_SELF']) . '/static/img/' . ($subtree ? $subtree . '/' : '' ) .  $imageName;
    }

    public static function getCssUrl(string $fileName, string $subfolder = '')
    {
        return  self::getBaseUrl() . '/app/Assets/css/' . ($subfolder ? $subfolder . '/' : '' ).  $fileName . '.css';
    }

    public static function getDocUrl($name, $subtree = '') {
        return  self::getBaseUrl() . '/app/Assets/docs/' . $subtree . '/' . $name ;
    }

    public static function getJsUrl(string $fileName, string $subfolder = '')
    {
        return  self::getBaseUrl() . '/app/Assets/js/' . $subfolder . '/' . $fileName . '.js';
    }

    public static function getTemplateContents($fileName, $subfolder,  $vars = []): string
    {
        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ]);

        $rawContent = file_get_contents( self::getBaseUrl() . '/app/Email/Templates/' . $subfolder  . $fileName . '.phtml', false, $context);
        if($rawContent) {
            foreach ($vars as $key => $var) {
                $rawContent = str_replace( '{{' . $key . '}}', $var, $rawContent);
            }
        }

        return $rawContent;
    }

    public static function formatDateTimeFull($dateTime) {
        $dateTime = new \DateTime($dateTime);
        $months = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];

        $day = $dateTime->format('d');
        $month = $months[(int)$dateTime->format('m')];
        $year = $dateTime->format('Y');
        $time = $dateTime->format('h:i a');
        return "$day $month $year, $time";
    }

    public static function formatNumberCurrency($number) {
        return number_format($number, 0, ",", ".");
    }
}
