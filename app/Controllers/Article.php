<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Article extends BaseController
{
    
    public function index()
    {
        $articleModel = new \App\Models\Article();
        $articles = $articleModel->findAll(); // get all articles
        
        return view('articles/index',[
            'articles' => $articles
        ]); // return view and passsing datas
    }

    public function create()
    {
        return view('articles/create'); // return create page
    }

    public function store()
    {
        $articleModel = new \App\Models\Article();
        $articleModel->insert([
            "title" => $this->request->getPost('title'),
            'content' => $this->request->getPost('content')
        ]); // insert datas

        return redirect()->to('/articles'); // redirect index page
    }

    public function edit($id)
    {
        $articleModel = new \App\Models\Article();
        $article = $articleModel->find($id); // get specific data

        return view('articles/edit',[
            "article" => $article
        ]);
    }

    public function update($id)
    {
        $articleModel = new \App\Models\Article();
        $articleModel->update($id,[
            "title" => $this->request->getPost('title'),
            "content" => $this->request->getPost('content')
        ]); // update datas

        return redirect()->to('/articles');
    }

    public function delete($id)
    {
        $articleModel = new \App\Models\Article();
        $articleModel->delete($id); // delete specific data

        return redirect()->to('/articles');
    }
}
