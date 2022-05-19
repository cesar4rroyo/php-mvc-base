<?php

class Pages extends Controller
{
    protected $folder = "pages";

    public function __construct()
    {
        $this->postModel = $this->model('Post');
        
    }


    public function index()
    {
        $data = [
            'title' => 'Welcome to the home page'
        ];
        $this->view($this->folder . '/' . 'index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About Us'
        ];
        $this->view($this->folder . '/' . 'about', $data);
    }
}