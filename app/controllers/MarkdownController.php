<?php

use Michelf\MarkdownExtra;

class MarkdownController extends \BaseController {
    
    public function preview()
    {
        return MarkdownExtra::defaultTransform(Input::get('markdown'));
    }
    
    public function bacaArtikel($param)
    {
        $content = $this->bukaArtikel($param);
        if($content === false)
            return App::abort(404);
        
        $subject = ucfirst(str_replace('_', ' ', snake_case($param)));
        
        return View::make('admins.articles.show')
                ->with('path', $param)
                ->with('markdown', $content)
                ->with('subject', $subject);
    }
    
    static public function bukaArtikel($filename, $auto_parse = true) {
        $path = 'markdown/' . $filename . '.md';
        if(!File::exists($path))
            return false;
        return ($auto_parse)?
            MarkdownExtra::defaultTransform(File::get($path)) :
            File::get($path);
    }
}