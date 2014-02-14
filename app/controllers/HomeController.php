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
        $articles = $this->article->where('status', 1)->orderBy('created_at', 'DESC')->paginate(4, array('subject', 'urls', 'snippet', 'created_at'));
        return View::make('contents.homepage')
                ->withArticles($articles);
    }
    
    /**
     * Show the articles view
     * 
     * @param string $artikel
     * @return Responses
     */
    public function bacaArtikel($urls)
    {
        $content = MarkdownController::bukaArtikel($urls);        
        if($content === false) {
            return App::abort(404);
        }
        
        $articles = $this->article->where('urls', $urls)->remember(30, 'article_query')->first(array('subject', 'urls', 'created_at'));
        return View::make('contents.articles')
                ->with('articles', $articles)
                ->with('markdown', $content);
    }
    
    /**
     * Show the about me page view
     * 
     * @return Responses
     */
    public function showAboutMe()
    {
        return View::make('contents.about');
    }
    
    /**
     * Show the project list view
     * 
     * @return Responses
     */
    public function showProjectList()
    {
        return View::make('contents.project');
    }
    
    public function showChangelog()
    {
        return View::make('contents.changelog');
    }
}