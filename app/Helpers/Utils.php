<?php

namespace App\Helpers;

/**
 *
 * Custom helper class with some useful generic functions
 *
 */
class Utils {
    /* 
     * Function that format the user favorites in a easier way for the javascript to manipulate it
     *
     * @param mixed $user_favorites array with the users favorites to be formatted
     * @return string $formatted_favorites string with formatted user favorites
     */

    public static function formatFavorites($user_favorites = array()) {
        // String that will hold the formatted user favorites
        $formatted_favorites = "";

        // Loops trough the user favorites
        foreach ($user_favorites as $user_favorites) {
            $formatted_favorites .= $user_favorites->user->company . ", ";
        }

        return rtrim($formatted_favorites, ", ");
    }

    /*     
     * Function that converts minutes to hours
     *
     * @param  int $time the minutes
     * @return string       the minutes formated as hours
     */

    public static function convertMinutesToHours($minutes) {
        return date('H:i', mktime(0, $minutes));
    }

    /*
     * Function that converts minutes to hours
     *
     * @param  mixed  phone number
     * @return bool  true if number is valid
     */

    public static function validatePhone($string) {
        $numbersOnly = preg_replace('/[^0-9]+/', "", $string);
        $numberOfDigits = strlen($numbersOnly);
        if ($numberOfDigits == 7 or $numberOfDigits == 10) {
            return $numbersOnly;
        } else {
            return false;
        }
    }

}
