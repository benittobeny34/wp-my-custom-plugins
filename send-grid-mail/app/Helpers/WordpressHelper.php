<?php

namespace Cartrabbit\Mail\Custom\App\Helpers;

defined('ABSPATH') or exit;

class WordpressHelper
{

    /**
     * Verify nonce
     *
     * @param string $nonce
     * @param string $action
     * @return false
     */
    public static function verifyNonce($nonce, $action = '')
    {
        if (empty($action)) {
            $action = '_postmark_nonce';
        }
        return (bool)wp_verify_nonce($nonce, $action);
    }

    /**
     * Format date
     *
     * @param string|int $date
     * @param string $format
     * @param bool $is_gmt
     * @return string
     */
    public static function formatDate($date, $format = 'date', $is_gmt = false)
    {
        if (is_numeric($date)) {
            $date = date('Y-m-d H:i:s', $date);
        }
        if (in_array($format, ['datetime', 'date', 'time'])) {
            $format = self::getFormat($format);
        }
        return $is_gmt ? get_date_from_gmt($date, $format) : date($format, strtotime($date));
    }
}
