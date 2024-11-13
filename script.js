// Função para normalizar o valor removendo espaços, vírgulas e colocando em minúsculas
function normalize(value) {
    return value.trim().toLowerCase().replace(/[\s,]+/g, ' ');
}

function toggleTipo() {
    const filtroTipo = document.getElementById('filtro-tipo');
    filtroTipo.style.display = filtroTipo.style.display === 'none' ? 'block' : 'none';
}
function toggleAtributo() {
    const filtroAtributo = document.getElementById('filtro-atributo');
    filtroAtributo.style.display = filtroAtributo.style.display === 'none' ? 'block' : 'none';
}

// Função para carregar cartas
async function carregarCartas() {
    try {
        const response = await fetch('get_cartas.php');
        const data = await response.json();
        exibirCartas(data.cartas);
    } catch (error) {
        console.error('Erro ao carregar cartas:', error);
    }
}

// Função para exibir cartas na tela
function exibirCartas(cartas) {
    const cardList = document.getElementById('card-list');
    cardList.innerHTML = ''; // Limpar a lista de cartas

    cartas.forEach(carta => {
        const card = document.createElement('div');
        card.className = 'card';

        // Adiciona os dados como atributos data-* com normalização, separando múltiplos valores por vírgulas
        card.setAttribute('data-nome', normalize(carta.nome));
        card.setAttribute('data-tipo', carta.tipo.toLowerCase());
        card.setAttribute('data-atributo', carta.atributo.toLowerCase());

        card.innerHTML = `
            <img class="card-img" src="${carta.imagemUrl}" alt="${carta.nome}">
            <h3>${carta.nome}</h3>
            <p>Preço: ${carta.preco}</p>
            <button onclick="abrirDetalhes(
                '${carta.nome}','${carta.descricao}','${carta.imagemUrl}','${carta.preco}',
                '${carta.tipo}','${carta.ataque}','${carta.defesa}','${carta.atributo}',
                '${carta.level}','${carta.imgExtra1}','${carta.imgExtra2}','${carta.imgExtra3}','${carta.imgExtra4}'
            )">Ver Mais</button>
        `;
        cardList.appendChild(card);
    });
}

// Função para abrir os detalhes da carta
function abrirDetalhes(nome, descricao, imagemUrl, preco, tipo, ataque, defesa, atributo, level, imgExtra1, imgExtra2, imgExtra3, imgExtra4) {
    localStorage.setItem('cartaNome', nome);
    localStorage.setItem('cartaDescricao', descricao);
    localStorage.setItem('cartaImagemUrl', imagemUrl);
    localStorage.setItem('cartaPreco', preco);
    localStorage.setItem('cartaTipo', tipo);
    localStorage.setItem('cartaAtaque', ataque);
    localStorage.setItem('cartaDefesa', defesa);
    localStorage.setItem('cartaAtributo', atributo);
    localStorage.setItem('cartaLevel', level);
    localStorage.setItem('extra1', imgExtra1);
    localStorage.setItem('extra2', imgExtra2);
    localStorage.setItem('extra3', imgExtra3);
    localStorage.setItem('extra4', imgExtra4);
    // Redirecionar para a página de detalhes
    window.location.href = `detalhes.php?atributo=${atributo}&imagemUrl=${encodeURIComponent(imagemUrl)}`;
}


function mostrarFiltrosAtivos() {
    const tipoSelecionado = Array.from(document.querySelectorAll('.filter-tipo:checked')).map(cb => cb.value);
    const atributoSelecionado = Array.from(document.querySelectorAll('.filter-atributo:checked')).map(cb => cb.value);
    const nomePesquisa = document.getElementById('search-name').value;

    const filtrosAtivos = [...tipoSelecionado, ...atributoSelecionado];
    const filtrosAtivosDiv = document.getElementById('filtros-ativos');
    const btnLimparFiltros = document.getElementById('btn-limpar-filtros');

    if (filtrosAtivos.length > 0 || nomePesquisa) {
        filtrosAtivosDiv.innerHTML = `${filtrosAtivos.join(', ')}`;
        btnLimparFiltros.style.display = 'inline-block'; // Mostrar o botão
    } else {
        filtrosAtivosDiv.innerHTML = '';
        btnLimparFiltros.style.display = 'none'; // Ocultar o botão
    }
}

function limparFiltros() {
    // Desmarcar todos os checkboxes de filtro
    document.querySelectorAll('.filter-tipo, .filter-atributo').forEach(cb => cb.checked = false);
    document.getElementById('search-name').value = '';

    // Mostrar todas as cartas novamente
    Array.from(document.getElementsByClassName('card')).forEach(carta => carta.style.display = '');

    // Atualizar a exibição dos filtros ativos e ocultar o botão de limpar filtros
    mostrarFiltrosAtivos();
}

function filtrarCartas() {
    const tipoSelecionado = Array.from(document.querySelectorAll('.filter-tipo:checked')).map(cb => normalize(cb.value));
    const atributoSelecionado = Array.from(document.querySelectorAll('.filter-atributo:checked')).map(cb => normalize(cb.value));
    const nomePesquisa = normalize(document.getElementById('search-name').value);

    const cartas = Array.from(document.getElementsByClassName('card'));

    cartas.forEach(carta => {
        const tiposCarta = carta.getAttribute('data-tipo').split(',').map(normalize);
        const atributosCarta = carta.getAttribute('data-atributo').split(',').map(normalize);
        const nomeCarta = carta.getAttribute('data-nome');

        const tipoMatch = tipoSelecionado.length === 0 || tipoSelecionado.some(tipo => tiposCarta.includes(tipo));
        const atributoMatch = atributoSelecionado.length === 0 || atributoSelecionado.some(atributo => atributosCarta.includes(atributo));
        const nomeMatch = nomePesquisa === '' || nomeCarta.includes(nomePesquisa);

        carta.style.display = (tipoMatch && atributoMatch && nomeMatch) ? '' : 'none';
    });

    mostrarFiltrosAtivos();
}

window.onload = carregarCartas;
