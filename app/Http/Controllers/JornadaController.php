<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Migracao;
use App\Models\PassoAplicativo;
use App\Models\AcessoRequisito;
use App\Models\AcessoPergunta;
use App\Models\AcessoEquipamento;
use App\Models\PassoImplementacao;

class JornadaController extends Controller
{
    public function index()
    {
        // 1. Buscando os dados de migração
        $comSistema = Migracao::where('secao', 'com_sistema')->get();
        $semSistema = Migracao::where('secao', 'sem_sistema')->get();

        // 2. Buscando os passos do aplicativo
        $passosApp = PassoAplicativo::orderBy('numero', 'asc')->get();

        // 3. Controle de Acesso
        $requisitos = AcessoRequisito::all();
        $perguntasCatraca = AcessoPergunta::all();
        $equipamentos = AcessoEquipamento::all();

        // 4. NOVOS DADOS: Implementação ( <--- 2. IMPORTANTE: Adicione esta busca )
        $impPersonalizada = PassoImplementacao::where('tipo', 'personalizada')->orderBy('ordem', 'asc')->get();
        $impInteligente = PassoImplementacao::where('tipo', 'inteligente')->orderBy('ordem', 'asc')->get();

        // 5. Enviando TUDO para a view
        return view('jornada', compact(
            'comSistema',
            'semSistema',
            'passosApp',
            'requisitos',
            'perguntasCatraca',
            'equipamentos',
            'impPersonalizada', // <--- 3. IMPORTANTE: Adicione aqui
            'impInteligente'    // <--- 4. IMPORTANTE: Adicione aqui
        ));
    }

    public function getDetails($id) {
        return \App\Models\Migracao::with('itens')->findOrFail($id);
    }

    public function update(Request $request, $id) {
        // Busca a migração pelo ID
        $migracao = Migracao::findOrFail($id);

        // Atualiza o nome
        $migracao->update(['nome' => $request->nome]);

        // Remove os itens antigos para recriar (estratégia de substituição)
        $migracao->itens()->delete();

        if($request->has('itens')) {
            foreach($request->itens as $index => $itemData) {

                $caminhoArquivo = null;

                // CASO 1: O usuário enviou um NOVO arquivo agora
                // CORREÇÃO: Uso de {$index} para evitar erro de sintaxe
                if ($request->hasFile("itens.{$index}.arquivo")) {
                    $caminhoArquivo = $request->file("itens.{$index}.arquivo")->store('modelos', 'public');
                }
                // CASO 2: Não enviou novo, mas já existia um antigo (pegamos do input hidden)
                elseif (isset($itemData['arquivo_antigo'])) {
                    $caminhoArquivo = $itemData['arquivo_antigo'];
                }

                // Cria o item no banco
                $migracao->itens()->create([
                    'nome' => $itemData['nome'],
                    'observacao' => $itemData['observacao'] ?? null, // Null Coalescing operator para evitar erro se não existir
                    'arquivo' => $caminhoArquivo
                ]);
            }
        }

        // Redireciona de volta (ajuste a rota conforme sua necessidade, admin.index ou similar)
        return redirect()->route('admin.index')->with('sucesso', 'Conteúdo atualizado!');
    }

    // 1. Função de CRIAR (storePasso)
    public function storePasso(Request $request)
    {
        $request->validate([
            'numero' => 'required|numeric',
            'titulo' => 'required|string',
            'responsabilidade' => 'required|in:cliente,tecnofit',
            'prazo' => 'nullable|string',
        ]);

        PassoAplicativo::create([
            'numero' => $request->numero,
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'responsabilidade' => $request->responsabilidade,
            'prazo' => $request->prazo,
        ]);

        return redirect()->back()->with('success', 'Passo criado com sucesso!');
    }

    // 2. Função de ATUALIZAR (updatePasso)
    public function updatePasso(Request $request, $id)
    {
        $passo = PassoAplicativo::findOrFail($id);

        $request->validate([
            'numero' => 'required|numeric',
            'titulo' => 'required|string',
            'responsabilidade' => 'required|in:cliente,tecnofit',
            'prazo' => 'nullable|string',
        ]);

        $passo->update([
            'numero' => $request->numero,
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'responsabilidade' => $request->responsabilidade,
            'prazo' => $request->prazo,
        ]);

        return redirect()->back()->with('success', 'Passo atualizado com sucesso!');
    }

    // 3. Função de DELETAR (destroyPasso)
    public function destroyPasso($id)
    {
        $passo = PassoAplicativo::findOrFail($id);
        $passo->delete();

        return redirect()->back()->with('success', 'Passo excluído com sucesso!');
    }

}
