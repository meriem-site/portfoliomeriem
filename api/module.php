<?php
/* ==========================================================
   MODULES — modifie uniquement cette zone
   ========================================================== */
$modules = [
  1 => ["Module 1", "Titre du module 1"],
  2 => ["Module 2", "Titre du module 2"],
];
$nbAteliers = 6;

/* Photos de correction : "module-atelier" => liste des fichiers
   Les images sont dans public/images/modules/m1/atelier1/ etc. */
$corrections = [
  "1-1" => ["1.jpeg", "2.jpeg", "3.jpeg"],
  "1-2" => ["1.jpeg", "2.jpeg", "3.jpeg", "4.jpeg"],
  "1-3" => [],
  "1-4" => [],
  "1-5" => [],
  "1-6" => [],
  "2-1" => [],
  "2-2" => [],
  "2-3" => [],
  "2-4" => [],
  "2-5" => [],
  "2-6" => [],
];

function h($v){ return htmlspecialchars($v, ENT_QUOTES, "UTF-8"); }

$m = (int)($_GET["m"] ?? 1);
if (!isset($modules[$m])) $m = 1;

$a = (int)($_GET["a"] ?? 0);
if ($a < 0 || $a > $nbAteliers) $a = 0;

$photos = [];
if ($a) {
  $photos = array_map(
    fn($f) => "/images/modules/m$m/atelier$a/" . rawurlencode($f),
    $corrections["$m-$a"] ?? []
  );
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= h($modules[$m][0]) ?><?= $a ? " — Atelier $a" : "" ?> — Portfolio</title>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600&family=Figtree:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="/assets/sub.css">
</head>
<body>
<div class="wrap">
  <a class="back" href="<?= $a ? "/module?m=$m" : "/#projets" ?>"><i class="bi bi-arrow-left"></i> Retour</a>

  <?php if (!$a): ?>
    <h1><?= h($modules[$m][0]) ?></h1>
    <p class="lead"><?= h($modules[$m][1]) ?></p>
    <div class="grid">
      <?php for ($i = 1; $i <= $nbAteliers; $i++): ?>
        <a class="card" href="/module?m=<?= $m ?>&amp;a=<?= $i ?>">
          <i class="bi bi-journal-code"></i>
          <h3>Atelier <?= $i ?></h3>
          <span>Voir la correction</span>
        </a>
      <?php endfor; ?>
    </div>
  <?php else: ?>
    <h1>Atelier <?= $a ?> — <?= h($modules[$m][0]) ?></h1>
    <p class="lead">Correction des TP.</p>
    <div class="photos">
      <?php foreach ($photos as $p): ?>
        <a href="<?= h($p) ?>" target="_blank"><img src="<?= h($p) ?>" alt="Correction atelier <?= $a ?>" loading="lazy"></a>
      <?php endforeach; ?>
      <?php if (!$photos): ?><p class="empty">Aucune photo pour le moment.</p><?php endif; ?>
    </div>
    <?php if ($m === 1 && $a === 2): ?>
      <p class="prototype-link">Voici le lien vers le prototype de notre projet Vendo :
        <a href="https://www.figma.com/proto/wqSIZy2mydbThOAkEP1s6y/Sans-titre?page-id=285%3A980&amp;node-id=313-205&amp;viewport=397%2C230%2C0.11&amp;t=JeAeA4OkbpogpE1T-1&amp;scaling=min-zoom&amp;content-scaling=fixed&amp;starting-point-node-id=313%3A205" target="_blank" rel="noopener noreferrer">Voir le prototype sur Figma <i class="bi bi-box-arrow-up-right"></i></a>
      </p>
    <?php endif; ?>
  <?php endif; ?>
</div>
</body>
</html>
