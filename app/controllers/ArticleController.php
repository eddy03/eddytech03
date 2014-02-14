<?php
/**
 * eddytech03.com website
 * 
 * @category Article module
 * @author Edi Abdul Rahman <eddytech03@gmail.com>
 * 
 * This is the article controller in RESOURCEFULL CONTROLLER
 * 
 */

class ArticleController extends \BaseController {
    
    /**
     * The articles database object
     * 
     * @var object
     */
    private $article;
    
    /**
     * Define the path were the articles was saved
     * 
     * @var string
     */
    private $path;
    
    /**
     * The configuration object
     * 
     * @var string
     */
    private $conf;
    
    /**
     * The markdown object
     * 
     * @var string
     */
    private $markdown;
    
    /**
     * Construct the class attribute details
     * 
     * @param Article $article
     */
    public function __construct(Article $article, Conf $conf, Markdown $md)
    {
        $this->beforeFilter('ajax', array(
            'only' => array('store', 'update', 'destroy')
        ));
        
        $this->article = $article;
        $this->conf = $conf;
        $this->markdown = $md;
        $this->path = $this->conf->markdownPath(true, false);
    }

    /**
     * Query the articles that doesn't status 0 from the database and return the view
     * 
     * @return Responses
     */
    public function index()
    {
        $articles = $this->article->where('status', '!=', 0)->orderBy('created_at', 'DESC')->get();
        return View::make('admins.articles.index')->withArticles($articles);
    }

    /**
     * Display the articles create view
     * 
     * @return Responses
     */
    public function create()
    {
        return View::make('admins.articles.create');
    }

    /**
     * Store the articles into the database. This method should be filter as AJAX
     * 
     * @return String
     */
    public function store()
    {
        $saveStat = $this->article->initSave()->saveArticleFile();
        
        //any error?
        if(is_array($saveStat)) {
            return Response::json($saveStat);
        }
        
        $this->article->saveToDB();
                
        //Redirect to edit page to prevent making the article twice
        return Response::json(array(
            'code' => '200',
            'message' => URL::route('admin.article.edit', array($this->article->url))
        ));
    }
    
    /**
     * Show the selected articles content
     * 
     * @param string $urls
     * @return Responses
     */
    public function show($urls)
    {
        $content = $this->markdown->readFile($urls);
        
        if( $content === false) {
            return App::abort(404);
        }
        
        $articles = $this->article->where('urls', $urls)->first();
        
        return View::make('admins.articles.show')
                ->withArticle($articles)
                ->withMarkdown($content);
    }

    /**
     * Edit the selected articles
     * 
     * @param string $param
     * @return Responses
     */
    public function edit($urls)
    {
        $content = $this->markdown->readFile($urls, false);
        
        if($content === false) {
            return App::abort(404);
        }
        
        $articles = $this->article->where('urls', $urls)->first();
        
        return View::make('admins.articles.edit')
                ->withArticle($articles)
                ->withMarkdown($content)
                ->withCondition('Ubah');
    }

    /**
     * Update the selected articles.  This method should be filter as AJAX
     * 
     * @param string $subject
     * @return Responses
     */
    public function update($subject)
    {
        $saveStat = $this->article->initSave()->saveArticleFile();
        
        //any error?
        if(is_array($saveStat)) {
            return Response::json($saveStat);
        }
        
        $this->article->saveToDB();
        
        //flush out the cache so user wont viewing the old articles
        Cache::forget('article_query');
        
        return Response::json(array(
            'code' => '200',
            'message' => 'Artikel updated'
        ));
    }
    
    /**
     * Delete (hide) the articles from being view to the website while keeping it in database. This method should be filter as AJAX
     * 
     * @param int $id
     * @return string
     */
    public function destroy($id)
    {
        $articles = $this->article->find(Input::get('aID'));
        $articles->status = 0;
        $articles->save();
        
        return URL::route('admin.article.index');        
    }
}