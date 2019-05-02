<?php
namespace Ziki\Core;

class FileSystem
{
    /**
     * Create directory if not existing
     */
    public static function makeDir($path)
    {
        if (!file_exists($path)) {
            $unmask = unmask(0);
            $return = mkdir($path, true);
            unmask($unmask);
            return $return;
        }
    }
    /**
     * write content to a file 
     * and create a directory if needed
     */
    public static function write($file, $content)
    {
        self::makeDir(dirname($file));
        if (!file_exists($file)) {
            touch($file);
            chmod($file, 0644);
        }
        if (is_writable($file)) {
            return file_put_contents($file, $content);
        }
    }
    /**
     * read content from file
     */
    public static function read($file)
    {
        if (is_readable($file)) {
            $content = file_get_contents($file, true);
            return $content;
        }
    }
}
