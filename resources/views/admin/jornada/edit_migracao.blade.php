<x-header />
<link rel="stylesheet" href="{{ asset('style.css') }}">

<div class="master-container" style="margin-top: 50px;">
    <div style="margin-bottom: 20px;">
        <a href="{{ route('admin.index') }}" class="btn-saiba-mais" style="text-decoration: none; background: #eee; color: #333;">
            <i class="fas fa-arrow-left"></i> ← VOLTAR
        </a>
    </div>

    <div class="content-card" style="width: 100%; max-width: 900px; margin: 0 auto; padding: 40px;">
        <form action="{{ route('migracao.update', $migracao->id) }}" method="POST">
            @csrf
            @method('PUT')

            <h2 class="col-title" style="margin-bottom: 30px; border-bottom: 2px solid #f8e75e; padding-bottom: 10px;">
                Detalhamento de Importação: 
                <input type="text" name="nome" value="{{ $migracao->nome }}" 
                       style="font-size: 20px; border: 1px solid #ddd; border-radius: 8px; padding: 5px 15px; width: 50%; font-family: 'Montserrat', sans-serif;">
            </h2>
            <div class="table-responsive" style="margin-bottom: 30px;">
                <table class="hardware-table" id="tabela-itens" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Dados</th>
                            <th style="text-align: center;">Importa?</th>
                            <th>Observação / Detalhes</th>
                            <th style="text-align: center;">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($migracao->itens as $index => $item)
                        <tr>
                            <td>
                                <input type="text" name="itens[{{$index}}][dado]" value="{{ $item->dado }}" style="width: 100%; padding: 8px; border: 1px solid #eee; border-radius: 5px;">
                            </td>
                            <td style="text-align: center;">
                                <select name="itens[{{$index}}][importa]" style="padding: 8px; border-radius: 5px; border: 1px solid #eee;">
                                    <option value="1" {{ $item->importa ? 'selected' : '' }}>Sim</option>
                                    <option value="0" {{ !$item->importa ? 'selected' : '' }}>Não</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="itens[{{$index}}][observacao]" value="{{ $item->observacao }}" style="width: 100%; padding: 8px; border: 1px solid #eee; border-radius: 5px;">
                            </td>
                            <td style="text-align: center;">
                                <button type="button" onclick="this.closest('tr').remove()" 
                                        style="background: #ff7d41; border: none; color: white; padding: 8px 12px; border-radius: 6px; cursor: pointer; transition: 0.3s;">Excluir
                                    <i class="fas fa-trash-alt"></i> 
                                </button>
                            </td>
                        </tr>
                        <div class="item-row">
    <input type="text" name="itens[{{ $loop->index }}][nome]" value="{{ $item->nome }}">
    
    <div class="file-input-group">
        <label>Arquivo/Modelo:</label>
        <input type="file" name="itens[{{ $loop->index }}][arquivo]">
        
        <input type="hidden" name="itens[{{ $loop->index }}][arquivo_antigo]" value="{{ $item->arquivo }}">
        
        @if($item->arquivo)
            <small style="color: green;">Arquivo atual: Salvo</small>
        @endif
    </div>
</div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <button type="button" onclick="addLinha()" class="btn-saiba-mais" style="background: #f0f0f0; color: #333; margin-bottom: 30px;">
                + Incluir Nova Linha
            </button>

            <div class="alert-box" style="background: #fff9c4; border-left: 5px solid #fbc02d; padding: 25px; border-radius: 10px; margin-bottom: 30px;">
                <p style="font-weight: 700; margin-bottom: 10px;"><i class="fas fa-exclamation-triangle"></i> Atenção:</p>
                <textarea name="observacao_alerta" 
                          style="width: 100%; height: 80px; background: transparent; border: 1px dashed #ccc; padding: 10px; font-family: 'Montserrat', sans-serif;">{{ $migracao->observacao_alerta }}</textarea>
            </div>

            <button type="submit" class="btn-saiba-mais" style="width: 100%; padding: 18px; font-size: 16px; letter-spacing: 1px;">
                SALVAR ALTERAÇÕES
            </button>
        </form>
    </div>
</div>

<script>
    function addLinha() {
        const tbody = document.querySelector('#tabela-itens tbody');
        const index = tbody.rows.length;
        const row = `
            <tr>
                <td><input type="text" name="itens[${index}][dado]" style="width: 100%; padding: 8px; border: 1px solid #eee; border-radius: 5px;"></td>
                <td style="text-align: center;">
                    <select name="itens[${index}][importa]" style="padding: 8px; border-radius: 5px; border: 1px solid #eee;">
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                </td>
                <td><input type="text" name="itens[${index}][observacao]" style="width: 100%; padding: 8px; border: 1px solid #eee; border-radius: 5px;"></td>
                <td style="text-align: center;">
                    <button type="button" onclick="this.closest('tr').remove()" 
                            style="background-color: #ff4d4d; border: none; color: white; padding: 8px 12px; border-radius: 6px; cursor: pointer;">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>`;
        tbody.insertAdjacentHTML('beforeend', row);
    }
</script>