<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Migracao;
use App\Models\AcessoRequisito;
use App\Models\AcessoPergunta;
use App\Models\AcessoEquipamento;
use App\Models\PassoImplementacao;

class JornadaAdminController extends Controller
{
    public function index()
    {
        // Puxa os sistemas para a primeira aba
        $comSistema = \App\Models\Migracao::where('secao', 'com_sistema')->get();
        $semSistema = \App\Models\Migracao::where('secao', 'sem_sistema')->get();
        // Puxa os passos da timeline ordenados para a aba de Aplicativo
        $passosApp = \App\Models\PassoAplicativo::orderBy('numero', 'asc')->get();
        $requisitos = AcessoRequisito::all();
        $perguntasCatraca = AcessoPergunta::all();
        $equipamentos = AcessoEquipamento::all(); // Vamos filtrar no Blade
       $impPersonalizada = PassoImplementacao::where('tipo', 'personalizada')->orderBy('ordem', 'asc')->get();
    $impInteligente = PassoImplementacao::where('tipo', 'inteligente')->orderBy('ordem', 'asc')->get();

    return view('admin.jornada.index', compact(
        'comSistema', 'semSistema', 'passosApp',
        'requisitos', 'perguntasCatraca', 'equipamentos',
        'impPersonalizada', 'impInteligente' // <--- Adicione aqui
    ));
        }

    public function create(Request $request)
    {
        $secao = $request->query('secao');
        return view('admin.jornada.create', compact('secao'));
    }

    public function store(Request $request)
    {
        // 1. Cria o registro básico do Card
        $migracao = \App\Models\Migracao::create([
            'nome' => $request->nome,
            'secao' => $request->secao,
            'observacao_alerta' => 'Clique aqui para editar o alerta amarelo...'
        ]);

        // 2. Redireciona imediatamente para a tela de edição para montar a tabela
        return redirect()->route('migracao.edit', $migracao->id)
                        ->with('success', 'Card criado! Agora configure a tabela de detalhes.');
    }

    public function storePasso(Request $request)
    {
        \App\Models\PassoAplicativo::create($request->all());
        return back()->with('success', 'Passo adicionado com sucesso!');
    }

    public function edit($id)
    {
        // Busca o card criado e seus itens da tabela
        $migracao = \App\Models\Migracao::with('itens')->findOrFail($id);
        return view('admin.jornada.edit_migracao', compact('migracao'));
    }

    public function update(Request $request, $id)
    {
        $migracao = \App\Models\Migracao::findOrFail($id);
        $migracao->update($request->only('nome', 'observacao_alerta'));

        // Sincroniza os itens da tabela (deleta e recria)
        $migracao->itens()->delete();
        if ($request->has('itens')) {
        foreach ($request->itens as $item) {
            // Validação simples: só cria se o campo 'dado' estiver preenchido
            if (!empty($item['dado'])) {
                $migracao->itens()->create([
                    'dado'       => $item['dado'],
                    'importa'    => $item['importa'],
                    // Garante que observacao seja string vazia se vier nula
                    'observacao' => $item['observacao'] ?? '',
                ]);
            }
        }
        return redirect()->route('admin.index')->with('success', 'Informações atualizadas com sucesso!');
    }
    }

    public function destroy($id) {
        \App\Models\Migracao::findOrFail($id)->delete();
        return back()->with('success', 'Removido com sucesso!');
    }

    public function storeRequisito(Request $request) {
        AcessoRequisito::create($request->all());
        return redirect()->back()->with('success', 'Requisito criado!');
    }
    public function updateRequisito(Request $request, $id) {
        AcessoRequisito::findOrFail($id)->update($request->all());
        return redirect()->back()->with('success', 'Requisito atualizado!');
    }
    public function destroyRequisito($id) {
        AcessoRequisito::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Requisito excluído!');
    }

    // 2. PERGUNTAS (Tecnofit Catraca)
    public function storePergunta(Request $request) {
        AcessoPergunta::create($request->all());
        return redirect()->back()->with('success', 'Pergunta criada!');
    }
    public function updatePergunta(Request $request, $id) {
        AcessoPergunta::findOrFail($id)->update($request->all());
        return redirect()->back()->with('success', 'Pergunta atualizada!');
    }
    public function destroyPergunta($id) {
        AcessoPergunta::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Pergunta excluída!');
    }

    // 3. EQUIPAMENTOS
    public function storeEquipamento(Request $request) {
        AcessoEquipamento::create($request->all());
        return redirect()->back()->with('success', 'Equipamento adicionado!');
    }
    public function updateEquipamento(Request $request, $id) {
        AcessoEquipamento::findOrFail($id)->update($request->all());
        return redirect()->back()->with('success', 'Equipamento atualizado!');
    }
    public function destroyEquipamento($id) {
        AcessoEquipamento::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Equipamento excluído!');
    }

    public function storeImplementacao(Request $request)
    {
        PassoImplementacao::create($request->all());
        return back()->with('success', 'Passo de implementação criado!');
    }

    public function updateImplementacao(Request $request, $id)
    {
        PassoImplementacao::findOrFail($id)->update($request->all());
        return back()->with('success', 'Passo atualizado!');
    }

    public function destroyImplementacao($id)
    {
        PassoImplementacao::findOrFail($id)->delete();
        return back()->with('success', 'Passo removido!');
    }
}
