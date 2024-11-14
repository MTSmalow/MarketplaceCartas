<?php
use chillerlan\QRCode\{QRCode, QROptions};
require 'database.php';
require 'vendor/autoload.php';

$imagemUrl = isset($_GET['imagemUrl']) ? $_GET['imagemUrl'] : null; '';
$urlF = "http://localhost//qrcode/base/qrcode%20externo/cartinha.php?image=$imagemUrl";
$qrcode = (new QRCode)->render($urlF);


$db = new Database();
$atributoUrl = isset($_GET['atributo']) ? $_GET['atributo'] : null; '';
$atributos = array_map('trim', explode(',', $atributoUrl));
$sql = "SELECT * FROM cartas WHERE " . implode(" OR ", array_map(function($atributo) {
    return "atributo LIKE '%" . $atributo . "%'";
}, $atributos));

$stmt = $db->__construct()->query($sql);
$cartas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Detalhes da Carta</title>
</head>
<body>
    <header>
        <a href="index.php"><img src="https://www.yugioh-card.com/lat-am/pt/wp-content/uploads/2020/04/logo-main.png"></a>
        <h1 class="text-det">Detalhes da Carta</h1>
    </header>
    <main>
        <div class="detalhes-img">
            <img id="carta-imagem" src="" alt="">
        </div>
        <div class="detalhes-carta">
            <h2 id="carta-nome"></h2>
            <p id="carta-descricao"></p>
            <div class="info-card">
                <p id="carta-preco"></p>
                <p id="carta-tipo"></p>
                <p id="carta-ataque"></p>
                <p id="carta-defesa"></p>
                <p id="carta-atributo"></p>
                <p id="carta-level"></p>
            </div>
            <button class="voltar" onclick="voltar()">Voltar</button>
    
            <a href="<?php echo $urlF ?>"><h3>QR Code da carta</h3></a>
            <div class="qr-detalhes">
                <img class="qrcode" src="<?php echo $qrcode; ?>" alt="QR Code da Carta">
            </div>
        </div>
        <div style="display: ;" id="artsAlternativas" class="art">
            <h1>Arts alternativas:</h1>
        <div class="artExtra">
            <img id="extra1" src="" >
            <img id="extra2" src="" >
            <img id="extra3" src="" >
            <img id="extra4" src="" >
        </div>
        </div>

    </main>
    <section>
    <h1 class="text-det">Sugestões</h1>
        <ul class="ul-sugestoes">
            <?php foreach ($cartas as $carta): ?>
                <div class="suCard">
                    <p>
                        <img src="<?php echo htmlspecialchars($carta['imagemUrl']); ?>" alt="<?php echo htmlspecialchars($carta['nome']); ?>" width="100">
                            <p><?php echo htmlspecialchars($carta['nome']); ?></p>
                            <p>Preço: <?php echo htmlspecialchars($carta['preco']); ?></p>
                    </p>
                    <button onclick="abrirDetalhes(<?php echo "'".htmlspecialchars($carta['nome'])."','".htmlspecialchars($carta['descricao'])."','".htmlspecialchars($carta['imagemUrl'])."','".htmlspecialchars($carta['preco'])."','".htmlspecialchars($carta['tipo'])."','" .htmlspecialchars($carta['ataque'])."','".htmlspecialchars($carta['defesa'])."','".htmlspecialchars($carta['atributo'])."','".htmlspecialchars($carta['level'])."','".htmlspecialchars($carta['imgExtra1'])."','".htmlspecialchars($carta['imgExtra2'])."','".htmlspecialchars($carta['imgExtra3'])."','".htmlspecialchars($carta['imgExtra4'])."'," ?>)">ver mais</button>
                </div>
            <?php endforeach; ?>
        </ul>
    </section>
    <script src="script.js"></script>
    <script>
        function carregarDetalhes() {
            const nome = localStorage.getItem('cartaNome');
            const descricao = localStorage.getItem('cartaDescricao');
            const imagemUrl = localStorage.getItem('cartaImagemUrl');
            const preco = localStorage.getItem('cartaPreco');
            const tipo = localStorage.getItem('cartaTipo');
            const ataque = localStorage.getItem('cartaAtaque');
            const defesa = localStorage.getItem('cartaDefesa');
            const atributo = localStorage.getItem('cartaAtributo');
            const level = localStorage.getItem('cartaLevel');
            const extra1 = localStorage.getItem('extra1');
            const extra2 = localStorage.getItem('extra2');
            const extra3 = localStorage.getItem('extra3');
            const extra4 = localStorage.getItem('extra4');

            document.getElementById('carta-nome').textContent = nome;
            document.getElementById('carta-descricao').textContent = descricao;
            document.getElementById('carta-imagem').src = imagemUrl;
            document.getElementById('carta-preco').textContent = `Preço: ${preco}`;
            document.getElementById('carta-tipo').textContent = `Tipo: ${tipo}`;
            document.getElementById('carta-ataque').textContent = `Ataque: ${ataque}`;
            document.getElementById('carta-defesa').textContent = `Defesa: ${defesa}`;
            document.getElementById('carta-atributo').textContent = `Atributo: ${atributo}`;
            document.getElementById('carta-level').textContent = `Level: ${level}`;
            const artsAlternativasText = document.getElementById('artsAlternativas');

            if(extra1){
                document.getElementById('extra1').src = extra1;
                document.getElementById('extra2').src = extra2;
                document.getElementById('extra3').src = extra3;
                document.getElementById('extra4').src = extra4;
                artsAlternativas.style.display = 'block'; 
            }else{
                document.getElementById('extra1').textContent = "";
                document.getElementById('extra2').textContent = "";
                document.getElementById('extra3').textContent = "";
                document.getElementById('extra4').textContent = "";
                artsAlternativas.style.display = 'none'; 
            }
        }

        function voltar() {
            window.history.back();
        }

        window.onload = carregarDetalhes;
    </script>
</body>
</html>
