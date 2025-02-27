<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Models\Article;
use App\Models\User;
use App\Providers\View;
use App\Providers\Validator;

class CommentController
{

    public function index()
    {
        $comment = new Comment;
        $select = $comment->select('id');
        return View::render('comment/index', ['comments' => $select]);
    }

    public function create()
    {   
        $user = new User;
        $select = $user->Select();
        return View::render('comment/create', ['users' => $select]);
        
    }

    public function show($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $comment = new Comment;
            if ($selectId = $comment->selectId($data['id'])) {
                return View::render('comment/show', ['comment' => $selectId]);
            } else {
                return View::render('error', ['msg' => 'Comment doesn t exist']);
            }
        }
        return View::render('error');
    }

    public function store($data = [])
    {
        $validator = new Validator;
        $validator->field('message', $data['content'])->required()->min(3);
        $validator->field('date', $data['email'])->required();
        //O QUE FAZ COM CHAVE ESTRANGEIRA?

        if ($validator->isSuccess()) {
            $comment = new comment;
            $insert = $comment->insert($data);
            if ($insert) {
                return view::redirect('comment/show?id=' . $insert);
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();
            return View::render('comment/create', ['errors' => $errors, 'comment' => $data]);
        }
    }

    public function edit($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $comment = new comment;
            if ($selectId = $comment->selectId($data['id'])) {
                return View::render('comment/edit', ['comment' => $selectId]);
            } else {
                return View::render('error', ['msg' => "comment doesn't exist"]);
            }
        }
        return View::render('error');
    }

    public function update($data = [], $get = [])
    {
        $validator = new Validator;
        $validator->field('message', $data['content'])->required()->min(3);
        $validator->field('date', $data['email'])->required();

        if ($validator->isSuccess()) {
            $comment = new comment;
            $update = $comment->update($data, $get['id']);
            if ($update) {
                return view::redirect('comment/show?id=' . $get['id']);
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();
            return View::render('comment/edit', ['errors' => $errors, 'comment' => $data]);
        }
    }

    public function delete($data = [])
    {
        $id = $data['id'];
        $comment = new Comment;
        $delete = $comment->delete($id);
        if ($delete) {
            return view::redirect('comments');
        } else {
            return View::render('error');
        }
    }
}
