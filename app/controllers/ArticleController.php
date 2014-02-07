<?php

class ArticleController extends \BaseController {
    
    private $article;
    
    public function __construct(Article $article) {
        $this->article = $article;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $articles = $this->article->where('status', 1)->get();
        return View::make('admins.articles.index')
                ->with('articles', $articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admins.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $subject = Input::get('subject');
        $filename = camel_case($subject) . '.md';        
        $this->article->subject = $subject;
        $this->article->status = 1;
        $this->article->filename = $filename;
        $this->article->save();        
        File::put('markdown/' . $filename, Input::get('markdown'));
        
        //Set the session flash to note the user process is completed
        Session::flash('done', 'Artikel telah berjaya disimpan');
        
        return URL::route('admin.article.edit', array(camel_case($subject)));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
            //Refer Route name admin.detailartikel
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($param)
    {
        $content = MarkdownController::bukaArtikel($param, false);
        if($content === false)
            return App::abort(404);
        
        $subject = ucfirst(str_replace('_', ' ', snake_case($param)));
        
        return View::make('admins.articles.edit')
                ->with('path', $param)
                ->with('markdown', $content)
                ->with('subject', $subject);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($subject)
    {
        $subject = Input::get('subject');
        $filename = camel_case($subject) . '.md';
        $articles = $this->article->where('filename', Input::get('filename'))->first();
        
        $articles->subject = $subject;
        $articles->filename = $filename;
        $articles->status = 1;
        $articles->save();
        
        $filepath = 'markdown/' . $filename;
        $oldpath = 'markdown/' . Input::get('filename');
        File::delete($oldpath);
        File::put($filepath, Input::get('markdown'));
        
        //Set the session flash to note the user process is completed
        Session::flash('done', 'Artikel telah berjaya disimpan');
        
        return URL::route('admin.article.edit', array(camel_case($subject)));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $articles = $this->article->where('filename', Input::get('filename'))->first();
        $articles->status = 0;
        $articles->save();
        
        return URL::route('admin.article.index');
    }

}