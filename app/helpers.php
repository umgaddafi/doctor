<?php

if (!function_exists('mb_split')) {
    /**
     * Polyfill for mb_split when host PHP lacks native mbstring regular expressions.
     */
    function mb_split(string $pattern, string $string, int $limit = -1): array|false
    {
        $delimiter = '/';
        $escaped = str_replace($delimiter, '\\' . $delimiter, $pattern);
        return preg_split($delimiter . $escaped . $delimiter . 'u', $string, $limit);
    }
}
