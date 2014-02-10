<?php

class HomeController extends BaseController {

    private $article;
    
    public function __construct(Article $article)
    {
        $this->article = $article;
    }
    
    public function showHomePage()
    {
        $articles = $this->article->where('status', 1)->orderBy('created_at', 'DESC')->paginate(4, array('subject', 'filename', 'snippet', 'created_at'));
        return View::make('contents.homepage')
                ->with('articles', $articles);
    }
    
    public function bacaArtikel($artikel)
    {
        $articles = $this->article->where('filename', $artikel . '.md')->first(array('subject', 'created_at'));
        
        $content = MarkdownController::bukaArtikel($artikel);
        if($content === false)
            return App::abort(404);
        
        $subject = ucfirst(str_replace('_', ' ', snake_case($artikel)));
        
        return View::make('contents.articles')
                ->with('path', $artikel)
                ->with('articles', $articles)
                ->with('markdown', $content)
                ->with('subject', $subject);
    }
    
    public function showAboutMe()
    {
        return View::make('contents.about');
    }
    
    public function showProjectList()
    {
        return View::make('contents.project');
    }    
}