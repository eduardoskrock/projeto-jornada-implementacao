<x-header />
<link rel="stylesheet" href="{{ asset('style.css') }}">

<div class="master-container" style="margin-top: 50px;">
    <div class="content-card" style="max-width: 600px; margin: 0 auto; padding: 40px;">
        <h2 class="col-title" style="margin-bottom: 30px;">
            Novo Sistema: {{ $secao == 'com_sistema' ? 'Com Sistema' : 'Sem Sistema' }}
        </h2>
        
        <form action="{{ route('migracao.store') }}" method="POST">
            @csrf
            <input type="hidden" name="secao" value="{{ $secao }}">
            
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: bold; margin-bottom: 10px;">Nome do Sistema:</label>
                <input type="text" name="nome" placeholder="Ex: ABC EVO ou Cadastro manual" 
                       style="width: 100%; padding: 15px; border-radius: 10px; border: 1px solid #ddd;" required>
            </div>

            <button type="submit" class="btn-saiba-mais" style="width: 100%; padding: 20px;">
                CRIAR E CONFIGURAR TABELA
            </button>
        </form>
    </div>
</div>