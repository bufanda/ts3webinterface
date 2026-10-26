<?php
// Erzwinge die Anzeige von Fehlern
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h2>Debug-Modus gestartet...</h2>";

try {
    // Versuche, das Hauptskript zu laden
    require_once('index.php');
} catch (Throwable $e) {
    // Fange JEDEN Fehler ab und drucke ihn auf den Bildschirm
    echo "<div style='background: #ffe6e6; border: 2px solid red; padding: 20px; font-family: monospace; color: black;'>";
    echo "<h1 style='color: red;'>FATALER FEHLER GEFUNDEN:</h1>";
    echo "<b>Fehlermeldung:</b> " . $e->getMessage() . "<br><br>";
    echo "<b>Datei:</b> " . $e->getFile() . "<br>";
    echo "<b>Zeile:</b> " . $e->getLine() . "<br><br>";
    echo "<b>Stack-Trace:</b><br><pre>" . $e->getTraceAsString() . "</pre>";
    echo "</div>";
}
?>
