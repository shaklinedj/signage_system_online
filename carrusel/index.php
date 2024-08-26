<?php
require_once "../admin/db.php";
$casinos = get_casinos();
$selectedCasinoId = $_COOKIE['casino_id'] ?? null;
$media = array_merge(
    array_filter(get_imgs_back(), fn($img) => $img->casino_id == $selectedCasinoId),
    array_filter(get_vids_back(), fn($vid) => $vid->casino_id == $selectedCasinoId)
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carouseles</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../admin/slotmachine.ico">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php if (!empty($media)): ?>
    <div id="carousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <?php foreach($media as $index => $item): ?>
            <div class="item <?= $index === 0 ? 'active' : '' ?>">
                <?php if (property_exists($item, 'src') && strpos($item->src, '.mp4') !== false): ?>
                <video class="full-width-video" muted>
                    <source src="<?= "../admin/{$item->folder}{$item->src}" ?>" type="video/mp4">
                </video>
                <?php else: ?>
                <img src="<?= "../admin/{$item->folder}{$item->src}" ?>" alt="Media" loading="lazy">
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php else: ?>
    <h4 class="alert alert-warning">No hay imagenes ni videos</h4>
    <?php endif; ?>

    <div class="modal fade" id="casinoModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Selecciona un casino</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Elige tu casino favorito:</p>
                    <select id="casinoSelect" class="form-control">
                        <?php foreach ($casinos as $id => $casino): ?>
                        <option value="<?= $id ?>"><?= $casino ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="guardarCasino()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>
    <script src="optimized-index.js"></script>
</body>
</html>
