<!DOCTYPE html>
<html lang="en">
<head>
    <title>Card Flip</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="styles2.css" />
</head>
<body>
    <?php
        // Captura o link da imagem da URL usando o parâmetro 'image'
        $imageLink = isset($_GET['image']) ? $_GET['image'] : ''; 
    ?>

    <div class="card-3d-wrap">
        <input class="checkbox" type="checkbox" id="card-toggle" />
        <label for="card-toggle" class="rotate-button">
            <div class="card-3d-wrapper">
                <div class="card-front">
                    <img class="card-yu" src="<?php echo htmlspecialchars($imageLink); ?>" alt="Carta Frente" />
                </div>
                <div class="card-back">
                    <img class="card-yu" src="https://i.pinimg.com/originals/3d/a3/9c/3da39cea425e1fc2b8c7b01d7b0d6c5c.png" alt="Carta Verso" />
                </div>
            </div>
        </label>
    </div>
</body>
</html>
