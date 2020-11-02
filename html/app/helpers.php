<?php

if (!function_exists('mix')) {
    function mix($path)
    {
        $mixManifestFile = base_path('public/mix-manifest.json');

        if (!is_file($mixManifestFile)) {
            return $path;
        }

        $mixManifest = json_decode(file_get_contents($mixManifestFile), true);

        return (isset($mixManifest[$path])) ? $mixManifest[$path] : $path;
    }
}
