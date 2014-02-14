<?php
/**
 * eddytech03.com website
 * 
 * @category Model Markdown
 * @author Edi Abdul Rahman <eddytech03@gmail.com>
 * 
 * Markdown definition and models
 */

use Michelf\MarkdownExtra as MarkdownExtras;

class Markdown extends MarkdownExtras {
    
    /**
     * Get the urls or the file, anda grab the file base on given url. If not found the file, return false;
     * 
     * @param string $urls
     * @param  boolean $autoParse Required the file to be parse
     * @return boolean|string
     */
    function readFile( $urls, $autoParse = true )
    {
        $path = Conf::markdownPath(true) . Conf::urlToFile($urls);
        
        if(!File::exists($path)) {
            return false;
        }
        
        return ($autoParse)? $this->defaultTransform(File::get($path)) : File::get($path);
    }
}