<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jornada Técnica - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <style>
        /* CSS Específico do Admin (mantido o original + ajustes de layout) */
        .custom-modal-overlay { display: none; position: fixed; z-index: 10000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.6); backdrop-filter: blur(2px); justify-content: center; align-items: center; }
        .custom-modal-box { background-color: #fff; padding: 30px; border-radius: 12px; width: 500px; max-width: 90%; box-shadow: 0 15px 40px rgba(0,0,0,0.2); position: relative; animation: modalFadeIn 0.3s ease-out; max-height: 90vh; overflow-y: auto; }
        @keyframes modalFadeIn { from { opacity: 0; transform: translateY(-30px); } to { opacity: 1; transform: translateY(0); } }
        .input-group { margin-bottom: 15px; display: flex; flex-direction: column; text-align: left; }
        .input-group label { font-weight: 600; margin-bottom: 5px; font-size: 14px; color: #333; }
        .input-group input, .input-group select, .input-group textarea { padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; width: 100%; box-sizing: border-box; }
        .modal-footer { margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px; }
        .btn-salvar-modal { background-color: #5d50c6; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-weight: bold; }
        .btn-cancelar-modal { background-color: #ddd; color: #333; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; }
        .close-btn { position: absolute; top: 20px; right: 20px; cursor: pointer; font-size: 24px; font-weight: bold; color: #aaa; }
        .ball-client { width: 40px; height: 40px; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-weight: bold; flex-shrink: 0; background-color: #000; color: #fff; border: 2px solid #000; }
        .ball-tecnofit { width: 40px; height: 40px; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-weight: bold; flex-shrink: 0; background-color: #fceea2; color: #333; border: 2px solid #fceea2; }
        .action-btn { background: none; border: none; cursor: pointer; font-size: 14px; padding: 5px; color: #666; transition: 0.2s; }
        .action-btn:hover { color: #5d50c6; }
        .action-btn.delete:hover { color: #ff4d4d; }

        /* Estilos específicos para Equipamentos (Admin) */
        .equip-admin-item { display: flex; justify-content: space-between; align-items: center; background: #fff; border: 1px solid #eee; padding: 15px; border-radius: 8px; margin-bottom: 10px; }
        .req-admin-card { background: #fff; padding: 20px; border-radius: 10px; border: 1px solid #eee; position: relative; }
        .req-actions { position: absolute; top: 10px; right: 10px; display: flex; gap: 5px; }
    </style>
</head>
<body>

    <x-header />

    <div class="master-container">

        <div class="tabs-container">
            <p class="tab-instruction">Gerenciamento da Jornada Técnica</p>
            <div class="tabs-wrapper">
                <button class="tab-btn active" onclick="switchAdminTab('implementacao')" id="btn-implementacao">Implementação</button>
                <button class="tab-btn" onclick="switchAdminTab('migracao')" id="btn-migracao">Migração de dados</button>
                <button class="tab-btn" onclick="switchAdminTab('catraca')" id="btn-catraca">Controle de acesso</button>
                <button class="tab-btn" onclick="switchAdminTab('whitelabel')" id="btn-whitelabel">Aplicativo personalizado</button>
            </div>
        </div>

        <section id="content-implementacao" class="content-section active">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;">
        <h3 class="col-title">Passos da Implementação</h3>
        <button onclick="abrirModal('modalNovoImpl')" class="btn-saiba-mais">+ NOVO PASSO</button>
    </div>

    <div style="background: #fff; padding: 20px; border-radius: 10px; border: 1px solid #eee;">

        <h4 style="margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px; color: #5d50c6;">
            Consultoria Personalizada
        </h4>

        @if($impPersonalizada->count() > 0)
            @foreach($impPersonalizada as $item)
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 15px 10px; border-bottom: 1px solid #f9f9f9;">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div style="background: #fceea2; padding: 5px; border-radius: 4px; width: 30px; height: 30px; display: flex; justify-content: center; align-items: center; font-weight: bold;">
                        {{ $item->ordem }}
                    </div>
                    <div>
                        <strong>{{ $item->titulo }}</strong>
                        <span style="font-size: 11px; background: #eee; padding: 2px 6px; border-radius: 4px; margin-left: 5px;">{{ $item->prazo }}</span>
                        <br>
                        <span style="font-size: 12px; color: #888;">{{ \Illuminate\Support\Str::limit($item->descricao, 60) }}</span>
                    </div>
                </div>
                <div style="display: flex; gap: 5px;">
                    <button type="button" class="action-btn" onclick="abrirModal('modalEditarImpl-{{ $item->id }}')">
                        <i class="fas fa-edit"></i>
                    </button>
                    <form action="{{ route('admin.implementacao.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Excluir este passo?')" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="action-btn delete"><i class="fas fa-trash"></i></button>
                    </form>
                </div>
            </div>

       <div id="modalEditarImpl-{{ $item->id }}" class="custom-modal-overlay">
    <div class="custom-modal-box">
        <div class="modal-header">
            <h3>Editar Passo</h3>
            <span onclick="fecharModal('modalEditarImpl-{{ $item->id }}')" class="close-btn">&times;</span>
        </div>
        <form action="{{ route('admin.implementacao.update', $item->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="modal-body">

                <div class="input-group">
                    <label>Segmentos</label>
                    <div style="display: flex; gap: 15px; flex-wrap: wrap;">

                        <label style="font-weight: normal; display: flex; align-items: center; gap: 5px;">
                            <input type="checkbox" name="segmentos[]" value="agenda_fixa"
                            {{-- A LÓGICA: Se 'agenda_fixa' estiver na lista salva, marca com 'checked' --}}
                            {{ is_array($item->segmentos) && in_array('agenda_fixa', $item->segmentos) ? 'checked' : '' }}>
                            Agenda Fixa
                        </label>

                        <label style="font-weight: normal; display: flex; align-items: center; gap: 5px;">
                            <input type="checkbox" name="segmentos[]" value="gym"
                            {{ is_array($item->segmentos) && in_array('gym', $item->segmentos) ? 'checked' : '' }}>
                            Gym
                        </label>

                        <label style="font-weight: normal; display: flex; align-items: center; gap: 5px;">
                            <input type="checkbox" name="segmentos[]" value="box"
                            {{ is_array($item->segmentos) && in_array('box', $item->segmentos) ? 'checked' : '' }}>
                            Box
                        </label>

                        <label style="font-weight: normal; display: flex; align-items: center; gap: 5px;">
                            <input type="checkbox" name="segmentos[]" value="starter"
                            {{ is_array($item->segmentos) && in_array('starter', $item->segmentos) ? 'checked' : '' }}>
                            Starter
                        </label>
                    </div>
                </div>

                <div class="input-group">
                    <label>Tipo</label>
                    <select name="tipo">
                        <option value="personalizada" {{ $item->tipo == 'personalizada' ? 'selected' : '' }}>Personalizada</option>
                        <option value="inteligente" {{ $item->tipo == 'inteligente' ? 'selected' : '' }}>Inteligente</option>
                    </select>
                </div>
                <div class="input-group"><label>Ordem</label><input type="number" name="ordem" value="{{ $item->ordem }}"></div>
                <div class="input-group"><label>Prazo</label><input type="text" name="prazo" value="{{ $item->prazo }}"></div>
                <div class="input-group"><label>Título</label><input type="text" name="titulo" value="{{ $item->titulo }}"></div>
                <div class="input-group"><label>Descrição</label><textarea name="descricao" rows="3">{{ $item->descricao }}</textarea></div>
                <div class="input-group"><label>Ícone</label><input type="text" name="icone" value="{{ $item->icone }}"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancelar-modal" onclick="fecharModal('modalEditarImpl-{{ $item->id }}')">Cancelar</button>
                <button type="submit" class="btn-salvar-modal">Salvar</button>
            </div>
        </form>
    </div>
</div>
            @endforeach
        @else
            <p style="padding: 20px; text-align: center; color: #999; font-style: italic;">Nenhum passo cadastrado nesta jornada.</p>
        @endif

        <h4 style="margin-top: 40px; margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px; color: #5d50c6;">
            Consultoria Inteligente
        </h4>

        @if($impInteligente->count() > 0)
            @foreach($impInteligente as $item)
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 15px 10px; border-bottom: 1px solid #f9f9f9;">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div style="background: #fceea2; padding: 5px; border-radius: 4px; width: 30px; height: 30px; display: flex; justify-content: center; align-items: center; font-weight: bold;">
                        {{ $item->ordem }}
                    </div>
                    <div>
                        <strong>{{ $item->titulo }}</strong>
                        <span style="font-size: 11px; background: #eee; padding: 2px 6px; border-radius: 4px; margin-left: 5px;">{{ $item->prazo }}</span>
                        <br>
                        <span style="font-size: 12px; color: #888;">{{ \Illuminate\Support\Str::limit($item->descricao, 60) }}</span>
                    </div>
                </div>
                <div style="display: flex; gap: 5px;">
                    <button type="button" class="action-btn" onclick="abrirModal('modalEditarImpl-{{ $item->id }}')">
                        <i class="fas fa-edit"></i>
                    </button>
                    <form action="{{ route('admin.implementacao.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Excluir este passo?')" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="action-btn delete"><i class="fas fa-trash"></i></button>
                    </form>
                </div>
            </div>

            <div id="modalEditarImpl-{{ $item->id }}" class="custom-modal-overlay">
                <div class="custom-modal-box">
                    <div class="modal-header">
                        <h3>Editar Passo</h3>
                        <span onclick="fecharModal('modalEditarImpl-{{ $item->id }}')" class="close-btn">&times;</span>
                    </div>
                    <form action="{{ route('admin.implementacao.update', $item->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="modal-body">
                            <div class="input-group">
                                <label>Tipo</label>
                                <select name="tipo">
                                    <option value="personalizada" {{ $item->tipo == 'personalizada' ? 'selected' : '' }}>Personalizada</option>
                                    <option value="inteligente" {{ $item->tipo == 'inteligente' ? 'selected' : '' }}>Inteligente</option>
                                </select>
                            </div>
                            <div class="input-group"><label>Ordem</label><input type="number" name="ordem" value="{{ $item->ordem }}"></div>
                            <div class="input-group"><label>Prazo</label><input type="text" name="prazo" value="{{ $item->prazo }}"></div>
                            <div class="input-group"><label>Título</label><input type="text" name="titulo" value="{{ $item->titulo }}"></div>
                            <div class="input-group"><label>Descrição</label><textarea name="descricao" rows="3">{{ $item->descricao }}</textarea></div>
                            <div class="input-group"><label>Ícone (FontAwesome)</label><input type="text" name="icone" value="{{ $item->icone }}"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-cancelar-modal" onclick="fecharModal('modalEditarImpl-{{ $item->id }}')">Cancelar</button>
                            <button type="submit" class="btn-salvar-modal">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        @else
            <p style="padding: 20px; text-align: center; color: #999; font-style: italic;">Nenhum passo cadastrado nesta jornada.</p>
        @endif

    </div>
</section>
        <section id="content-migracao" class="content-section">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;">
                <h3 class="col-title">Sistemas concorrentes</h3>
                <a href="{{ route('migracao.create', ['secao' => 'com_sistema']) }}" class="btn-saiba-mais">+ CRIAR</a>
            </div>
            <div class="migration-grid">
                @foreach($comSistema as $m)
                <div class="migration-card">
                    <i class="fas fa-cloud-upload-alt card-icon"></i>
                    <p style="font-weight:700;">{{ $m->nome }}</p>
                    <div style="display: flex; gap: 5px; margin-top: 10px;">
                        <a href="{{ route('migracao.edit', $m->id) }}" class="btn-saiba-mais" style="font-size: 10px;">EDITAR</a>
                        <form action="{{ route('migracao.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Tem certeza?')">
                            @csrf @method('DELETE')
                            <button class="btn-saiba-mais" style="background: #ff7d41; color:white; font-size: 10px;">EXCLUIR</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            <hr style="margin: 40px 0; border: 0; border-top: 1px dashed #ddd;">

            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h3 class="col-title">Sem sistema</h3>
                <a href="{{ route('migracao.create', ['secao' => 'sem_sistema']) }}" class="btn-saiba-mais">+ CRIAR</a>
            </div>
            <div class="migration-grid">
                @foreach($semSistema as $m)
                <div class="migration-card">
                    <i class="fas fa-file-import card-icon"></i>
                    <p style="font-weight:700;">{{ $m->nome }}</p>
                    <div style="display: flex; gap: 5px; margin-top: 10px;">
                        <a href="{{ route('migracao.edit', $m->id) }}" class="btn-saiba-mais" style="font-size: 10px;">EDITAR</a>
                        <form action="{{ route('migracao.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Tem certeza?')">
                            @csrf @method('DELETE')
                            <button class="btn-saiba-mais" style="background: #ff7d41; color:white; font-size: 10px;">EXCLUIR</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <section id="content-catraca" class="content-section">

            <div style="background-color: #fcfeb3; padding: 30px; border-radius: 15px; margin-bottom: 40px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h3 style="color: #333; margin: 0;">Requisitos obrigatórios para conectividade com o Tecnofit Catraca</h3>
                    <button onclick="abrirModal('modalNovoRequisito')" class="btn-saiba-mais" style="background: #fff; color: #333;">+ NOVO REQUISITO</button>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
                    @foreach($requisitos as $req)
                    <div class="req-admin-card">
                        <div class="req-actions">
                            <button type="button" class="action-btn" onclick="abrirModal('modalEditarRequisito-{{ $req->id }}')"><i class="fas fa-edit"></i></button>
                            <form action="{{ route('admin.requisito.destroy', $req->id) }}" method="POST" onsubmit="return confirm('Excluir este requisito?')" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                        <i class="{{ $req->icone }}" style="font-size: 24px; color: #eebb00; margin-bottom: 10px;"></i>
                        <h4 style="font-size: 16px; margin: 10px 0;">{{ $req->titulo }}</h4>
                        <p style="font-size: 13px; color: #666;">{{ $req->descricao }}</p>
                    </div>

                    <div id="modalEditarRequisito-{{ $req->id }}" class="custom-modal-overlay">
                        <div class="custom-modal-box">
                            <div class="modal-header"><h3>Editar Requisito</h3><span onclick="fecharModal('modalEditarRequisito-{{ $req->id }}')" class="close-btn">&times;</span></div>
                            <form action="{{ route('admin.requisito.update', $req->id) }}" method="POST">
                                @csrf @method('PUT')
                                <div class="modal-body">
                                    <div class="input-group"><label>Título</label><input type="text" name="titulo" value="{{ $req->titulo }}" required></div>
                                    <div class="input-group"><label>Descrição</label><textarea name="descricao" rows="3" required>{{ $req->descricao }}</textarea></div>
                                    <div class="input-group"><label>Ícone (FontAwesome)</label><input type="text" name="icone" value="{{ $req->icone }}" required></div>
                                </div>
                                <div class="modal-footer"><button type="button" class="btn-cancelar-modal" onclick="fecharModal('modalEditarRequisito-{{ $req->id }}')">Cancelar</button><button type="submit" class="btn-salvar-modal">Salvar</button></div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div style="margin-bottom: 40px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h3 class="col-title">Tecnofit Catraca (Perguntas)</h3>
                    <button onclick="abrirModal('modalNovaPergunta')" class="btn-saiba-mais">+ NOVA PERGUNTA</button>
                </div>

                @foreach($perguntasCatraca as $perg)
                <div style="border: 1px solid #eee; padding: 20px; border-radius: 8px; margin-bottom: 15px; background: #fff; position: relative;">
                    <div style="position: absolute; top: 15px; right: 15px;">
                        <button type="button" class="action-btn" onclick="abrirModal('modalEditarPergunta-{{ $perg->id }}')"><i class="fas fa-edit"></i></button>
                        <form action="{{ route('admin.pergunta.destroy', $perg->id) }}" method="POST" onsubmit="return confirm('Excluir esta pergunta?')" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-btn delete"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                    <h4 style="margin: 0 0 10px 0; padding-right: 60px;">{{ $perg->titulo }}</h4>
                    <p style="margin: 0; color: #666;">{{ $perg->descricao }}</p>
                </div>

                <div id="modalEditarPergunta-{{ $perg->id }}" class="custom-modal-overlay">
                    <div class="custom-modal-box">
                        <div class="modal-header"><h3>Editar Pergunta</h3><span onclick="fecharModal('modalEditarPergunta-{{ $perg->id }}')" class="close-btn">&times;</span></div>
                        <form action="{{ route('admin.pergunta.update', $perg->id) }}" method="POST">
                            @csrf @method('PUT')
                            <div class="modal-body">
                                <div class="input-group"><label>Título (Pergunta)</label><input type="text" name="titulo" value="{{ $perg->titulo }}" required></div>
                                <div class="input-group"><label>Resposta / Descrição</label><textarea name="descricao" rows="3" required>{{ $perg->descricao }}</textarea></div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn-cancelar-modal" onclick="fecharModal('modalEditarPergunta-{{ $perg->id }}')">Cancelar</button><button type="submit" class="btn-salvar-modal">Salvar</button></div>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            <div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h3 class="col-title">Equipamentos Homologados</h3>
                    <button onclick="abrirModal('modalNovoEquipamento')" class="btn-saiba-mais">+ NOVO EQUIPAMENTO</button>
                </div>

                <div style="display: flex; gap: 10px; margin-bottom: 20px;">
                    <button class="tab-btn-equip active" onclick="filtrarEquipAdmin('catracas')">Catracas</button>
                    <button class="tab-btn-equip" onclick="filtrarEquipAdmin('facial')">Leitores Faciais</button>
                    <button class="tab-btn-equip" onclick="filtrarEquipAdmin('biometria')">Biométricos</button>
                    <button class="tab-btn-equip" onclick="filtrarEquipAdmin('impressoras')">Impressoras</button>
                </div>

                <div id="lista-equipamentos-admin">
                    @foreach($equipamentos as $equip)
                    <div class="equip-admin-item item-admin-{{ $equip->categoria }}">
                        <div>
                            <strong style="color: #5d50c6;">{{ $equip->marca }}</strong> - {{ $equip->modelo }}
                            <br>
                            <small style="color: #999;">Conexão: {{ $equip->conexao }}</small>
                        </div>
                        <div>
                            <button type="button" class="action-btn" onclick="abrirModal('modalEditarEquip-{{ $equip->id }}')"><i class="fas fa-edit"></i></button>
                            <form action="{{ route('admin.equipamento.destroy', $equip->id) }}" method="POST" onsubmit="return confirm('Excluir equipamento?')" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </div>

                    <div id="modalEditarEquip-{{ $equip->id }}" class="custom-modal-overlay">
                        <div class="custom-modal-box">
                            <div class="modal-header"><h3>Editar Equipamento</h3><span onclick="fecharModal('modalEditarEquip-{{ $equip->id }}')" class="close-btn">&times;</span></div>
                            <form action="{{ route('admin.equipamento.update', $equip->id) }}" method="POST">
                                @csrf @method('PUT')
                                <div class="modal-body">
                                    <div class="input-group">
                                        <label>Categoria</label>
                                        <select name="categoria" required>
                                            <option value="catracas" {{ $equip->categoria == 'catracas' ? 'selected' : '' }}>Catraca</option>
                                            <option value="facial" {{ $equip->categoria == 'facial' ? 'selected' : '' }}>Leitor Facial</option>
                                            <option value="biometria" {{ $equip->categoria == 'biometria' ? 'selected' : '' }}>Biometria</option>
                                            <option value="impressoras" {{ $equip->categoria == 'impressoras' ? 'selected' : '' }}>Impressora</option>
                                        </select>
                                    </div>
                                    <div class="input-group"><label>Marca</label><input type="text" name="marca" value="{{ $equip->marca }}" required></div>
                                    <div class="input-group"><label>Modelo</label><input type="text" name="modelo" value="{{ $equip->modelo }}" required></div>
                                    <div class="input-group"><label>Conexão (ex: Rede, USB)</label><input type="text" name="conexao" value="{{ $equip->conexao }}"></div>
                                </div>
                                <div class="modal-footer"><button type="button" class="btn-cancelar-modal" onclick="fecharModal('modalEditarEquip-{{ $equip->id }}')">Cancelar</button><button type="submit" class="btn-salvar-modal">Salvar</button></div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="content-whitelabel" class="content-section">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px; margin-bottom: 30px;">
                <h3 class="col-title">Passo a passo - Aplicativo White Label</h3>
                <button type="button" onclick="abrirModal('modalNovoPasso')" class="btn-saiba-mais" style="background-color: #fceea2; color: #333; font-weight: bold;">+ NOVO PASSO</button>
            </div>

            <div class="timeline-steps">
                @if(isset($passosApp) && $passosApp->count() > 0)
                    @foreach($passosApp as $passo)
                    <div class="step-item" style="display: flex; align-items: flex-start; gap: 15px; background: #fff; padding: 20px; margin-bottom: 15px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                        <div class="step-number {{ $passo->responsabilidade == 'cliente' ? 'ball-client' : 'ball-tecnofit' }}">
                            {{ $passo->numero }}
                        </div>
                        <div class="step-info" style="flex: 1;">
                            <h4 style="margin: 0 0 5px 0; font-size: 16px;">{{ $passo->titulo }}</h4>
                            <p style="margin: 0; color: #666; font-size: 14px; line-height: 1.4;">{{ $passo->descricao }}</p>
                            <div style="margin-top: 10px;">
                                <span style="font-size: 11px; padding: 4px 8px; border-radius: 4px; background: #eee; text-transform: uppercase; font-weight: 600; color: #555;">
                                    Responsável: {{ $passo->responsabilidade }}
                                </span>
                            </div>
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 5px; margin-left: 10px;">
                            <button type="button" class="action-btn" title="Editar" onclick="abrirModal('modalEditarPasso-{{ $passo->id }}')"><i class="fas fa-edit"></i></button>
                            <form action="{{ route('passos.destroy', $passo->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este passo?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="action-btn delete" title="Excluir"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </div>

                    <div id="modalEditarPasso-{{ $passo->id }}" class="custom-modal-overlay">
                        <div class="custom-modal-box">
                            <div class="modal-header">
                                <h3 style="margin: 0;">Editar Passo</h3>
                                <span onclick="fecharModal('modalEditarPasso-{{ $passo->id }}')" class="close-btn">&times;</span>
                            </div>
                            <form action="{{ route('passos.update', $passo->id) }}" method="POST">
                                @csrf @method('PUT')
                                <div class="modal-body" style="margin-top: 20px;">
                                    <div class="input-group"><label>Número do Passo</label><input type="number" name="numero" value="{{ $passo->numero }}" required></div>
                                    <div class="input-group"><label>Título</label><input type="text" name="titulo" value="{{ $passo->titulo }}" required></div>
                                    <div class="input-group"><label>Descrição</label><textarea name="descricao" rows="3" required>{{ $passo->descricao }}</textarea></div>
                                    <div class="input-group"><label>Responsabilidade</label>
                                        <select name="responsabilidade" required>
                                            <option value="cliente" {{ $passo->responsabilidade == 'cliente' ? 'selected' : '' }}>Cliente (Bola Preta)</option>
                                            <option value="tecnofit" {{ $passo->responsabilidade == 'tecnofit' ? 'selected' : '' }}>Tecnofit (Bola Amarela)</option>
                                        </select>
                                    </div>
                                    <div class="input-group"><label>Prazo</label><input type="text" name="prazo" value="{{ $passo->prazo }}"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn-cancelar-modal" onclick="fecharModal('modalEditarPasso-{{ $passo->id }}')">Cancelar</button>
                                    <button type="submit" class="btn-salvar-modal">Salvar Alterações</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div style="text-align: center; padding: 40px; color: #999; border: 2px dashed #ddd; border-radius: 10px;">
                        Nenhum passo cadastrado ainda.
                    </div>
                @endif
            </div>
        </section>

    </div>

    <div id="modalNovoRequisito" class="custom-modal-overlay">
        <div class="custom-modal-box">
            <div class="modal-header"><h3>Novo Requisito</h3><span onclick="fecharModal('modalNovoRequisito')" class="close-btn">&times;</span></div>
            <form action="{{ route('admin.requisito.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="input-group"><label>Título</label><input type="text" name="titulo" required placeholder="Ex: Computador na recepção"></div>
                    <div class="input-group"><label>Descrição</label><textarea name="descricao" rows="3" required placeholder="Detalhes do requisito..."></textarea></div>
                    <div class="input-group"><label>Ícone (FontAwesome)</label><input type="text" name="icone" required placeholder="Ex: fas fa-desktop"></div>
                </div>
                <div class="modal-footer"><button type="button" class="btn-cancelar-modal" onclick="fecharModal('modalNovoRequisito')">Cancelar</button><button type="submit" class="btn-salvar-modal">Salvar</button></div>
            </form>
        </div>
    </div>

    <div id="modalNovaPergunta" class="custom-modal-overlay">
        <div class="custom-modal-box">
            <div class="modal-header"><h3>Nova Pergunta</h3><span onclick="fecharModal('modalNovaPergunta')" class="close-btn">&times;</span></div>
            <form action="{{ route('admin.pergunta.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="input-group"><label>Título (Pergunta)</label><input type="text" name="titulo" required placeholder="Ex: A catraca precisa de internet?"></div>
                    <div class="input-group"><label>Resposta / Descrição</label><textarea name="descricao" rows="3" required placeholder="A resposta..."></textarea></div>
                </div>
                <div class="modal-footer"><button type="button" class="btn-cancelar-modal" onclick="fecharModal('modalNovaPergunta')">Cancelar</button><button type="submit" class="btn-salvar-modal">Salvar</button></div>
            </form>
        </div>
    </div>

    <div id="modalNovoEquipamento" class="custom-modal-overlay">
        <div class="custom-modal-box">
            <div class="modal-header"><h3>Novo Equipamento</h3><span onclick="fecharModal('modalNovoEquipamento')" class="close-btn">&times;</span></div>
            <form action="{{ route('admin.equipamento.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="input-group">
                        <label>Categoria</label>
                        <select name="categoria" required>
                            <option value="catracas">Catraca</option>
                            <option value="facial">Leitor Facial</option>
                            <option value="biometria">Biometria</option>
                            <option value="impressoras">Impressora</option>
                        </select>
                    </div>
                    <div class="input-group"><label>Marca</label><input type="text" name="marca" required placeholder="Ex: Henry"></div>
                    <div class="input-group"><label>Modelo</label><input type="text" name="modelo" required placeholder="Ex: 8x"></div>
                    <div class="input-group"><label>Conexão (ex: Rede, USB)</label><input type="text" name="conexao"></div>
                </div>
                <div class="modal-footer"><button type="button" class="btn-cancelar-modal" onclick="fecharModal('modalNovoEquipamento')">Cancelar</button><button type="submit" class="btn-salvar-modal">Salvar</button></div>
            </form>
        </div>
    </div>

    <div id="modalNovoPasso" class="custom-modal-overlay">
        <div class="custom-modal-box">
            <div class="modal-header"><h3 style="margin: 0;">Novo Passo - App</h3><span onclick="fecharModal('modalNovoPasso')" class="close-btn">&times;</span></div>
            <form action="{{ route('passos.store') }}" method="POST">
                @csrf
                <div class="modal-body" style="margin-top: 20px;">
                    <div class="input-group"><label>Número do Passo</label><input type="number" name="numero" placeholder="Ex: 1" required></div>
                    <div class="input-group"><label>Título</label><input type="text" name="titulo" placeholder="Ex: Envio de Logomarca" required></div>
                    <div class="input-group"><label>Descrição</label><textarea name="descricao" rows="3" placeholder="Detalhes..." required></textarea></div>
                    <div class="input-group"><label>Responsabilidade</label>
                        <select name="responsabilidade" required>
                            <option value="" disabled selected>Selecione...</option>
                            <option value="cliente">Cliente (Bola Preta)</option>
                            <option value="tecnofit">Tecnofit (Bola Amarela)</option>
                        </select>
                    </div>
                    <div class="input-group"><label>Prazo Estimado</label><input type="text" name="prazo" placeholder="Ex: 2 dias úteis"></div>
                </div>
                <div class="modal-footer"><button type="button" class="btn-cancelar-modal" onclick="fecharModal('modalNovoPasso')">Cancelar</button><button type="submit" class="btn-salvar-modal">Salvar</button></div>
            </form>
        </div>
    </div>
    <div id="modalNovoImpl" class="custom-modal-overlay">
    <div class="custom-modal-box">
        <div class="modal-header">
            <h3>Novo Passo de Implementação</h3>
            <span onclick="fecharModal('modalNovoImpl')" class="close-btn">&times;</span>
        </div>

        <form action="{{ route('admin.implementacao.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="input-group">
                    <label>Tipo da Jornada</label>
                    <select name="tipo" required>
                        <option value="personalizada">Consultoria Personalizada</option>
                        <option value="inteligente">Consultoria Inteligente</option>
                    </select>
                </div>

                <div style="display: flex; gap: 15px;">
                    <div class="input-group" style="flex: 1;">
                        <label>Ordem (Número)</label>
                        <input type="number" name="ordem" value="1" required>
                    </div>
                    <div class="input-group" style="flex: 1;">
                        <label>Prazo (Ex: Dia 1)</label>
                        <input type="text" name="prazo" required placeholder="Ex: Semana 2">
                    </div>
                </div>

                <div class="input-group">
                    <label>Título</label>
                    <input type="text" name="titulo" required placeholder="Ex: Reunião de Kick-off">
                </div>

                <div class="input-group">
                    <label>Descrição</label>
                    <textarea name="descricao" rows="3" placeholder="Detalhes do passo..."></textarea>
                </div>

                <div class="input-group">
                    <label>Ícone (FontAwesome)</label>
                    <input type="text" name="icone" value="fas fa-check" placeholder="Ex: fas fa-rocket">
                    <small style="color: #999;">Exemplos: fas fa-video, fas fa-file-alt, fas fa-check</small>
                </div>
                <div class="input-group">
                <label>Segmentos (Selecione um ou mais)</label>
                <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                    <label style="font-weight: normal; display: flex; align-items: center; gap: 5px;">
                        <input type="checkbox" name="segmentos[]" value="agenda_fixa"> Agenda Fixa
                    </label>
                    <label style="font-weight: normal; display: flex; align-items: center; gap: 5px;">
                        <input type="checkbox" name="segmentos[]" value="gym"> Gym
                    </label>
                    <label style="font-weight: normal; display: flex; align-items: center; gap: 5px;">
                        <input type="checkbox" name="segmentos[]" value="box"> Box
                    </label>
                    <label style="font-weight: normal; display: flex; align-items: center; gap: 5px;">
                        <input type="checkbox" name="segmentos[]" value="starter"> Starter
                    </label>
                </div>
            </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-cancelar-modal" onclick="fecharModal('modalNovoImpl')">Cancelar</button>
                <button type="submit" class="btn-salvar-modal">Salvar</button>
            </div>
        </form>
    </div>
</div>

    <script>
        // Trocar Abas
        function switchAdminTab(tabName) {
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.content-section').forEach(sec => sec.classList.remove('active'));
            const btn = document.getElementById('btn-' + tabName);
            const content = document.getElementById('content-' + tabName);
            if(btn) btn.classList.add('active');
            if(content) content.classList.add('active');
        }

        // JS Modal
        function abrirModal(modalId) {
            const modal = document.getElementById(modalId);
            if(modal) modal.style.display = 'flex';
        }

        function fecharModal(modalId) {
            const modal = document.getElementById(modalId);
            if(modal) modal.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target.classList.contains('custom-modal-overlay')) {
                event.target.style.display = "none";
            }
        }

        // Filtro de Equipamentos (Admin)
        function filtrarEquipAdmin(categoria) {
            // Atualiza botões
            document.querySelectorAll('.tab-btn-equip').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');

            // Esconde todos
            document.querySelectorAll('.equip-admin-item').forEach(item => item.style.display = 'none');

            // Mostra só a categoria
            document.querySelectorAll('.item-admin-' + categoria).forEach(item => {
                item.style.display = 'flex'; // Flex para manter o alinhamento row
            });
        }

        // Inicializa mostrando Catracas
        document.addEventListener("DOMContentLoaded", function() {
            filtrarEquipAdmin('catracas');
        });
    </script>
</body>
</html>
