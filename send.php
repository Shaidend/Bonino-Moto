<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $messaggio = htmlspecialchars(trim($_POST["textarea"]));

    // Controllo campi
    if (empty($email) || empty($messaggio)) {
        die("Compila tutti i campi.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Indirizzo email non valido.");
    }

    // Destinatario e oggetto
    $to = "tuoindirizzo@email.com"; // <-- qui metti la tua email
    $subject = "Nuovo messaggio dal modulo contatti";

    // Corpo della mail
    $body = "Email: $email\n\n";
    $body .= "Messaggio:\n$messaggio\n";

    // Intestazioni
    $headers = "From: sito@tuodominio.com\r\n"; // meglio usare un indirizzo del dominio
    $headers .= "Reply-To: $email\r\n";

    // Invio email
    if (mail($to, $subject, $body, $headers)) {
        echo "✅ Messaggio inviato con successo!";
    } else {
        echo "❌ Errore nell'invio del messaggio.";
    }
} else {
    echo "⚠️ Accesso non valido. Compila il form.";
}

?>