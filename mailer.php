<?php

    // Načítá pole z formuláře - name, email a message; odstraňuje bílé znaky; odstraňuje HTML
    $name = strip_tags(trim($_POST["name"]));
    $name = str_replace(array("\r","\n"),array(" "," "),$name);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Kontroluje data popř. přesměruje na chybovou adresu
    if (empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: http://nabyteksedivy.cz/contact.html");
        exit;
    }

    // Nastavte si email, nakterý chcete, aby se vyplněný formulář odeslal - jakýkoli váš email
    $recipient = "bursik@gayer-cosmetics.cz";

    // Nastavte předmět odeslaného emailu
    $subject = "Máte nový kontakt od: $name";

    // Obsah emailu, který se vám odešle
    $email_content = "Jméno: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Zpráva:\n$message\n";

    // Emailová hlavička
    $email_headers = "From: $name <$email>";

    // Odeslání emailu - dáme vše dohromady
    mail($recipient, $subject, $email_content, $email_headers);
    
    // Přesměrování na stránku, pokud vše proběhlo v pořádku
    header("Location:http://www.nabyteksedivy.cz/contact.html?");

?>

<?xml version="1.0" encoding="UTF-8"?>
<configuration>
<system.webServer>
  <rewrite>
    <rules>
      <rule name="Redirect to HTTPS" stopProcessing="true">
        <match url="(.*)" />
        <conditions logicalGrouping="MatchAny">
          <add input="{HTTPS}" pattern="off" ignoreCase="true" />
          <add input="{HTTP_HOST}" pattern="^www.nazev-domeny.cz$" negate="true" />
        </conditions>
        <action type="Redirect" redirectType="Permanent" url="https://www.nazev-domeny.cz/{R:1}" />
      </rule>
    </rules>
  </rewrite>
</system.webServer>   
</configuration>