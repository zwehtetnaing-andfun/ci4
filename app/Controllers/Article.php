<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Article extends BaseController
{
    
    public function index()
    {
        $articleModel = new \App\Models\Article();
        $articles = $articleModel->findAll();
        
        return view('articles/index',[
            'articles' => $articles
        ]);
    }

    public function create()
    {
        return view('articles/create');
    }

    public function store()
    {
        $articleModel = new \App\Models\Article();
        $articleModel->insert([
            "title" => $this->request->getPost('title'),
            'content' => $this->request->getPost('content')
        ]);

        return redirect()->to('/articles');
    }

    public function edit($id)
    {
        $articleModel = new \App\Models\Article();
        $article = $articleModel->find($id);

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
        ]);

        return redirect()->to('/articles');
    }

    public function delete($id)
    {
        $articleModel = new \App\Models\Article();
        $articleModel->delete($id);

        return redirect()->to('/articles');
    }
}
