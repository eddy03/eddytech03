<?php

use Michelf\MarkdownExtra;

class MarkdownController extends \BaseController {
    
    public function preview()
    {
        return MarkdownExtra::defaultTransform(Input::get('markdown'));
    }
    
    public function bacaArtikel($articleName)
    {        
        $content = $this->bukaArtikel($articleName);
        if($content === false)
            return App::abort(404);
        
        $subject = ucfirst(str_replace('_', ' ', snake_case($articleName)));
        
        return View::make('admins.articles.show')
                ->with('path', $articleName)
                ->with('markdown', $content)
                ->with('subject', $subject);
    }
    
    static public function bukaArtikel($filename, $auto_parse = true) {
        $path = base_path() . DIRECTORY_SEPARATOR . 'markdown' . DIRECTORY_SEPARATOR . $filename . '.md';
        if(!File::exists($path))
            return false;
        return ($auto_parse)?
            MarkdownExtra::defaultTransform(File::get($path)) :
            File::get($path);
    }
}