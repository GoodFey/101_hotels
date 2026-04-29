<?php

namespace App\Controllers;

use App\Models\CommentModel;

class Comments extends BaseController
{
    public function index(): string
    {
        $commentModel = new CommentModel();
        
        $page = $this->request->getGet('page') ?? 1;
        $perPage = 3;
        
        $comments = $commentModel
            ->orderBy('id', 'DESC')
            ->paginate($perPage, 'comments', $page);
        
        $pager = $commentModel->pager;
        
        return view('comments/index', [
            'comments' => $comments,
            'pager' => $pager
        ]);
    }
    
    public function store(): \CodeIgniter\HTTP\ResponseInterface
    {
        $commentModel = new CommentModel();
        
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name'  => 'required|valid_email',
            'text'  => 'required|min_length[5]',
            'date'  => 'required'
        ]);
        
        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $validation->getErrors()
            ]);
        }
        
        $id = $commentModel->insert([
            'name' => $this->request->getPost('name'),
            'text' => $this->request->getPost('text'),
            'date' => $this->request->getPost('date'),
            'created_at' => date('Y-m-d H:i:s')
        ]);
        
        $comment = $commentModel->find($id);
        
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Комментарий добавлен!',
            'comment' => $comment
        ]);
    }
    
    public function delete($id = null)
    {
        $commentModel = new CommentModel();
        
        if (!$id || !$commentModel->find($id)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Комментарий не найден'
            ], 404);
        }
        
        $commentModel->delete($id);
        
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Комментарий удален!'
        ]);
    }
}

