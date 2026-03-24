<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class Login extends BaseController
{
    public function index()
    {
        return view('admin/login');
    }

    public function autenticar()
    {
        $model = new UsuarioModel();

        $email = $this->request->getPost('email');
        $senha = $this->request->getPost('senha');

        $usuario = $model->where('email', $email)->first();

        if ($usuario && password_verify($senha, $usuario['senha'])) {

            session()->set([
                'usuario_id' => $usuario['id'],
                'usuario_nome' => $usuario['nome'],
                'logado' => true
            ]);

            return redirect()->to('/admin/dashboard');
        }

        return redirect()->back()->with('erro', 'Email ou senha inválidos');
    }

    public function sair()
    {
        session()->destroy();
        return redirect()->to('/admin');
    }
}
