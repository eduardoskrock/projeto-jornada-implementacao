<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jornada Técnica Tecnofit</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <x-header />

    <div class="hero-section">
        <h1 class="hero-title">Jornada de implementação <span>Tecnofit</span></h1>
        <p class="hero-subtitle">Confira as etapas e requisitos para fazer a virada de chave de sistema com segurança e clareza!</p>
    </div>

    <div class="master-container">
        <div class="tabs-container">
            <p class="tab-instruction">Entenda a jornada de implementação de acordo com a etapa</p>
            <div class="tabs-wrapper">
                <button class="tab-btn active" onclick="switchTab('implementacao')" id="btn-implementacao">Implementação</button>
                <button class="tab-btn" onclick="switchTab('migracao')" id="btn-migracao">Migração de dados</button>
                <button class="tab-btn" onclick="switchTab('catraca')" id="btn-catraca">Controle de acesso</button>
                <button class="tab-btn" onclick="switchTab('whitelabel')" id="btn-whitelabel">Aplicativo personalizado</button>
            </div>
        </div>
<section id="content-implementacao" class="content-section active">

    <div id="view-segmentos">
        <h3 class="col-title" style="text-align: center; margin-top: 20px;">Selecione o segmento</h3>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; max-width: 900px; margin: 30px auto;">

            <div class="migration-card" style="height: auto; padding: 30px 20px;">
                <i class="fa-solid fa-calendar-days card-icon" style="color: var(--tecno-black)"></i>
                <h4 style="margin: 15px 0;">Agenda Fixa</h4>
                <button class="btn-saiba-mais" onclick="selectSegment('agenda_fixa')">SAIBA MAIS</button>
            </div>

            <div class="migration-card" style="height: auto; padding: 30px 20px;">
                <i class="fa-solid fa-dumbbell card-icon" style="color: var(--tecno-black);"></i>
                <h4 style="margin: 15px 0;">Gym</h4>
                <button class="btn-saiba-mais" onclick="selectSegment('gym')">SAIBA MAIS</button>
            </div>

            <div class="migration-card" style="height: auto; padding: 30px 20px;">
                <i class="fa-solid fa-medal card-icon" style="color: var(--tecno-black);"></i>
                <h4 style="margin: 15px 0;">Box</h4>
                <button class="btn-saiba-mais" onclick="selectSegment('box')">SAIBA MAIS</button>
            </div>

            <div class="migration-card" style="height: auto; padding: 30px 20px;">
                <i class="fa-solid fa-user-tag card-icon" style="color: var(--tecno-black);"></i>
                <h4 style="margin: 15px 0;">Starter</h4>
                <button class="btn-saiba-mais" onclick="selectSegment('starter')">SAIBA MAIS</button>
            </div>

        </div>
    </div>

    <div id="view-consultorias" style="display: none;">
        <button class="btn-saiba-mais" onclick="backToSegments()" style="margin-bottom: 20px;">&larr; Voltar para Segmentos</button>

        <h3 class="col-title" style="text-align: center; margin-top: 10px;">Escolha o modelo de jornada</h3>

        <div style="display: flex; justify-content: center; gap: 30px; margin-top: 30px; flex-wrap: wrap;">
            <div class="migration-card" style="width: 300px; height: auto; padding: 40px 20px;">
                <i class="fas fa-user-tie card-icon" style="color: #5d50c6;"></i>
                <h4 style="margin: 15px 0;">Consultoria Personalizada</h4>
                <p style="font-size: 13px; color: #666; margin-bottom: 20px;">Acompanhamento dedicado.</p>
                <button class="btn-saiba-mais" onclick="openImplTimeline('personalizada')">SAIBA MAIS</button>
            </div>

            <div class="migration-card" style="width: 300px; height: auto; padding: 40px 20px;">
                <i class="fas fa-brain card-icon" style="color: #fceea2; -webkit-text-stroke: 1px #333;"></i>
                <h4 style="margin: 15px 0;">Consultoria Inteligente</h4>
                <p style="font-size: 13px; color: #666; margin-bottom: 20px;">Jornada otimizada com dados.</p>
                <button class="btn-saiba-mais" onclick="openImplTimeline('inteligente')">SAIBA MAIS</button>
            </div>
        </div>
    </div>

    <div id="impl-timeline-view" style="display: none;">
        <button class="btn-saiba-mais" onclick="backToConsultorias()" style="margin-bottom: 30px;">&larr; Voltar</button>

        <h2 id="impl-title-display" style="text-align: center; margin-bottom: 40px;"></h2>

        <div class="timeline-impl" id="timeline-container-personalizada" style="display: none;">
            @foreach($impPersonalizada as $item)
            <div class="impl-item item-timeline-row" data-segments="{{ json_encode($item->segmentos ?? []) }}">
                <div class="impl-icon-box"><i class="{{ $item->icone }}"></i></div>
                <div class="impl-content">
                    <span class="tag-prazo">{{ $item->prazo }}</span>
                    <h4>{{ $item->titulo }}</h4>
                    <p>{{ $item->descricao }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="timeline-impl" id="timeline-container-inteligente" style="display: none;">
            @foreach($impInteligente as $item)
            <div class="impl-item item-timeline-row" data-segments="{{ json_encode($item->segmentos ?? []) }}">
                <div class="impl-icon-box"><i class="{{ $item->icone }}"></i></div>
                <div class="impl-content">
                    <span class="tag-prazo">{{ $item->prazo }}</span>
                    <h4>{{ $item->titulo }}</h4>
                    <p>{{ $item->descricao }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</section>

<section id="content-migracao" class="content-section">
    <div id="migration-list-view">
        <h3 style="text-align:center; margin: 40px 0 30px;">Para clientes que possuem outro sistema em operação</h3>
        <div class="migration-grid">
            @foreach($comSistema as $m)
            <div class="migration-card">
                <i class="fa-solid fa-database card-icon"></i>
                <p style="font-weight:700; margin-bottom:15px; font-size: 14px;">{{ $m->nome }}</p>
                <button class="btn-saiba-mais" onclick="openMigrationDetail({{ $m->id }})">SAIBA MAIS</button>
            </div>
            @endforeach
        </div>

        <h3 style="text-align:center; margin: 60px 0 30px;">Para clientes que não possuem sistema</h3>
        <div class="migration-grid">
            @foreach($semSistema as $m)
            <div class="migration-card">
                <i class="fa-solid fa-table card-icon"></i>
                <p style="font-weight:700; margin-bottom:15px; font-size:14px;">{{ $m->nome }}</p>
                <button class="btn-saiba-mais" onclick="openMigrationDetail({{ $m->id }})">SAIBA MAIS</button>
            </div>
            @endforeach
        </div>
    </div>

    <div id="migration-details-view" style="display:none;">
        <button class="btn-saiba-mais" onclick="closeMigrationDetail()" style="margin-bottom:20px;">&larr; Voltar</button>
        <div id="dynamic-content"></div>
    </div>
</section>

<section id="content-catraca" class="content-section">
    <div style="background-color: #ebebeb; padding: 30px; border-radius: 15px; margin-bottom: 40px;">
        <div style="margin-bottom: 20px;">
            <h3 style="color: #333; text-align: center;">Requisitos obrigatórios para integração de controle de acesso</h3>
        </div>
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
            @foreach($requisitos as $req)
            <div style="background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                <i class="{{ $req->icone }}" style="font-size: 24px; color: #eebb00; margin-bottom: 10px;"></i>
                <h4 style="font-size: 16px; margin: 10px 0;">{{ $req->titulo }}</h4>
                <p style="font-size: 13px; color: #666;">{{ $req->descricao }}</p>
            </div>
            @endforeach
        </div>
    </div>

    <div style="margin-bottom: 40px;">
        <span class="card-tag">Aplicativo para controle de acesso</span>
        <div style="margin-bottom: 20px;">
            <h3 class="col-title">Tecnofit Catraca</h3>
        </div>
        @foreach($perguntasCatraca as $perg)
        <div style="border: 1px solid #eee; padding: 20px; border-radius: 8px; margin-bottom: 15px; background: #fff;">
            <h4 style="margin: 0 0 10px 0;">{{ $perg->titulo }}</h4>
            <p style="margin: 0; color: #666;">{{ $perg->descricao }}</p>
        </div>
        @endforeach
    </div>

    <div>
        <span class="card-tag">Periféricos</span>
        <div style="margin-bottom: 20px;">
            <h3 class="col-title">Equipamentos Homologados</h3>
        </div>

        <div style="display: flex; gap: 10px; margin-bottom: 20px;">
            <button id="btn-catracas" class="tab-btn-equip active" onclick="filtrarEquip(this, 'catracas')">Catracas</button>
            <button id="btn-facial" class="tab-btn-equip" onclick="filtrarEquip(this, 'facial')">Leitores Faciais</button>
            <button id="btn-biometria" class="tab-btn-equip" onclick="filtrarEquip(this, 'biometria')">Biométricos</button>
            <button id="btn-impressoras" class="tab-btn-equip" onclick="filtrarEquip(this, 'impressoras')">Impressoras</button>
        </div>

        <table class="hardware-table">
            <thead>
                <tr>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Tipo de Conexão</th>
                </tr>
            </thead>
            <tbody id="lista-equipamentos">
                @foreach($equipamentos as $equip)
                <tr class="equip-item item-{{ $equip->categoria }}">
                    <td style="color: #5d50c6; font-weight: 700;">{{ $equip->marca }}</td>
                    <td>{{ $equip->modelo }}</td>
                    <td>{{ $equip->conexao }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
<section id="content-whitelabel" class="content-section">
    <div style="text-align: center; margin-bottom: 30px;">
        <h2 class="section-title">Passo a passo - Aplicativo White Label</h2>
    </div>

    <div class="timeline-steps">
        @foreach($passosApp as $passo)

        <div class="step-item">

            <div class="step-number {{ $passo->responsabilidade == 'cliente' ? 'ball-client' : 'ball-tecnofit' }}">
                {{ $passo->numero }}
            </div>

            <div style="flex: 1;">
                <div class="step-info">
                    <h4>{{ $passo->titulo }}</h4>
                    <p style="color: #666; margin-bottom: 15px;">{{ $passo->descricao }}</p>

                    <div style="display: flex; gap: 10px; align-items: center;">
                        <span style="font-size: 11px; font-weight: 700; padding: 4px 8px; border-radius: 4px; text-transform: uppercase; color: #333; background-color: {{ $passo->responsabilidade == 'tecnofit' ? '#fceea2' : '#e9ecef' }};">
                            <i class="fas fa-user-tag"></i> {{ ucfirst($passo->responsabilidade) }}
                        </span>

                        @if($passo->prazo)
                        <span style="font-size: 11px; font-weight: 700; padding: 4px 8px; border-radius: 4px; text-transform: uppercase; color: #4338ca; background-color: #e0e7ff;">
                            <i class="far fa-clock"></i> {{ $passo->prazo }}
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
    </div>

    <script>
        // Troca de Abas Principais
        function switchTab(tabName) {
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.content-section').forEach(sec => sec.classList.remove('active'));
            document.getElementById('btn-' + tabName).classList.add('active');
            document.getElementById('content-' + tabName).classList.add('active');

            if (tabName !== 'migracao') {
                closeMigrationDetail();
            }
        }

        // Troca de Tabelas de Hardware
        function switchHardware(id) {
            document.querySelectorAll('.hardware-content').forEach(c => c.classList.remove('active'));
            document.querySelectorAll('.sub-tab-btn').forEach(b => b.classList.remove('active'));
            document.getElementById(id).classList.add('active');
            event.currentTarget.classList.add('active');
        }

        // Detalhes da Migração DINÂMICO
        function openMigrationDetail(id) {
            document.getElementById('migration-list-view').style.display = 'none';
            document.getElementById('migration-details-view').style.display = 'block';

            const content = document.getElementById('dynamic-content');
            content.innerHTML = '<p style="text-align:center;">Carregando informações...</p>';

            fetch(`/api/migracao/${id}`)
                .then(response => response.json())
                .then(data => {
                    let html = `<h2 style="margin-bottom: 20px;">Detalhamento: ${data.nome}</h2>`;
                    html += `<table class="hardware-table">
                                <thead>
                                    <tr>
                                        <th>Dados</th>
                                        <th style="text-align:center">Importa?</th>
                                        <th>Observação</th>
                                    </tr>
                                </thead>
                                <tbody>`;

                    data.itens.forEach(item => {
                        html += `
                            <tr ${!item.importa ? 'style="background-color: #fff5f5;"' : ''}>
                                <td>${item.dado}</td>
                                <td style="text-align:center">
                                    ${item.importa ?
                                        '<i class="fas fa-check-circle" style="color: #28a745;"></i>' :
                                        '<i class="fas fa-times-circle" style="color: #dc3545;"></i>'}
                                </td>
                                <td>${item.observacao || '-'}</td>
                            </tr>`;
                    });
                    html += `</tbody></table>`;

                    if(data.observacao_alerta) {
                        html += `
                            <div class="alert-box" style="background:#fff9c4; padding:20px; border-left:5px solid #fbc02d; margin-top:30px;">
                                <i class="fas fa-exclamation-triangle"></i>
                                <strong>Atenção:</strong> ${data.observacao_alerta}
                            </div>`;
                    }
                    content.innerHTML = html;
                });
        }

        function closeMigrationDetail() {
        document.getElementById('migration-list-view').style.display = 'block';
        document.getElementById('migration-details-view').style.display = 'none';
        document.getElementById('dynamic-content').innerHTML = '';
    }

        function filtrarEquip(categoria) {
            // Atualiza botões
            document.querySelectorAll('.tab-btn-equip').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');

            // Esconde todos
            document.querySelectorAll('.equip-item').forEach(item => item.style.display = 'none');

            // Mostra só a categoria
            document.querySelectorAll('.item-' + categoria).forEach(item => {
                item.style.display = 'flex';
            });
        }

        function filtrarEquip(elemento, categoria) {
        // 1. Atualiza visual dos botões
        // Se a função for chamada pelo clique (elemento existe), usa ele.
        // Se for chamada automática, procura pelo ID.
        let btn;
        if (elemento) {
            btn = elemento;
        } else {
            btn = document.getElementById('btn-' + categoria);
        }

        if(btn) {
            document.querySelectorAll('.tab-btn-equip').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        }

        // 2. Filtra a tabela
        // Esconde todas as linhas
        document.querySelectorAll('.equip-item').forEach(row => row.style.display = 'none');

        // Mostra só a categoria desejada (display: table-row para manter alinhamento da tabela)
        document.querySelectorAll('.item-' + categoria).forEach(row => {
            row.style.display = 'table-row';
        });
    }

    // Inicializa mostrando Catracas (sem passar elemento, ele busca pelo ID)
    document.addEventListener("DOMContentLoaded", function() {
        filtrarEquip(null, 'catracas');
    });
   let currentSegment = null;

// 1. Usuário clica no Segmento
function selectSegment(segment) {
    currentSegment = segment; // Salva 'gym', 'box', etc.

    // Esconde segmentos, mostra consultorias
    document.getElementById('view-segmentos').style.display = 'none';
    document.getElementById('view-consultorias').style.display = 'block';

    // Animação simples de fade
    document.getElementById('view-consultorias').style.opacity = 0;
    setTimeout(() => document.getElementById('view-consultorias').style.opacity = 1, 50);
}

// 2. Voltar de Consultorias para Segmentos
function backToSegments() {
    currentSegment = null;
    document.getElementById('view-consultorias').style.display = 'none';
    document.getElementById('view-segmentos').style.display = 'block';
}

// 3. Usuário clica na Consultoria (Abre a Timeline Filtrada)
function openImplTimeline(tipo) {
    document.getElementById('view-consultorias').style.display = 'none';
    document.getElementById('impl-timeline-view').style.display = 'block';

    // Esconde ambas as listas de timeline
    document.getElementById('timeline-container-personalizada').style.display = 'none';
    document.getElementById('timeline-container-inteligente').style.display = 'none';

    // Define qual container vamos usar
    let containerId = (tipo === 'personalizada')
        ? 'timeline-container-personalizada'
        : 'timeline-container-inteligente';

    let container = document.getElementById(containerId);
    container.style.display = 'block';

    // ATUALIZA TÍTULO
    let titulo = (tipo === 'personalizada') ? 'Consultoria Personalizada' : 'Consultoria Inteligente';
    // Adiciona o nome do segmento ao título para contexto
    let nomeSegmento = currentSegment.charAt(0).toUpperCase() + currentSegment.slice(1).replace('_', ' ');
    document.getElementById('impl-title-display').innerText = `Jornada: ${titulo} (${nomeSegmento})`;

    // FILTRAGEM DOS ITENS
    // Pega todos os itens dentro do container selecionado
    let items = container.querySelectorAll('.item-timeline-row');

    items.forEach(item => {
        // Pega o array de segmentos salvo no atributo data-segments
        let itemSegments = JSON.parse(item.getAttribute('data-segments'));

        // Se o array for nulo ou vazio, ou se incluir o segmento atual, mostra.
        // Se não incluir, esconde.
        if (!itemSegments || itemSegments.length === 0 || itemSegments.includes(currentSegment)) {
            item.style.display = 'flex';
        } else {
            item.style.display = 'none';
        }
    });
}

// 4. Voltar da Timeline para Consultorias
function backToConsultorias() {
    document.getElementById('impl-timeline-view').style.display = 'none';
    document.getElementById('view-consultorias').style.display = 'block';
}

// Resetar o SwitchTab principal para garantir que ao trocar de aba tudo resete
const originalSwitchTab = window.switchTab; // Guarda a função original se existir
window.switchTab = function(tabName) {
    // Chama a lógica original de troca de abas
    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelectorAll('.content-section').forEach(sec => sec.classList.remove('active'));
    document.getElementById('btn-' + tabName).classList.add('active');
    document.getElementById('content-' + tabName).classList.add('active');

    // Se saiu da aba de implementação, reseta ela para o início
    if(tabName !== 'implementacao') {
        backToSegments(); // Reseta para a tela inicial
    }
}
// Aguarda o carregamento completo do HTML antes de rodar o script
    document.addEventListener("DOMContentLoaded", function() {

        const steps = document.querySelectorAll('.step-item');

        // Função principal que verifica a rolagem
        function checkScroll() {
            // Define o ponto de gatilho (85% da altura da tela)
            const triggerBottom = window.innerHeight * 0.85;

            steps.forEach(step => {
                // Pega a posição do topo do item em relação à tela
                const stepTop = step.getBoundingClientRect().top;

                // Se o item já apareceu na tela (passou do ponto de gatilho)
                if (stepTop < triggerBottom) {
                    step.classList.add('active');
                } else {
                    // Opcional: remove a classe se rolar para cima de novo
                    step.classList.remove('active');
                }
            });
        }

        // Adiciona o "ouvinte" no scroll do mouse
        window.addEventListener('scroll', checkScroll);

        // Roda a função uma vez imediatamente para ativar os itens que já estão visíveis no topo
        checkScroll();
    });

    </script>
</body>
</html>
