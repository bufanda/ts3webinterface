<?php
/**
 * Smarty plugin
 * 
 * @package Smarty
 * @subpackage PluginsModifier
 */

/**
 * Smarty date_format modifier plugin
 * 
 * Type:     modifier<br>
 * Name:     date_format<br>
 * Purpose:  format datestamps via strftime<br>
 * Input:<br>
 *          - string: input date string
 *          - format: strftime format for output
 *          - default_date: default date if $string is empty
 * 
 * @link http://smarty.php.net/manual/en/language.modifier.date.format.php date_format (Smarty online manual)
 * @author Monte Ohrt <monte at ohrt dot com> 
 * @param string $ 
 * @param string $ 
 * @param string $ 
 * @return string |void
 * @uses smarty_make_timestamp()
 */
function smarty_modifier_date_format($string, $format = SMARTY_RESOURCE_DATE_FORMAT, $default_date = '',$formatter='auto')
{
    /**
    * Include the {@link shared.make_timestamp.php} plugin
    */
    require_once(SMARTY_PLUGINS_DIR . 'shared.make_timestamp.php');
    if ($string != '') {
        $timestamp = smarty_make_timestamp($string);
    } elseif ($default_date != '') {
        $timestamp = smarty_make_timestamp($default_date);
    } else {
        return;
    } 
    // PHP 8.1+ Compatibility: Replace strftime with date
    if ($format === '%d.%m.%Y - %H:%M:%S') {
        $format = 'd.m.Y - H:i:s';
    } elseif ($format === '%Y-%m-%d') {
        $format = 'Y-m-d';
    } else {
        // Fallback simple conversion for common formats
        $format = str_replace(
            array('%d', '%m', '%Y', '%H', '%M', '%S', '%y', '%b', '%e', '%l', '%p', '%I'),
            array('d', 'm', 'Y', 'H', 'i', 's', 'y', 'M', 'j', 'h', 'A', 'h'),
            $format
        );
    }
    
    return date($format, $timestamp);
}

?>