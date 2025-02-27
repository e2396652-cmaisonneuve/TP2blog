<?php

namespace App\Controllers;

use App\Models\User;
use App\Providers\View;
use App\Providers\Validator;

class UserController
{

    public function index()
    {
        $user = new User;
        $select = $user->select('name');
        return View::render('user/index', ['users' => $select]);
    }

    public function create()
    {
        return View::render('user/create');
    }

    public function show($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $user = new User;
            if ($selectId = $user->selectId($data['id'])) {
                return View::render('user/show', ['user' => $selectId]);
            } else {
                return View::render('error', ['msg' => 'user doesn t exist']);
            }
        }
        return View::render('error');
    }

    public function store($data = [])
    {
        $validator = new Validator;
        $validator->field('username', $data['username'])->min(3)->max(25);
        $validator->field('password', $data['password'])->max(45);
        $validator->field('name', $data['name'])->min(3)->max(25);
        $validator->field('email', $data['email'])->required()->max(45)->email();

        if ($validator->isSuccess()) {
            $user = new User;
            $insert = $user->insert($data);
            if ($insert) {
                return view::redirect('user/show?id=' . $insert);
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();
            return View::render('user/create', ['errors' => $errors, 'user' => $data]);
        }
    }

    public function edit($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $user = new User;
            if ($selectId = $user->selectId($data['id'])) {
                return View::render('user/edit', ['user' => $selectId]);
            } else {
                return View::render('error', ['msg' => "User doesn't exist"]);
            }
        }
        return View::render('error');
    }

    public function update($data = [], $get = [])
    {
        $validator = new Validator;
        $validator->field('username', $data['username'])->min(3)->max(25);
        $validator->field('password', $data['password'])->max(45);
        $validator->field('name', $data['name'])->min(3)->max(25);
        $validator->field('email', $data['email'])->required()->max(45)->email();

        if ($validator->isSuccess()) {
            $user = new User;
            $update = $user->update($data, $get['id']);
            if ($update) {
                return view::redirect('user/show?id=' . $get['id']);
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();
            //print_r($errors);
            return View::render('user/edit', ['errors' => $errors, 'user' => $data]);
        }
    }

    public function delete($data = [])
    {
        $id = $data['id'];
        $user = new User;
        $delete = $user->delete($id);
        if ($delete) {
            return view::redirect('users');
        } else {
            return View::render('error');
        }
    }
}
