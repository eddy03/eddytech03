<?php
/**
 * eddytech03.com website
 * 
 * @category Model Conf
 * @author Edi Abdul Rahman <eddytech03@gmail.com>
 * 
 * website configuration setting
 */

class Conf {
    
    /**
     * Mardown file extension
     * 
     */
    const MD_EXTENSION = '.md';

    /**
     * Return the path to the markdown pool directory
     * 
     * @param boolean $absolutepath
     * @param boolean $trailingDir
     * @return string
     */
    static public function markdownPath( $absolutepath = false, $trailingDir = true ) {
        if($absolutepath) {
            if($trailingDir)
                return base_path() . DIRECTORY_SEPARATOR . 'markdown' . DIRECTORY_SEPARATOR;
            else
                return base_path() . DIRECTORY_SEPARATOR . 'markdown';            
        }
        else {
            if($trailingDir)
                return 'markdown' . DIRECTORY_SEPARATOR;
            else
                return 'markdown';
        }
    }
    
    /**
     * Generate the default filename base on given url
     * 
     * @param string $urls
     * @return string
     */
    static function urlToFile( $urls )
    {
        return camel_case($urls) . self::MD_EXTENSION;
    }
    
    /**
     * Clean the given url by remove non alphanumeric
     * 
     * @param string $urls
     * @return string
     */
    static function cleanURL( $urls )
    {
        return preg_replace('/[^\da-z]/i', '', $urls);
    }
    
    /**
     * Regain back URL from given filename
     * 
     * @param string $urls
     * @return string
     */
    static function removeExtension( $filename )
    {
        return str_replace(self::MD_EXTENSION, '', $filename);
    }
    
    /**
     * Just another helper to debug array content
     * 
     * @param array $array
     * @return string
     */
    static function debug( $array )
    {
        return '<pre>' . print_r($array, true) . '</pre>';
    }
}