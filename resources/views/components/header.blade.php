<header class="container-header">
    <div class="main-menu">
        <img src="{{ asset('logo.png') }}" alt="Logo Tecnofit" id="logo">
        <div class="search-wrapper">
            <i class="fas fa-search search-icon"></i>
            <input type="text" id="searchInput" placeholder="Buscar etapa, requisito ou item...">
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');

            // Mapeamento de tudo que queremos filtrar
            // Adicione aqui as classes dos elementos que devem sumir/aparecer
            const searchableSelectors = [
                '.migration-card',      // Cards da aba Migração
                '.req-card',            // Cards de Requisitos
                '.step-item',           // Itens da Timeline White Label
                '.impl-item',           // Itens da Timeline Implementação
                '.hardware-table tr'    // Linhas da tabela de equipamentos (opcional)
            ];

            searchInput.addEventListener('keyup', function(e) {
                const term = e.target.value.toLowerCase().trim();

                // Seleciona todos os itens pesquisáveis na página inteira
                const allItems = document.querySelectorAll(searchableSelectors.join(','));

                allItems.forEach(item => {
                    // Pega todo o texto dentro do item
                    const text = item.textContent.toLowerCase();

                    // Verifica se é uma linha de tabela de cabeçalho (para não esconder o th)
                    if(item.tagName === 'TR' && item.querySelector('th')) return;

                    if (text.includes(term)) {
                        // Se combina, mostra
                        item.style.display = '';

                        // (Opcional) Realça a borda levemente para indicar sucesso
                        // item.style.borderLeft = '4px solid #5d50c6';
                    } else {
                        // Se não combina, esconde
                        item.style.display = 'none';
                    }
                });

                // Lógica Extra: Se o usuário limpar a busca, garante que o estilo volte ao normal
                if (term === '') {
                    allItems.forEach(item => item.style.display = '');
                }
            });
        });
</script>
</header>
