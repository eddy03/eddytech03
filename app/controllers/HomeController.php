<?php

class HomeController extends BaseController {

    private $article;
    
    public function __construct(Article $article)
    {
        $this->article = $article;
    }
    
    public function showHomePage()
    {
        $articles = $this->article->where('status', 1)->get();
        return View::make('contents.homepage')
                ->with('articles', $articles);
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