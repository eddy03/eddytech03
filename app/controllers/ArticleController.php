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
        $this->article = $article;
        $this->path = base_path() . DIRECTORY_SEPARATOR . 'markdown';
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
        $filename = camel_case($subject) . '.md';
        
        $this->article->subject = $subject;
        $this->article->status = (Input::get('status') == 'true')? 1 : 2;
        $this->article->snippet = Input::get('snippet');
        $this->article->filename = $filename;
        $this->article->save();
        
        if(!File::isWritable($this->path))
            return 'error : Path is not writeable!' ;
        
        File::put($this->path . DIRECTORY_SEPARATOR . $filename, Input::get('markdown'));
        
        //Set the session flash to note the user process is completed
        Session::flash('done', 'Artikel telah berjaya disimpan');
        
        return URL::route('admin.article.edit', array(camel_case($subject)));
    }

    /**
     * Un-used resoucefull method, Refer Route name admin.detailartikel
     * 
     * @param int $id
     */
    public function show($id)
    {
            //Refer Route name admin.detailartikel
    }

    /**
     * Edit the selected articles
     * 
     * @todo This method will be having a lot of changes when to use fix URL for each articles selected
     * @param string $param
     * @return Responses
     */
    public function edit($param)
    {
        $articles = $this->article->where('filename', $param . '.md')->first(array('status', 'snippet'));
        
        $content = MarkdownController::bukaArtikel($param, false);
        if($content === false)
            return App::abort(404);
        
        $subject = ucfirst(str_replace('_', ' ', snake_case($param)));
        
        return View::make('admins.articles.edit')
                ->with('path', $param)
                ->with('articles', $articles)
                ->with('markdown', $content)
                ->with('subject', $subject);
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
        $filename = camel_case($subject) . '.md';
        $articles = $this->article->where('filename', Input::get('filename'))->first();
        
        $articles->subject = $subject;
        $articles->filename = $filename;
        $articles->status = (Input::get('status') == 'true')? 1 : 2;
        $articles->snippet = Input::get('snippet');
        $articles->save();
        
        $filepath = $this->path . DIRECTORY_SEPARATOR . $filename;
        $oldpath = $this->path . DIRECTORY_SEPARATOR . Input::get('filename');
        //Delete the old article
        File::delete($oldpath);
        //Create a new one
        File::put($filepath, Input::get('markdown'));
        
        //Set the session flash to note the user process is completed
        Session::flash('done', 'Artikel telah berjaya disimpan');
        
        return URL::route('admin.article.edit', array(camel_case($subject)));
    }
    
    /**
     * Delete (hide) the articles from being view to the website while keeping it in database
     * 
     * @param int $id
     * @return string
     */
    public function destroy($id)
    {
        $articles = $this->article->where('filename', Input::get('filename'))->first();
        $articles->status = 0;
        $articles->save();
        
        return URL::route('admin.article.index');
    }

}