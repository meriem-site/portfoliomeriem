<?php
/* ==========================================================
   PROJETS — modifie uniquement cette zone
   [titre, description, fichier (dans public/docs/), type "PDF" ou "PPT"]
   ========================================================== */
$projets = [
  ["Projet 1", "Description courte du projet 1.", "/docs/projet1.pdf",  "PDF"],
  ["Projet 2", "Description courte du projet 2.", "/docs/projet2.pptx", "PPT"],
  ["Projet 3", "Description courte du projet 3.", "/docs/projet3.pdf",  "PDF"],
];

function h($v){ return htmlspecialchars($v, ENT_QUOTES, "UTF-8"); }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Mes projets — Portfolio</title>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600&family=Figtree:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="/assets/sub.css">
</head>
<body>
<div class="wrap">
  <a class="back" href="/#projets"><i class="bi bi-arrow-left"></i> Retour</a>
  <h1>Mes projets</h1>
  <p class="lead">Clique sur un projet pour l'ouvrir.</p>
  <div class="grid">
    <?php foreach ($projets as [$titre, $desc, $file, $type]): ?>
      <a class="card" href="<?= h($file) ?>" target="_blank"<?= $type === "PPT" ? " download" : "" ?>>
        <i class="bi <?= $type === "PPT" ? "bi-file-earmark-slides" : "bi-file-earmark-pdf" ?>"></i>
        <h3><?= h($titre) ?></h3>
        <p><?= h($desc) ?></p>
        <span>Ouvrir le <?= h($type) ?></span>
      </a>
    <?php endforeach; ?>
  </div>
</div>
</body>
</html>
