<?php

namespace App\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Models\Categorie;
use App\Providers\View;
use App\Providers\Validator;

class ArticleController
{

    public function index()
    {
        $article = new Article;
        $select = $article->select('title');
        return View::render('article/index', ['articles' => $select]);
    }

    public function create()
    {   
        $user = new User;
        $select = $user->Select();
        return View::render('article/create', ['users' => $select]);
        
    }

    public function show($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $article = new article;
            if ($selectId = $article->selectId($data['id'])) {
                return View::render('article/show', ['article' => $selectId]);
            } else {
                return View::render('error', ['msg' => 'Article doesn t exist']);
            }
        }
        return View::render('error');
    }

    public function store($data = [])
    {
        $validator = new Validator;
        $validator->field('title', $data['title'])->min(3)->max(80);
        $validator->field('content', $data['content'])->min(3);
        $validator->field('date', $data['date'])->required();

        if ($validator->isSuccess()) {
            $article = new article;
            $insert = $article->insert($data);
            if ($insert) {
                return view::redirect('article/show?id=' . $insert);
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();
            return View::render('article/create', ['errors' => $errors, 'article' => $data]);
        }
    }

   public function edit($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $article = new article;
            if ($selectId = $article->selectId($data['id'])) {
                return View::render('article/edit', ['article' => $selectId]);
            } else {
                return View::render('error', ['msg' => 'Article doesnt exist']);
            }
        }
        return View::render('error');
    }

    public function update($data = [], $get = [])
    {
        $validator = new Validator;
        $validator->field('title', $data['title'])->min(3)->max(80);
        $validator->field('content', $data['content'])->min(3);
        $validator->field('date', $data['date'])->required();

        if ($validator->isSuccess()) {
            $article = new article;
            $update = $article->update($data, $get['id']);
            if ($update) {
                return view::redirect('article/show?id=' . $get['id']);
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();
            return View::render('article/edit', ['errors' => $errors, 'article' => $data]);
        }
    }

    public function delete($data = [])
    {
        $id = $data['id'];
        $article = new article;
        $delete = $article->delete($id);
        if ($delete) {
            return view::redirect('articles');
        } else {
            return View::render('error');
        }
    }
}
