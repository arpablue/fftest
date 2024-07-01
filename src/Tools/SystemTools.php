<?php


namespace ArpaBlue\FFTest\Tools;

/**
 * Class SystemTools
 * @package ArpaBlue\FFTest\Tools
 * It constains general methods to interact with the OS.
 */
class SystemTools
{
    /**
     * It return the current execution directory.
     * @return string It is the current execution directory.
     */
    public static function getCurrentDirectory()
    {
        return getcwd();
    }
    /**
     * It return the real path of a resource ( file or directory ), if the resource not exist then return null.
     * @param string $path It is the path of the file or directory.
     * @return false|string|null
     */
    public static function getAbsolutePath( $path )
    {
        if( $path === null )
        {
            return null;
        }
        $path = SystemTools::formatPath( $path );
        if( !file_exists( $path ))
        {
            return null;
        }
        return realPath( $path );
    }

    /**
     * It return the absolute path of a resource ( directory or file ) in the project.
     * @param string $path It is the path of a resource in the project.
     * @return string|null It is the absolute path of a resource in the project.
     */
    public static function getPrjResource( $path )
    {
        if( $path === null )
        {
            return null;
        }
        $path = SystemTools::formatPath( $path );
        $rpath = SystemTools::getCurrentDirectory().DIRECTORY_SEPARATOR.$path;
        return $rpath;
    }
    /**
     * It return the path according to the OS.
     * @param string $path It is the path of a file or directory.
     * @return string|null It is the path of the file.
     */
    public static function formatPath($path )
    {
        $res = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);
        return $res;
    }
    /**
     * It create the directories specified in the path. The method return true if the
     * directories has been created or if the directories exists.
     * @param string $directory It is the path of directories to be created.
     * @return bool It is false if is not possible create the directories.
     */
    public static function createDirectories( $directory )
    {
        if ( is_dir($directory) ) {
            return true;
        }
        if (mkdir($directory, 0777, true)) {
            return true;
        }
        return false;
    }
    /**
     * It return the directory path of a path or the reference to a file.
     * @param string $filePath It is the path of the file.
     * @return string|null It is the directory path of the file.
     */
    public static function getPathDirectory( $filePath )
    {
        if( $filePath === null )
        {
            return null;
        }
        return dirname($filePath);
    }
}