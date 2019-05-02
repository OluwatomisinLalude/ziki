<?php
namespace Ziki\Core;

use Ziki\Core\FileSystem;

class Setting {
    /**
     * This function will get the auth details from specified url
     */
    
    public static function getSetting()
    {
        
        //Get data from existing json file   
        $settingDir = "./src/config/app.json";     
        $content = FileSystem::read($settingDir);       

        if (!$content)
            return false;
        
        // converts json data into array
        $json_data = json_decode($content, true);
        
        //return setting data
        return $json_data; 
            
    }

    public static function updateSetting($field, $value)
    {
        //Get data from existing json file   
        $settingDir = "./src/config/app.json";     
        $content = FileSystem::read($settingDir); 

        if (!$content)
            return false;

         // converts json data into array
         $json_data = json_decode($content, true);
        
        //update field if exist or add if not exist
        $json_data[$field] = $value; 

        //write the new update file
        $isSave = self::writeJson($settingDir, $json_data);
        return $isSave ? json_decode(FileSystem::read($settingDir), true) : $isSave;
    }

    public static function writeJson($file, $content)
    {
        //open file
        $file = fopen($file,'w+');

        //convert json back to json encoded string
        $json = json_encode($content);

        if(fwrite($file, $json)){
            fclose($file);
            return true;
        }
        return false;
    }

}
