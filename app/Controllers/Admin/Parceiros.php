<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ParceiroModel;

class Parceiros extends BaseController
{
    private ParceiroModel $model;

    public function __construct()
    {
        $this->model = new ParceiroModel();
        helper(['form', 'parceiros']);
    }

    public function index()
    {
        return view('admin/parceiros/index', [
            'parceiros' => $this->model
                ->orderBy('ordem', 'ASC')
                ->orderBy('nome', 'ASC')
                ->paginate(15),
            'pager' => $this->model->pager,
        ]);
    }

    public function criar()
    {
        return view('admin/parceiros/create', [
            'parceiro' => null,
            'errors' => session('errors') ?? [],
        ]);
    }

    public function salvar()
    {
        $rules = $this->rules(true);

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->insert($this->payload());
        $this->limparCacheHome();

        return redirect()->to('/admin/parceiros')->with('success', 'Parceiro cadastrado com sucesso.');
    }

    public function editar($id)
    {
        $parceiro = $this->model->find($id);

        if (! $parceiro) {
            return redirect()->to('/admin/parceiros')->with('error', 'Parceiro não encontrado.');
        }

        return view('admin/parceiros/edit', [
            'parceiro' => $parceiro,
            'errors' => session('errors') ?? [],
        ]);
    }

    public function atualizar($id)
    {
        $parceiro = $this->model->find($id);

        if (! $parceiro) {
            return redirect()->to('/admin/parceiros')->with('error', 'Parceiro não encontrado.');
        }

        $rules = $this->rules(false);

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->update($id, $this->payload($parceiro));
        $this->limparCacheHome();

        return redirect()->to('/admin/parceiros')->with('success', 'Parceiro atualizado com sucesso.');
    }

    public function excluir($id)
    {
        $parceiro = $this->model->find($id);

        if ($parceiro) {
            $this->removerLogo($parceiro['logo'] ?? null);
            $this->model->delete($id);
            $this->limparCacheHome();
        }

        return redirect()->to('/admin/parceiros')->with('success', 'Parceiro excluído com sucesso.');
    }

    public function toggle($id)
    {
        $parceiro = $this->model->find($id);

        if (! $parceiro) {
            return redirect()->to('/admin/parceiros')->with('error', 'Parceiro não encontrado.');
        }

        $this->model->update($id, ['ativo' => (int) ! (bool) $parceiro['ativo']]);
        $this->limparCacheHome();

        return redirect()->to('/admin/parceiros')->with('success', 'Status atualizado com sucesso.');
    }

    private function rules(bool $logoObrigatoria): array
    {
        $arquivo = $this->request->getFile('logo');
        $logoRules = 'permit_empty';

        if ($logoObrigatoria || ($arquivo && $arquivo->getError() !== UPLOAD_ERR_NO_FILE)) {
            $logoRules = implode('|', [
                $logoObrigatoria ? 'uploaded[logo]' : 'permit_empty',
                'is_image[logo]',
                'mime_in[logo,image/jpg,image/jpeg,image/png,image/webp]',
                'max_size[logo,2048]',
            ]);
        }

        return [
            'nome' => 'required|min_length[2]|max_length[255]',
            'descricao' => 'permit_empty',
            'site_url' => 'permit_empty|valid_url_strict|max_length[255]',
            'instagram_url' => 'permit_empty|valid_url_strict|max_length[255]',
            'tipo' => 'required|in_list[premium,normal]',
            'ordem' => 'permit_empty|integer',
            'ativo' => 'permit_empty|in_list[0,1]',
            'logo' => $logoRules,
        ];
    }

    private function payload(?array $parceiroAtual = null): array
    {
        $logo = $this->salvarLogo($parceiroAtual['logo'] ?? null);

        return [
            'nome' => trim((string) $this->request->getPost('nome')),
            'descricao' => trim((string) $this->request->getPost('descricao')) ?: null,
            'logo' => $logo,
            'site_url' => trim((string) $this->request->getPost('site_url')) ?: null,
            'instagram_url' => trim((string) $this->request->getPost('instagram_url')) ?: null,
            'tipo' => $this->request->getPost('tipo') === 'premium' ? 'premium' : 'normal',
            'ordem' => (int) ($this->request->getPost('ordem') ?: 0),
            'ativo' => $this->request->getPost('ativo') ? 1 : 0,
        ];
    }

    private function salvarLogo(?string $logoAtual = null): ?string
    {
        $arquivo = $this->request->getFile('logo');

        if (! $arquivo || ! $arquivo->isValid() || $arquivo->hasMoved()) {
            return $logoAtual;
        }

        // As logos ficam públicas para uso direto nas páginas do portal.
        $diretorio = ROOTPATH . 'public/uploads/parceiros/';

        if (! is_dir($diretorio)) {
            mkdir($diretorio, 0775, true);
        }

        $nome = $arquivo->getRandomName();
        $arquivo->move($diretorio, $nome);

        if ($logoAtual) {
            $this->removerLogo($logoAtual);
        }

        return $nome;
    }

    private function removerLogo(?string $logo): void
    {
        if (! $logo || preg_match('#^https?://#i', $logo) === 1) {
            return;
        }

        $path = ROOTPATH . 'public/uploads/parceiros/' . basename($logo);

        if (is_file($path)) {
            unlink($path);
        }
    }

    private function limparCacheHome(): void
    {
        // Mantém a home atualizada após qualquer mudança nos parceiros premium.
        service('cache')->delete('home_parceiros_premium');
    }
}
