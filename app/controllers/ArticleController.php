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
     * Construct the class attribute details
     * 
     * @param Article $article
     */
    public function __construct(Article $article)
    {
        $this->beforeFilter('ajax', array(
            'only' => array('store')
        ));
        
        $this->article = $article;
        $this->path = Conf::markdownPath(true, false);
    }

    /**
     * Query the articles that doesn't status 0 from the database and return the view
     * 
     * @return Responses
     */
    public function index()
    {
        $articles = $this->article->where('status', '!=', 0)->get();
        return View::make('admins.articles.index')
                ->with('articles', $articles);
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
     * @todo This method will be having a lot of changes when to use fix URL for each articles selected
     * @return String
     */
    public function store()
    {
        $subject = Input::get('subject');
        $urls = Input::get('urls');
        $snippet = Input::get('snippet');
        $status = Input::get('status');
        $content = Input::get('markdown');
        
        //cleanup the subject to make it as filename
        //$clean = preg_replace('~[^\p{L}\p{N}]++~u', '', $subject);        
        $filename = camel_case($urls) . '.md';
        
        $this->article->subject = $subject;
        $this->article->status = ($status == 'true')? 1 : 2;
        $this->article->snippet = $snippet;
        $this->article->urls = $urls;
        $this->article->save();
        
        if(!File::isWritable($this->path))
            return 'error : ' . $this->path . ' is not writeable!' ;
        
        File::put($this->path . DIRECTORY_SEPARATOR . $filename, $content);
        
        //Set the session flash to note the user process is completed
        Session::flash('done', 'Artikel telah berjaya disimpan');
        
        //Redirect to edit page to prevent making the article twice
        return URL::route('admin.article.edit', array($urls));
    }

    /**
     * Un-used resoucefull method, Refer Route name admin.detailartikel
     * 
     * @param int $id
     */
    public function show($urls)
    {
        $content = MarkdownController::bukaArtikel($urls);
        
        if($content === false) {
            return App::abort(404);
        }
        
        $articles = $this->article->where('urls', $urls)->first();
        
        return View::make('admins.articles.show')
                ->with('article', $articles)
                ->with('markdown', $content);
    }

    /**
     * Edit the selected articles
     * 
     * @todo This method will be having a lot of changes when to use fix URL for each articles selected
     * @param string $param
     * @return Responses
     */
    public function edit($urls)
    {
        $content = MarkdownController::bukaArtikel($urls, false);
        
        //The articles cannot be find
        if($content === false) {
            return App::abort(404);
        }
                
        //Grab the information from the database
        $articles = $this->article->where('urls', $urls)->first();
        
        return View::make('admins.articles.edit')
                ->with('path', $urls)
                ->with('articles', $articles)
                ->with('markdown', $content)
                ->withCondition('Ubah');
    }

    /**
     * Update the selected articles
     * 
     * @todo This method will be having a lot of changes when to use fix URL for each articles selected
     * @param string $subject
     * @return String
     */
    public function update($subject)
    {
        $subject = Input::get('subject');
        $urls = Input::get('urls');
        $status = Input::get('status');
        $snippet = Input::get('snippet');
        $markdown = Input::get('markdown');
        $aID = Input::get('articleID');
        
        $filename = camel_case($urls) . '.md';
                
        $articles = $this->article->find($aID);        
        $articles->subject = $subject;
        $articles->status = ($status == 'true')? 1 : 2;
        $articles->snippet = $snippet;
        $articles->save();
        
        $filepath = $this->path . DIRECTORY_SEPARATOR . $filename;
        
        //Delete the old article
        File::delete($filepath);
        //Create a new one
        File::put($filepath, $markdown);
        
        //Set the session flash to note the user process is completed
        Session::flash('done', 'Artikel telah berjaya disimpan');
        
        return URL::route('admin.article.edit', array($urls));
    }
    
    /**
     * Delete (hide) the articles from being view to the website while keeping it in database
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