<!DOCTYPE HTML>
<html lang="pl">
<head>
    <link rel="stylesheet" href="Sabmenu.css">
    <link rel="stylesheet" href="Strona_Zaloguj_się.css">
    <link rel="icon" type="image/x-icon" href="imageKrupto/logo_transparent.png">
    <title>DRESS&BEAT - Login</title>
</head>
<body>
    <header>
        <p class="header1">DRESS&BEAT</p>
        <div>
            <a class="header2" href="#">Znajdź sklep</a>
            <span>|</span>
            <a class="header2" href="strona_1.html">Pomoc</a>
            <span>|</span>
            <a class="header2" href="Strona_Dołącz_do_nas.php">Dołącz do nas</a>
            <span>|</span>
            <a class="header2" href="GlownaStrona.php">Zwróć do sklepu</a>
        </div>
    </header>
    <nav>
        <div class="login">
        <?php
        session_start(); // Rozpoczęcie sesji

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = $_POST["email"];

            // Walidacja e-maila
            if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/@gmail\.com$/', $email)) {
                die("Nieprawidłowy adres e-mail. Upewnij się, że kończy się na @gmail.com.");
            }

            // Przechowywanie e-maila w sesji
            $_SESSION['email'] = $email;

            // Przejście do kolejnej strony
            header("Location: Strona_Zaloguj_się_2.php");
            exit();
        }
        ?>
            <form onsubmit="return validateEmail()" method="POST">
                <label for="email">Wpisz swój adres e-mail <br> Aby do nas dołączyć lub się zalogować</label><br>
                <input class="text" type="text" id="email" name="email" placeholder="Email*" required><br>
                <p id="error-message" style="color: red;"></p>
                <button class="button" type="submit">Kontynuować</button>
            </form>
        </div>
    </nav>
    <footer>© 2024 DRESS&BEAT, Inc. Wszelkie prawa zastrzeżone</footer>
    <script>
        function validateEmail() {
            const email = document.getElementById('email').value;
            const errorMessage = document.getElementById('error-message');

            // Sprawdzanie poprawności e-maila
            if (email.includes('@') && email.endsWith('gmail.com')) {
                errorMessage.textContent = ''; // Usuń komunikat o błędzie
                return true; // Pozwól formularzowi się wysłać
            } else {
                errorMessage.textContent = 'Nieprawidłowy e-mail! Upewnij się, że zawiera "@" i kończy się na "gmail.com".';
                return false; // Zatrzymaj wysyłanie formularza
            }
        }
    </script>
</body>
</html>
