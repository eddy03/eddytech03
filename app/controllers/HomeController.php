<?php

class HomeController extends BaseController {

    public function showHomePage()
    {
        return View::make('contents.homepage');
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