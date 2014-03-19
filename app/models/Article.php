<?php
/**
 * eddytech03.com website
 * 
 * @category Model Article
 * @author Edi Abdul Rahman <eddytech03@gmail.com>
 * 
 * Article database ORM and logic design
 */

class Article extends Eloquent {
    
    protected   $conf,
                $markdown;
    
    /**
     * Attribute for this class. PLEASE ENSURE IT NOT SAME WITH COLLUMN NAME ATTRIBUTE!
     * 
     * @var mixed
     */
    public      $pool,
                $filename,
                $fileFullPath,
                $content,
                $url;
    /**
     * Construct the class
     * 
     */
    public function __construct( )
    {
        $this->conf = new Conf();
        $this->markdown = new Markdown();
        $this->pool = $this->conf->markdownPath( true, false );
    }
    
    /**
     * Read the articles with give filename
     * 
     * @param string $name
     * @param boolean $autoparse
     * @return string
     */
    public function readArticle( $name, $autoparse = true )
    {
        return $this->markdown->readFile( $name, $autoparse );
    }
    
    /**
     * Initialize this class attribute with input from user. For more OOP styles
     * 
     * @return \Article
     */
    public function initSave()
    {
        $cleanURL = $this->conf->cleanURL( Input::get('urls') );
        $this->filename = $this->conf->urlToFile( $cleanURL );
        $this->url = $this->conf->removeExtension( $this->filename );
        $this->fileFullPath = $this->pool . DIRECTORY_SEPARATOR . $this->filename;
        
        $this->content = Input::get('markdown');
        
        return $this;
    }
    
    /**
     * Save the article to the markdown pool
     * 
     * @return boolean|array
     */
    public function saveArticleFile()
    {
        if(is_array( $this->checkPermission() )) {
            return array(
                'code' => '500',
                'message' => $this->pool . ' is not writeable!'
            );
        }
        
        if(is_array( $this->removeOldFile()->saveFile() )) {
            return array(
                'code' => '500',
                'message' => 'There was an error occur during saving the file'
            );
        }
        
        return true;
    }
    
    /**
     * Save article meta data to the database
     * 
     */
    public function saveToDB()
    {
        $article = (is_null(Input::get('articleID')))? new self() : $this->find(Input::get('articleID'));
        
        $article->subject = Input::get('subject');
        $article->status = (Input::get('status') == 'true')? 1 : 2;
        $article->snippet = Input::get('snippet');
        $article->urls = $this->url;
        
        $article->save();
    }
    
    /**
     * Save the article to file
     * 
     * @return boolean|array
     */
    private function saveFile()
    {
        if(!File::put($this->fileFullPath, $this->content)) {
            return array();
        }
        
        return false;
    }
    
    /**
     * Check if old file was already at markdown pool and delete it
     * 
     * @return \Article
     */
    private function removeOldFile()
    {
        if(File::exists($this->fileFullPath)) {
            File::delete($this->fileFullPath);
        }
        
        return $this;
    }
    
    /**
     * Check the markdown pool is writeable
     * 
     * @return boolean
     */
    private function checkPermission()
    {
        if(!File::isWritable($this->pool)) {
            return array();
        }
        
        return true;
    }
}