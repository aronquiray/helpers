<?php

if (!function_exists('test_file_path')) {
    /**
     * @param  string  $filePath
     *
     * @return string
     * @codeCoverageIgnore
     */
    function test_file_path(string $filePath)
    {
        return base_path('test_default_files'.DIRECTORY_SEPARATOR.$filePath);
    }
}

if (!function_exists('is_class_uses_deep')) {
    /**
     * @param $class
     * @param  string  $trait
     * @param  bool  $autoload
     *
     * @return bool
     */
    function is_class_uses_deep($class, string $trait, $autoload = true): bool
    {
        $traits = [];

        do {
            $traits = array_merge(class_uses($class, $autoload), $traits);
        } while ($class = get_parent_class($class));

        $traits = array_unique($traits);

        return in_array($trait, $traits);
    }
}

if (!function_exists('dummy_image')) {
    /**
     * @param  int  $width
     * @param  int  $height
     * @param  null  $text
     * @param  string  $bg
     * @param  string  $fg
     *
     * @return string
     */
    function dummy_image($width = 600, $height = 400, $text = null, $bg = 'f6de3d', $fg = '007ac3'): string
    {
        if (is_null($text)) {
            $text = app('config')->get('app.name');
        }
        return "https://dummyimage.com/{$width}x{$height}/{$bg}/{$fg}&text={$text}";
    }
}

