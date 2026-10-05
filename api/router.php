<?php
/* Routeur pour le test en local uniquement (Vercel utilise vercel.json) */
$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

$routes = [
  "/"        => "api/index.php",
  "/module"  => "api/module.php",
  "/projets" => "api/projets.php",
];

if (isset($routes[$path])) {
  require __DIR__ . "/" . $routes[$path];
  return true;
}

return false; // les fichiers de public/ (css, images, pdf) sont servis directement
