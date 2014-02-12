<?php
/**
 * eddytech03.com website
 * 
 * @category Administrator module
 * @author Edi Abdul Rahman <eddytech03@gmail.com>
 * 
 * This is the markdown controller. Control all markdown passing
 * 
 */

use Michelf\MarkdownExtra;

class MarkdownController extends \BaseController {
    
    /**
     * Parse the markdown template to HTML template
     * 
     * @return string
     */
    public function preview()
    {
        return MarkdownExtra::defaultTransform(Input::get('markdown'));
    }
    
    /**
     * Show the articles from the markdown article pool
     * 
     * @param string $articleName
     * @return Responses
     */
    public function bacaArtikel($articleName)
    {        
        $content = $this->bukaArtikel($articleName);
        if($content === false) {
            return App::abort(404);
        }
        
        $subject = ucfirst(str_replace('_', ' ', snake_case($articleName)));
        
        return View::make('admins.articles.show')
                ->with('path', $articleName)
                ->with('markdown', $content)
                ->with('subject', $subject);
    }
    
    /**
     * Get the markdown file. either parse it (by sending true to second argument) or not
     * 
     * @param string $filename
     * @param boolean $auto_parse
     * @return mixed
     */
    static public function bukaArtikel($filename, $auto_parse = true) {
        $path = base_path() . DIRECTORY_SEPARATOR . 'markdown' . DIRECTORY_SEPARATOR . $filename . '.md';
        if(!File::exists($path))
            return false;
        return ($auto_parse)?
            MarkdownExtra::defaultTransform(File::get($path)) :
            File::get($path);
    }
}