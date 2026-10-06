<?php
/* ==========================================================
   PORTFOLIO — modifie uniquement cette zone pour personnaliser
   ========================================================== */
$name    = "Merieme Ait El Madani";
$email   = "Aitelmadanimariam@gmail.com";
$phone   = "0604628472";
$city    = "Tanger, Aouama";
$hobbies = ["Dessin","Photographie","Voyage","Sport"];
$github  = "https://github.com/meriem-site";
$linkedin= "https://www.linkedin.com/in/mariam-ait-el-madani-459003328";
$cv      = "/docs/CV_MeriemeAitElMadani.pdf";           // remplace par ton CV
$initials= "MA";

$skills = [
  "Frontend" => [["HTML","bi-filetype-html"],["CSS","bi-filetype-css"],["JavaScript","bi-filetype-js"],["Bootstrap","bi-bootstrap"]],
  "Backend"  => [["PHP","bi-filetype-php"],["Python","bi-filetype-py"]],
  "Base de données" => [["MySQL","bi-database"],["SQL","bi-table"],["MERISE","bi-diagram-3"]],
  "Outils"   => [["Git / GitHub","bi-github"],["Figma","bi-vector-pen"],["Astah UML","bi-diagram-2"],["VS Code","bi-code-square"]],
];

/* Projets : [titre, description, technologies, lien du bouton, lien GitHub, texte du bouton] */
$projects = [
  ["Approche agile","Apprentissage des méthodes agiles pour organiser, planifier et suivre efficacement les projets en équipe.",["Trello","jira","Git","Figma","Microsoft Teams"],"/module?m=1","module.php","Voir module 1"],
  ["Développement back-end","Développement de la partie serveur des applications, gestion des bases de données et création d'API.",["PHP","MySQL","PDO","XAMPP / WAMP","Git & GitHub","Postman"],"/module?m=2","module.php","Voir module 2"],
  ["Mes projets (en groupe et individuels)","Création d'une application web interactive avec une interface moderne, intuitive et adaptée aux besoins des utilisateurs.
",["PHP","MySQL","PDO","HTML","CSS","Bootstrap"],"/projets","#","Voir le projet"],
];

$education = [
  ["2026 – présent","ISTA NTIC Tanger","Développement Digital — option Full Stack (2ème année)","Spécialisation en développement web front-end et back-end, bases de données et conception UML."],
  ["2025 – 2026","ISTA NTIC Tanger","Développement Digital — Développement Web (1ère année)","Bases de la programmation, du web et des bases de données."],
  ["2024 – 2025","Lycée Imam El Ghazali","Baccalauréat scientifique, option Français","Mention Assez bien."],
];

$certs = [
  ["Nom de la certification","Plateforme / organisme","Mois 2026","#"],
  ["Nom de la certification","Plateforme / organisme","Mois 2025","#"],
  ["Nom de la certification","Plateforme / organisme","Mois 2025","#"],
];

$experiences = [
  ["Projets académiques","Gestion de bibliothèque, site statique et dynamique : projets réalisés à l'ISTA NTIC Tanger.","bi-mortarboard"],
  ["Projets personnels","Applications et sites construits pour pratiquer et explorer de nouvelles technologies.","bi-lightbulb"],
  ["Freelance","Missions freelance à venir.","bi-briefcase"],
  ["Stages","Stages à venir.","bi-building"],
];

$langs = [["Arabe","Langue maternelle"],["Français","Niveau intermédiaire"],["English","Niveau B1"]];

/* ---- Traitement du formulaire ---- */
$flash = ""; $ok = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $n = trim(strip_tags($_POST["nom"] ?? ""));
  $e = trim($_POST["email"] ?? "");
  $s = trim(strip_tags($_POST["sujet"] ?? ""));
  $m = trim(strip_tags($_POST["message"] ?? ""));
  if ($n === "" || $s === "" || $m === "" || !filter_var($e, FILTER_VALIDATE_EMAIL)) {
    $flash = "Vérifiez les champs : tous sont obligatoires et l'email doit être valide.";
  } else {
    $headers = "From: noreply@" . ($_SERVER["SERVER_NAME"] ?? "localhost") . "\r\nReply-To: " . str_replace(["\r","\n"], "", $e);
    // 1) Sauvegarde locale : le message n'est jamais perdu (dossier data/ protégé)
    $dir = __DIR__ . "/data";
    if (!is_dir($dir)) { @mkdir($dir, 0755, true); @file_put_contents("$dir/.htaccess", "Require all denied\nDeny from all\n"); }
    $saved = @file_put_contents("$dir/messages.log", date("Y-m-d H:i") . " | $n <$e> | $s\n$m\n----\n", FILE_APPEND | LOCK_EX) !== false;
    // 2) Envoi par email
    $sent = @mail($email, "Portfolio : " . str_replace(["\r","\n"], "", $s), "De : $n <$e>\n\n$m", $headers);
    $ok = $sent || $saved;
    $flash = $ok ? "Merci, votre message a bien été envoyé." : "L'envoi a échoué. Écrivez-moi directement par email.";
  }
}
function h($v){ return htmlspecialchars($v, ENT_QUOTES, "UTF-8"); }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= h($name) ?> — Développeuse Full Stack</title>
<meta name="description" content="Portfolio de <?= h($name) ?>, développeuse Full Stack.">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,600&family=Figtree:wght@400;500;600&family=JetBrains+Mono:wght@400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
:root{
  --brown:#3a2321; --brown-2:#4d3230; --brown-soft:#7a5f5a;
  --pink:#e2708f; --pink-deep:#c94f73; --pink-pale:#f9e3ea;
  --cream:#fbf6f1; --white:#fff;
  --serif:'Fraunces',Georgia,serif; --sans:'Figtree',system-ui,sans-serif; --mono:'JetBrains Mono',monospace;
  --r:14px;
}
*{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth;scroll-padding-top:80px}
body{font-family:var(--sans);color:var(--brown);background:var(--cream);line-height:1.65;font-size:1.02rem}
a{color:inherit;text-decoration:none}
img{max-width:100%}
:focus-visible{outline:2px solid var(--pink);outline-offset:3px}
.wrap{width:min(1120px,100% - 2.5rem);margin-inline:auto}
section{padding:6rem 0}
h1,h2,h3{font-family:var(--serif);font-weight:600;line-height:1.15}
h2{font-size:clamp(1.9rem,4vw,2.7rem);margin-bottom:.6rem}
.lead{color:var(--brown-soft);max-width:60ch;margin-bottom:3rem}

/* Boutons */
.btn{display:inline-flex;align-items:center;gap:.5rem;padding:.8rem 1.5rem;border-radius:999px;font-weight:600;font-size:.95rem;border:1.5px solid transparent;cursor:pointer;transition:.25s;font-family:inherit}
.btn-pink{background:var(--pink);color:var(--white)}
.btn-pink:hover{background:var(--pink-deep);transform:translateY(-2px)}
.btn-line{border-color:currentColor}
.btn-line:hover{background:var(--pink);border-color:var(--pink);color:var(--white)}
.btn-sm{padding:.5rem 1.05rem;font-size:.86rem}

/* Navbar */
header{position:fixed;inset:0 0 auto;z-index:50;transition:.3s}
header.solid{background:rgba(58,35,33,.96);backdrop-filter:blur(8px);box-shadow:0 6px 24px rgba(58,35,33,.25)}
.nav{display:flex;align-items:center;justify-content:space-between;height:72px;color:var(--cream)}
.logo{font-family:var(--serif);font-size:1.35rem;font-weight:600}
.logo span{color:var(--pink)}
.menu{display:flex;gap:1.9rem;list-style:none;align-items:center}
.menu a:not(.btn){font-size:.93rem;position:relative;padding:.3rem 0;opacity:.85;transition:.2s}
.menu a:not(.btn)::after{content:"";position:absolute;left:0;bottom:0;height:2px;width:100%;background:var(--pink);transform:scaleX(0);transform-origin:left;transition:transform .3s}
.menu a:not(.btn):hover,.menu a.active{opacity:1}
.menu a:not(.btn):hover::after,.menu a.active::after{transform:scaleX(1)}
.burger{display:none;background:none;border:0;color:var(--cream);font-size:1.7rem;cursor:pointer}

/* Hero */
.hero{background:var(--brown);color:var(--cream);padding:9rem 0 6rem;min-height:100vh;display:flex;align-items:center;position:relative;overflow:hidden}
.hero::before{content:"";position:absolute;right:-12%;top:-20%;width:640px;height:640px;border-radius:50%;background:var(--brown-2)}
.hero-grid{display:grid;grid-template-columns:1.1fr .9fr;gap:4rem;align-items:center;position:relative}
.hero h1{font-size:clamp(2.6rem,6vw,4.6rem);letter-spacing:-.02em;margin-bottom:.4rem}
.role{font-family:var(--mono);color:var(--pink);font-size:1.02rem;margin-bottom:1.4rem}
.hero p.intro{max-width:46ch;color:#e6d6d0;margin-bottom:2.2rem;font-size:1.1rem}
.cta-row{display:flex;gap:.9rem;flex-wrap:wrap}
.hero .btn-line{color:var(--cream)}

.editor{background:var(--cream);color:var(--brown);border-radius:var(--r);box-shadow:0 30px 60px rgba(0,0,0,.35);overflow:hidden;transform:rotate(1.6deg)}
.editor-bar{display:flex;align-items:center;gap:.4rem;padding:.7rem 1rem;background:var(--pink-pale)}
.editor-bar i{width:11px;height:11px;border-radius:50%;background:var(--pink)}
.editor-bar i:nth-child(2){background:var(--brown-soft)}.editor-bar i:nth-child(3){background:var(--brown)}
.editor-bar small{margin-left:auto;font-family:var(--mono);font-size:.75rem;color:var(--brown-soft)}
.editor-body{display:grid;grid-template-columns:auto 1fr;gap:1.2rem;padding:1.4rem;align-items:center}
.avatar{width:120px;height:150px;border-radius:18px;overflow:hidden;display:block}
.avatar img{width:100%;height:100%;object-fit:cover;object-position:center top;display:block}
.editor pre{font-family:var(--mono);font-size:.8rem;line-height:1.75;overflow-x:auto;grid-column:1/-1;background:var(--white);border-radius:10px;padding:1rem}
.k{color:var(--pink-deep)}.c{color:var(--brown-soft)}

/* À propos */
.about-grid{display:grid;grid-template-columns:1.2fr 1fr;gap:4rem;align-items:start}
.about-grid p{margin-bottom:1rem;max-width:58ch}
.pills{display:grid;grid-template-columns:1fr 1fr;gap:1rem}
.pill{padding:1.3rem;border-radius:var(--r);background:var(--white);border-left:4px solid var(--pink);box-shadow:0 8px 24px rgba(58,35,33,.07)}
.pill i{color:var(--pink);font-size:1.5rem;display:block;margin-bottom:.3rem}
.pill b{font-weight:600}

/* Compétences */
.skills{background:var(--white)}
.skill-groups{display:grid;grid-template-columns:repeat(2,1fr);gap:2.4rem 4rem}
.skill-groups h3{font-size:1.2rem;margin-bottom:1rem;padding-bottom:.6rem;border-bottom:1px solid var(--pink-pale)}
.badges{display:flex;flex-wrap:wrap;gap:.7rem}
.badge{display:inline-flex;align-items:center;gap:.55rem;padding:.55rem 1rem;border-radius:999px;background:var(--cream);border:1px solid #efe1d8;font-weight:500;font-size:.93rem;transition:.25s}
.badge i{color:var(--pink);font-size:1.15rem}
.badge:hover{background:var(--brown);color:var(--cream);border-color:var(--brown);transform:translateY(-2px)}

/* Projets */
.projects{background:var(--brown);color:var(--cream)}
.projects .lead{color:#d8c6c0}
.proj-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.6rem}
.proj{background:var(--cream);color:var(--brown);border-radius:var(--r);overflow:hidden;display:flex;flex-direction:column;transition:.35s}
.proj:hover{transform:translateY(-8px);box-shadow:0 24px 40px rgba(0,0,0,.35)}
.shot{aspect-ratio:16/10;background:var(--pink-pale);position:relative;overflow:hidden;display:grid;place-items:center;color:var(--pink-deep);font-size:2.4rem}
.shot::before{content:"";position:absolute;inset:14% 12% 0;background:var(--white);border-radius:10px 10px 0 0;box-shadow:0 8px 20px rgba(58,35,33,.12);transition:.35s}
.shot::after{content:"";position:absolute;left:12%;right:12%;top:14%;height:14px;background:var(--brown);border-radius:10px 10px 0 0;opacity:.9}
.shot i{position:relative;z-index:1;margin-top:1rem}
.shot img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:2}
.proj:hover .shot::before{transform:translateY(-6px)}
.proj-body{padding:1.5rem;display:flex;flex-direction:column;gap:.8rem;flex:1}
.proj-body h3{font-size:1.2rem}
.proj-body p{color:var(--brown-soft);font-size:.95rem}
.tags{display:flex;flex-wrap:wrap;gap:.4rem}
.tags span{font-family:var(--mono);font-size:.72rem;padding:.2rem .6rem;border-radius:6px;background:var(--pink-pale);color:var(--pink-deep)}
.proj-actions{margin-top:auto;padding-top:.6rem;display:flex;gap:.6rem}
.proj .btn-line{color:var(--brown)}

/* Formation (timeline) */
.timeline{position:relative;margin-left:.6rem;padding-left:2.2rem;border-left:2px solid var(--pink)}
.tl{position:relative;margin-bottom:2.4rem;max-width:680px}
.tl::before{content:"";position:absolute;left:calc(-2.2rem - 8px);top:.45rem;width:14px;height:14px;border-radius:50%;background:var(--cream);border:3px solid var(--pink)}
.tl small{font-family:var(--mono);color:var(--pink-deep);font-size:.82rem}
.tl h3{font-size:1.4rem;margin:.2rem 0}
.tl em{font-style:normal;font-weight:600;color:var(--brown-soft)}
.tl p{margin-top:.4rem;color:var(--brown-soft)}

/* Certifications */
.certs{background:var(--white)}
.cert-list{display:grid;gap:.9rem}
.cert{display:flex;align-items:center;gap:1.2rem;padding:1.1rem 1.4rem;background:var(--cream);border-radius:var(--r);transition:.25s}
.cert:hover{box-shadow:0 10px 26px rgba(58,35,33,.1);transform:translateX(6px)}
.cert>i{font-size:1.7rem;color:var(--pink)}
.cert div{flex:1}
.cert b{display:block}
.cert span{color:var(--brown-soft);font-size:.9rem}
.cert time{font-family:var(--mono);font-size:.8rem;color:var(--brown-soft)}

/* Expériences */
.exp-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:1.2rem}
.exp{display:flex;gap:1.1rem;padding:1.5rem;border:1.5px dashed #dcc5bb;border-radius:var(--r)}
.exp i{font-size:1.5rem;color:var(--pink);flex:none}
.exp h3{font-size:1.1rem;margin-bottom:.2rem}
.exp p{color:var(--brown-soft);font-size:.94rem}

/* Langues + CV */
.band{background:var(--pink-pale);padding:4.5rem 0}
.band-grid{display:grid;grid-template-columns:1.2fr 1fr;gap:3rem;align-items:center}
.langs{display:flex;gap:.8rem;flex-wrap:wrap;margin-top:1.2rem}
.lang{background:var(--white);padding:.8rem 1.2rem;border-radius:var(--r)}
.lang b{display:block;font-family:var(--serif)}
.lang span{font-size:.85rem;color:var(--brown-soft)}
.cv{background:var(--brown);color:var(--cream);padding:2rem;border-radius:var(--r);text-align:center}
.cv i{font-size:2.2rem;color:var(--pink)}
.cv h3{margin:.4rem 0 1.2rem}

/* Contact */
.contact{background:var(--brown);color:var(--cream)}
.contact-grid{display:grid;grid-template-columns:.9fr 1.1fr;gap:4rem}
.contact .lead{color:#d8c6c0;margin-bottom:2rem}
.links{list-style:none;display:grid;gap:.9rem}
.links a{display:flex;align-items:center;gap:.9rem;transition:.2s}
.links a:hover{color:var(--pink)}
.links span{display:flex;align-items:center;gap:.9rem}
.hobbies{margin-top:1.6rem}.hobbies h3{font-size:1.15rem;margin-bottom:.7rem}
.links i{width:44px;height:44px;border-radius:50%;background:var(--brown-2);display:grid;place-items:center;color:var(--pink);font-size:1.15rem}
form{background:var(--cream);color:var(--brown);padding:2rem;border-radius:var(--r);display:grid;gap:1rem}
label{font-weight:600;font-size:.88rem;display:grid;gap:.35rem}
input,textarea{font:inherit;padding:.8rem 1rem;border:1.5px solid #e5d3c9;border-radius:10px;background:var(--white);color:var(--brown);transition:.2s;width:100%}
input:focus,textarea:focus{outline:none;border-color:var(--pink);box-shadow:0 0 0 4px var(--pink-pale)}
textarea{min-height:130px;resize:vertical}
.row2{display:grid;grid-template-columns:1fr 1fr;gap:1rem}
.flash{padding:.8rem 1rem;border-radius:10px;font-size:.92rem;background:#fde8e8;color:#8a2c3f}
.flash.ok{background:#e6f4ea;color:#245b34}

/* Footer */
footer{background:#2b1918;color:#cdb8b1;padding:2rem 0;font-size:.9rem}
.foot{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:1rem}
.foot b{color:var(--cream);font-family:var(--serif)}
.foot nav{display:flex;gap:1.1rem;font-size:1.2rem}
.foot a:hover{color:var(--pink)}

/* Apparition : une seule fois, au chargement de chaque bloc principal */
.reveal{opacity:0;transform:translateY(18px);transition:opacity .7s,transform .7s}
.reveal.in{opacity:1;transform:none}
@media (prefers-reduced-motion:reduce){*{transition:none!important;scroll-behavior:auto!important}.reveal{opacity:1;transform:none}}

/* Responsive */
@media (max-width:960px){
  .hero-grid,.about-grid,.band-grid,.contact-grid{grid-template-columns:1fr;gap:2.6rem}
  .proj-grid{grid-template-columns:1fr 1fr}
  .editor{transform:none}
}
@media (max-width:760px){
  section{padding:4.2rem 0}
  .burger{display:block}
  .menu{position:fixed;inset:72px 0 auto;flex-direction:column;background:var(--brown);padding:1.6rem;gap:1.2rem;transform:translateY(-130%);transition:.35s;box-shadow:0 20px 30px rgba(0,0,0,.3)}
  .menu.open{transform:none}
  .skill-groups,.proj-grid,.exp-grid,.row2,.pills{grid-template-columns:1fr}
  .cert{flex-wrap:wrap}
}
</style>
</head>
<body>

<header id="top">
  <div class="wrap nav">
    <a href="#accueil" class="logo"><?= h($initials) ?><span>.</span></a>
    <button class="burger" aria-label="Ouvrir le menu" aria-expanded="false"><i class="bi bi-list"></i></button>
    <ul class="menu">
      <li><a href="#accueil">Accueil</a></li>
      <li><a href="#apropos">À propos</a></li>
      <li><a href="#competences">Compétences</a></li>
      <li><a href="#projets">Projets</a></li>
      <li><a href="#formation">Formation</a></li>
      <li><a href="#certifications">Certifications</a></li>
      <li><a href="#experiences">Expériences</a></li>
      <li><a href="#contact">Contact</a></li>
      <li><a href="#contact" class="btn btn-pink btn-sm">Me contacter</a></li>
    </ul>
  </div>
</header>

<main>
<!-- ACCUEIL -->
<section class="hero" id="accueil">
  <div class="wrap hero-grid">
    <div>
      <h1><?= h($name) ?></h1>
      <p class="role">&lt;Développeuse Full Stack /&gt;</p>
      <p class="intro">Étudiante en développement digital, je conçois des applications web modernes, fonctionnelles et soignées, de l'interface jusqu'à la base de données.</p>
      <div class="cta-row">
        <a href="#projets" class="btn btn-pink">Voir mes projets</a>
        <a href="#contact" class="btn btn-line">Me contacter</a>
      </div>
    </div>
    <div class="editor" aria-hidden="true">
      <div class="editor-bar"><i></i><i></i><i></i><small>developpeuse.php</small></div>
      <div class="editor-body">
        <div class="avatar"><img src="/images/photo.jpg" alt="Photo de <?= h($name) ?>"></div>
        <div><b style="font-family:var(--serif);font-size:1.15rem">Full Stack</b><br><span style="color:var(--brown-soft);font-size:.9rem">ISTA NTIC Tanger</span></div>
<pre><span class="c">// mon profil</span>
<span class="k">$developpeuse</span> = [
  <span class="k">'stack'</span>  =&gt; ['PHP', 'MySQL', 'JS'],
  <span class="k">'design'</span> =&gt; 'Figma',
  <span class="k">'ecole'</span>  =&gt; 'ISTA NTIC',
];</pre>
      </div>
    </div>
  </div>
</section>

<!-- À PROPOS -->
<section id="apropos">
  <div class="wrap about-grid reveal">
    <div>
      <h2>À propos de moi</h2>
      <p style="margin-top:1rem">Étudiante en deuxième année de Développement Digital, option Full Stack, à l'ISTA NTIC Tanger, je m'intéresse à la création d'applications web modernes, fonctionnelles et attrayantes.</p>
      <p>J'aime relier la logique du back-end à une interface claire, et je progresse en construisant des projets concrets.</p>
    </div>
    <div class="pills">
      <div class="pill"><i class="bi bi-code-slash"></i><b>Développement Web</b></div>
      <div class="pill"><i class="bi bi-layers"></i><b>Full Stack</b></div>
      <div class="pill"><i class="bi bi-palette"></i><b>UI / UX</b></div>
      <div class="pill"><i class="bi bi-arrow-repeat"></i><b>Apprentissage continu</b></div>
    </div>
  </div>
</section>

<!-- COMPÉTENCES -->
<section class="skills" id="competences">
  <div class="wrap reveal">
    <h2>Compétences</h2>
    <p class="lead">Les langages et outils que j'utilise dans mes projets.</p>
    <div class="skill-groups">
      <?php foreach ($skills as $cat => $items): ?>
      <div>
        <h3><?= h($cat) ?></h3>
        <div class="badges">
          <?php foreach ($items as [$label, $icon]): ?>
            <span class="badge"><i class="bi <?= h($icon) ?>"></i><?= h($label) ?></span>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- PROJETS -->
<section class="projects" id="projets">
  <div class="wrap reveal">
    <h2>Projets</h2>
    <p class="lead">Une sélection de mes réalisations, bientôt complétée.</p>
    <div class="proj-grid">
      <?php foreach ($projects as [$title, $desc, $tech, $demo, $repo, $btnLabel]): ?>
      <article class="proj">
        <div class="shot"><i class="bi bi-window-stack"></i><!-- <img src="/images/projet.jpg" alt="Capture de <?= h($title) ?>"> --></div>
        <div class="proj-body">
          <h3><?= h($title) ?></h3>
          <p><?= h($desc) ?></p>
          <div class="tags"><?php foreach ($tech as $t): ?><span><?= h($t) ?></span><?php endforeach; ?></div>
          <div class="proj-actions">
            <a href="<?= h($demo) ?>" class="btn btn-pink btn-sm"><?= h($btnLabel) ?></a>
            <?php if ($repo): ?><a href="<?= h($repo) ?>" class="btn btn-line btn-sm"><i class="bi bi-github"></i> GitHub</a><?php endif; ?>
          </div>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- FORMATION -->
<section id="formation">
  <div class="wrap reveal">
    <h2>Formation</h2>
    <p class="lead">Mon parcours académique.</p>
    <div class="timeline">
      <?php foreach ($education as [$date, $school, $sub, $txt]): ?>
      <div class="tl">
        <small><?= h($date) ?></small>
        <h3><?= h($school) ?></h3>
        <em><?= h($sub) ?></em>
        <p><?= h($txt) ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CERTIFICATIONS -->
<section class="certs" id="certifications">
  <div class="wrap reveal">
    <h2>Certifications</h2>
    <p class="lead">Mes certifications seront ajoutées ici.</p>
    <div class="cert-list">
      <?php foreach ($certs as [$cn, $org, $date, $link]): ?>
      <div class="cert">
        <i class="bi bi-patch-check"></i>
        <div><b><?= h($cn) ?></b><span><?= h($org) ?></span></div>
        <time><?= h($date) ?></time>
        <a href="<?= h($link) ?>" class="btn btn-line btn-sm">Voir le certificat</a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- EXPÉRIENCES -->
<section id="experiences">
  <div class="wrap reveal">
    <h2>Expériences</h2>
    <p class="lead">Là où j'applique mes compétences. Cette section sera complétée au fil de mes réalisations.</p>
    <div class="exp-grid">
      <?php foreach ($experiences as [$t, $d, $ic]): ?>
      <div class="exp"><i class="bi <?= h($ic) ?>"></i><div><h3><?= h($t) ?></h3><p><?= h($d) ?></p></div></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- LANGUES + CV -->
<section class="band" id="cv">
  <div class="wrap band-grid reveal">
    <div>
      <h2>Langues</h2>
      <div class="langs">
        <?php foreach ($langs as [$l, $lv]): ?>
        <div class="lang"><b><?= h($l) ?></b><span><?= h($lv) ?></span></div>
        <?php endforeach; ?>
      </div>
      <div class="hobbies"><h3>Loisirs</h3><div class="langs" style="margin-top:0"><?php foreach ($hobbies as $hb): ?><span class="lang"><?= h($hb) ?></span><?php endforeach; ?></div></div>
    </div>
    <div class="cv">
      <i class="bi bi-file-earmark-person"></i>
      <h3>Mon CV</h3>
      <a href="<?= h($cv) ?>" class="btn btn-pink" download><i class="bi bi-download"></i> Télécharger mon CV</a>
    </div>
  </div>
</section>

<!-- CONTACT -->
<section class="contact" id="contact">
  <div class="wrap contact-grid reveal">
    <div>
      <h2>Contact</h2>
      <p class="lead">Un projet, un stage, une question ? Écrivez-moi.</p>
      <ul class="links">
        <li><a href="mailto:<?= h($email) ?>"><i class="bi bi-envelope"></i><?= h($email) ?></a></li>
        <li><a href="tel:<?= h($phone) ?>"><i class="bi bi-telephone"></i><?= h($phone) ?></a></li>
        <li><span><i class="bi bi-geo-alt"></i><?= h($city) ?></span></li>
        <li><a href="<?= h($linkedin) ?>" target="_blank" rel="noopener"><i class="bi bi-linkedin"></i>LinkedIn</a></li>
        <li><a href="<?= h($github) ?>" target="_blank" rel="noopener"><i class="bi bi-github"></i>GitHub</a></li>
      </ul>
    </div>
    <form method="post" action="#contact">
      <?php if ($flash): ?><div class="flash <?= $ok ? 'ok' : '' ?>" role="status"><?= h($flash) ?></div><?php endif; ?>
      <div class="row2">
        <label>Nom<input type="text" name="nom" required></label>
        <label>Email<input type="email" name="email" required></label>
      </div>
      <label>Sujet<input type="text" name="sujet" required></label>
      <label>Message<textarea name="message" required></textarea></label>
      <button type="submit" class="btn btn-pink">Envoyer</button>
    </form>
  </div>
</section>
</main>

<footer>
  <div class="wrap foot">
    <div><b><?= h($name) ?></b><br>Full Stack Developer</div>
    <nav>
      <a href="<?= h($github) ?>" aria-label="GitHub"><i class="bi bi-github"></i></a>
      <a href="<?= h($linkedin) ?>" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
      <a href="mailto:<?= h($email) ?>" aria-label="Email"><i class="bi bi-envelope"></i></a>
    </nav>
    <span>© 2026 <?= h($name) ?></span>
  </div>
</footer>

<script>
// Menu mobile
const menu = document.querySelector('.menu'), burger = document.querySelector('.burger');
burger.addEventListener('click', () => {
  const open = menu.classList.toggle('open');
  burger.setAttribute('aria-expanded', open);
});
menu.querySelectorAll('a').forEach(a => a.addEventListener('click', () => menu.classList.remove('open')));

// Barre de navigation : fond au défilement + lien actif
const header = document.querySelector('header');
const links = [...document.querySelectorAll('.menu a:not(.btn)')];
const secs = links.map(a => document.querySelector(a.getAttribute('href')));
addEventListener('scroll', () => {
  header.classList.toggle('solid', scrollY > 30);
  const y = scrollY + 140;
  secs.forEach((s, i) => links[i].classList.toggle('active', s && s.offsetTop <= y && s.offsetTop + s.offsetHeight > y));
}, { passive: true });

// Apparition douce des sections
const io = new IntersectionObserver(es => es.forEach(e => { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } }), { threshold: .12 });
document.querySelectorAll('.reveal').forEach(el => io.observe(el));
</script>
</body>
</html>
