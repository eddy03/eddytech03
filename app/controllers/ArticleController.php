<?php

class ArticleController extends \BaseController {
    
    private $article,
            $path;
    
    public function __construct(Article $article)
    {
        $this->article = $article;
        $this->path = 'markdown';
    }

    public function index()
    {
        $articles = $this->article->where('status', '!=', 0)->get();
        return View::make('admins.articles.index')
                ->with('articles', $articles);
    }

    public function create()
    {
        return View::make('admins.articles.create');
    }

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

    public function show($id)
    {
            //Refer Route name admin.detailartikel
    }

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
        File::delete($oldpath);
        File::put($filepath, Input::get('markdown'));
        
        //Set the session flash to note the user process is completed
        Session::flash('done', 'Artikel telah berjaya disimpan');
        
        return URL::route('admin.article.edit', array(camel_case($subject)));
    }
    
    public function destroy($id)
    {
        $articles = $this->article->where('filename', Input::get('filename'))->first();
        $articles->status = 0;
        $articles->save();
        
        return URL::route('admin.article.index');
    }

}