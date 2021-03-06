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
     *
     * @return bool
     */
    function is_class_uses_deep($class, string $trait): bool
    {
        return in_array($trait, class_uses_recursive($class));
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

if (!function_exists('is_latest_mysql_version')) {
    /**
     * @return bool
     */
    function is_latest_mysql_version(): bool
    {
        $pdo = Illuminate\Support\Facades\DB::connection()->getPdo();
        return ($pdo->getAttribute(PDO::ATTR_DRIVER_NAME) === 'mysql') &&
            version_compare($pdo->getAttribute(PDO::ATTR_SERVER_VERSION), '5.7.8', 'ge');
    }
}

if (!function_exists('mime_types_by_extension')) {
    /**
     * @param  string  $type
     *
     * @return array
     */
    function mime_types_by_extension(string $type): array
    {
        $data = [
            'docx' => [
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.template',
                'application/vnd.ms-word.document.macroEnabled.12',
                'application/vnd.ms-word.template.macroEnabled.12',
            ],

            'xls' => [
                'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.template',
                'application/vnd.ms-excel.sheet.macroEnabled.12',
                'application/vnd.ms-excel.template.macroEnabled.12',
                'application/vnd.ms-excel.addin.macroEnabled.12',
                'application/vnd.ms-excel.sheet.binary.macroEnabled.12',
            ],

            'pdf' => [
                'application/pdf',
            ],
        ];

        return isset($data[$type]) ? $data[$type] : [];
    }
}

if (!function_exists('current_base_url')) {
    /**
     * @param  bool  $addCurrentScheme
     *
     * @return string
     */
    function current_base_url(bool $addCurrentScheme = false): string
    {
        $currentBaseUrl = parse_url(app('url')->to('/'))['host'];
        $tripleWWW = 'www.';

        $currentBaseUrl = substr($currentBaseUrl, 0, 4) == $tripleWWW
            ? str_replace($tripleWWW, '', $currentBaseUrl)
            : $currentBaseUrl;

        if ($addCurrentScheme) {
            return add_scheme_host($currentBaseUrl);
        }

        return $currentBaseUrl;
    }
}

if (!function_exists('add_scheme_host')) {
    /**
     * @param  string  $host
     *
     * @return string
     */
    function add_scheme_host(string $host): string
    {
        $scheme = parse_url(app('url')->to('/'))['scheme'];
        return "{$scheme}://{$host}";
    }
}
