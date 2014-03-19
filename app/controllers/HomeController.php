<?php
/**
 * eddytech03.com website
 * 
 * @category Administrator module
 * @author Edi Abdul Rahman <eddytech03@gmail.com>
 * 
 * This is the home controller. 
 * 
 */

class HomeController extends BaseController {

    /**
     * The articles database object
     * 
     * @var object
     */
    private $article;
    
    /**
     * Construct the class attribute details
     * 
     * @param Article $article
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }
    
    /**
     * Show the home page (landing page) view
     * 
     * @return Responses
     */
    public function showHomePage()
    {
        return View::make('layouts.master');
    }
    
    /**
     * Grab the article from article pool
     * 
     * @param string $urls
     * @return string
     */
    public function readArtikel($urls)
    {
        return $this->article->readArticle($urls);
    }    
}