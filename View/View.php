<?php

namespace View;

class View
{
    public static function render($path, $data = [])
    {
        if (!empty($data))
            extract($data);
        require_once __DIR__ . '/' . $path;
    }
}
