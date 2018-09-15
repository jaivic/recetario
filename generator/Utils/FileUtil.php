<?php

namespace generator\Utils;

class FileUtil
{
    public static function createFile($path, $fileName, $contents)
    {
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        $path = $path.$fileName;
//dd($path);
        file_put_contents($path, $contents);
    }

    public static function createDirectoryIfNotExist($path, $replace = false)
    {
        if (file_exists($path) && $replace) {
            rmdir($path);
        }

        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }
    }
    public  function RecursivodeleteDir($dir){
        $files=[];
        $dirs=[];
        if (is_dir($dir)) {
            if($openDir = opendir($dir))
            {
                while($readDir = @readdir($openDir))
                {
                    if($readDir != "." && $readDir != "..")
                    {
                        if(is_dir($dir."/".$readDir))
                        {
                            $dirs[] = $dir."/".$readDir ;
                        }
                        else
                        {
                            
                            $files[] = $dir."/".$readDir ; 
                        }
                    }
                }
            }
        }
      
        foreach($files as $file)
        {
            unlink($file) ;
        }
        foreach($dirs as $recurso)
        {
            $this->deleteDir($recurso) ;
        }
        
        if (is_dir($dir)) {
            rmdir($dir) ;
        }
    }
    public static function deleteDir($path)
    {
        (new FileUtil)->RecursivodeleteDir($path);
    }
    public static function deleteFile($path, $fileName)
    {
        if (file_exists($path.$fileName)) {
            return unlink($path.$fileName);
        }

        return false;
    }
}
