<?php
/* ==========================================================
   PROJETS — modifie uniquement cette zone
   [titre, description, fichier (dans public/docs/), type "PDF" ou "PPT"]
   ========================================================== */

$projets = [
  $site = "https://portfoliomeriem.vercel.app";   // l'adresse dyal site dyalk
  ["Projet 1", "Création de l'identité visuelle d'une application, comprenant la conception du logo, le choix du nom et la création d'un slogan adapté à son identité et à ses objectifs.", "/docs/projet1.pptx", "PPT"],
  ["Projet 2", "Organisation et planification d'un projet selon le modèle en cascade, en suivant les différentes étapes du cycle de développement de manière structurée et progressive.", "/docs/projet2.pdf",  "PDF"],
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
    <?php foreach ($projets as [$titre, $desc, $file, $type]):
  // PDF: kayt7ll f navigateur. PPT: kayt7ll f visionneuse Office en ligne
  $view = $type === "PPT"
    ? "https://view.officeapps.live.com/op/view.aspx?src=" . urlencode($site . $file)
    : $file;
?>
  <div class="card">
    <i class="bi <?= $type === "PPT" ? "bi-file-earmark-slides" : "bi-file-earmark-pdf" ?>"></i>
    <h3><?= h($titre) ?></h3>
    <p><?= h($desc) ?></p>
    <div class="actions">
      <a class="btn btn-pink" href="<?= h($view) ?>" target="_blank" rel="noopener"><i class="bi bi-eye"></i> Voir</a>
      <a class="btn btn-line" href="<?= h($file) ?>" download><i class="bi bi-download"></i> Télécharger</a>
    </div>
  </div>
<?php endforeach; ?>
  </div>
</div>
</body>
</html>
