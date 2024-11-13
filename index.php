<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Marketplace de Cartas Yu-Gi-Oh!</title>
</head>
<body>
    <header>
        <a href="index.php"><img src="https://www.yugioh-card.com/lat-am/pt/wp-content/uploads/2020/04/logo-main.png"></a>
        <div><input type="text" class="buscar-cad" id="search-name" placeholder="Buscar carta" oninput="filtrarCartas()"></div>
    </header>
    <main>
        
        <div class="filter-container" >
        <h2 class="title-fil">Filtros</h2>
        <div>
            <div id="filtros-ativos" style="margin-top: 10px;"></div>
        </div>
        <button class="btn-filtros" id="btn-limpar-filtros" onclick="limparFiltros()" style="display: none;">Limpar Todos</button>

        <button class="btn-tipo" onclick="toggleTipo()">Tipo</button>
            <div id="filtro-tipo"  style="display: none;">
                <div class="filtros">
                    <label><input oninput="filtrarCartas()" type="checkbox" value="Monstro" class="filter-tipo"> Monstro</label>
                    <label><input oninput="filtrarCartas()" type="checkbox" value="Magia" class="filter-tipo"> Magia</label>
                    <label><input oninput="filtrarCartas()" type="checkbox" value="Armadilha" class="filter-tipo"> Armadilha</label>
                </div>
            </div>
        <button class="btn-atributo" onclick="toggleAtributo()">Atributo</button>
            <div class="list-atri" id="filtro-atributo" style="display: none;">
                <div class="filtros">
                <label><input oninput="filtrarCartas()" type="checkbox" value="Aqua" class="filter-atributo"> Aqua</label>
                <label><input oninput="filtrarCartas()" type="checkbox" value="Beast" class="filter-atributo"> Beast</label>
                <label><input oninput="filtrarCartas()" type="checkbox" value="Beast-Warrior" class="filter-atributo"> Beast-Warrior</label>
                <label><input oninput="filtrarCartas()" type="checkbox" value="Dragon" class="filter-atributo"> Dragon</label>
                <label><input oninput="filtrarCartas()" type="checkbox" value="Fairy" class="filter-atributo"> Fairy</label>
                <label><input oninput="filtrarCartas()" type="checkbox" value="Fiend" class="filter-atributo"> Fiend</label>
                <label><input oninput="filtrarCartas()" type="checkbox" value="Insect" class="filter-atributo"> Insect</label>
                <label><input oninput="filtrarCartas()" type="checkbox" value="Machine" class="filter-atributo"> Machine</label>
                <label><input oninput="filtrarCartas()" type="checkbox" value="Plant" class="filter-atributo"> Plant</label>
                <label><input oninput="filtrarCartas()" type="checkbox" value="Psychic" class="filter-atributo"> Psychic</label>
                <label><input oninput="filtrarCartas()" type="checkbox" value="Reptile" class="filter-atributo"> Reptile</label>
                <label><input oninput="filtrarCartas()" type="checkbox" value="Rock" class="filter-atributo"> Rock</label>
                <label><input oninput="filtrarCartas()" type="checkbox" value="Sea Serpent" class="filter-atributo"> Sea Serpent</label>
                <label><input oninput="filtrarCartas()" type="checkbox" value="Spellcaster" class="filter-atributo"> Spellcaster</label>
                <label><input oninput="filtrarCartas()" type="checkbox" value="Thunder" class="filter-atributo"> Thunder</label>
                <label><input oninput="filtrarCartas()" type="checkbox" value="Warrior" class="filter-atributo"> Warrior</label>
                <label><input oninput="filtrarCartas()" type="checkbox" value="Winged Beast" class="filter-atributo"> Winged Beast</label>
                <label><input oninput="filtrarCartas()" type="checkbox" value="Zombie" class="filter-atributo"> Zombie</label>
            </div>
        </div>
        </div>
        </div>
        </div>
        <div class="form-container" id="card-list"></div>
    </main>
    <script src="script.js"></script>
</body>
</html>
