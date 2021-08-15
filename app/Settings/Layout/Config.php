<?php

/**
 * Set styles and scripts
 */

namespace Settings\Layout;

use Framework\Request\Route;
use Settings\Layout\Validator\ConfigLinksValidatorComposite;
use Settings\Layout\Validator\ConfigScriptsValidatorComposite;

class Config
{
    private static $localStyles = [];

    private static $localScripts = [];

    private static $dataStyles = [];

    private static $dataScripts = [];

    public static function getGlobalStyles(): array
    {
        return [
            [
                'href' => 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css',
                'rel' => 'stylesheet',
                'integrity' => 'sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x',
                'crossorigin' => 'anonymous',
            ],
            [
                'href' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css',
                'rel' => 'stylesheet',
            ],
            [
                'href_custom' => '/css/style.css',
                'rel' => 'stylesheet',
                'type' => "text/css",
            ]
        ];
    }

    public static function getGlobalScripts(): array
    {
        return [
            ['src_custom' => '/js/script.js'],
            ['src_custom' => '/js/slider.js'],
            ['src_custom' => '/js/input.js'],
            ['src_custom' => '/js/upload.jss'],
            [
                'src' => 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js',
                'integrity' => 'sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4',
                'crossorigin' => 'anonymous'
            ],
        ];
    }

    public static function setLocalStyles($href, $rel = null, $type = null, $integrity = null, $crossorigin = null, $isCustom = true)
    {
        if (!is_array($href)) {
            $href = [
                $isCustom ? 'href_custom' : 'href' => $href,
                'rel' => $rel,
            ];

            $type !== null ? $href['type'] = $type : '';
            $integrity !== null ? $href['integrity'] = $integrity : '';
            $crossorigin !== null ? $href['crossorigin'] = $crossorigin : '';
        }

        array_push(self::$localStyles, $href);
    }

    public static function setLocalScripts($src, $integrity = null, $crossorigin = null, $isCustom = true)
    {
        if (!is_array($src)) {
            $src = [
                $isCustom ? 'src_custom' : 'src' => $src,
            ];

            $integrity !== null ? $src['integrity'] = $integrity : '';
            $crossorigin !== null ? $src['crossorigin'] = $crossorigin : '';
        }

        array_push(self::$localScripts, $src);
    }

    public static function getLinks(): array
    {
        $styles = array_merge(self::$localStyles, self::getGlobalStyles());

        foreach ($styles as $body) {
            if (!$body['href'] && !$body['href_custom'] || $body['href'] == '' && $body['href_custom'] == '') {
                continue;
            }

            $body['href_custom'] ? $body['href_custom'] = Route::getBasePath() . $body['href_custom'] : '';

            $validator = new ConfigLinksValidatorComposite();

            self::$dataStyles[] = sprintf(
                '<link %s >',
                $validator->validate($body)
            );
        }

        return self::$dataStyles;
    }

    public static function getScripts(): array
    {
        $scripts = array_merge(self::$localScripts, self::getGlobalScripts());

        foreach ($scripts as $body) {
            if (!$body['src'] && !$body['src_custom'] || $body['src'] == '' && $body['src_custom'] == '') {
                continue;
            }


            $body['src_custom'] ? $body['src_custom'] = Route::getBasePath() . $body['src_custom'] : '';

            $validator = new ConfigScriptsValidatorComposite();

            self::$dataScripts[] = sprintf(
                '<script %s ></script>',
                $validator->validate($body)
            );
        }

        return self::$dataScripts;
    }
}