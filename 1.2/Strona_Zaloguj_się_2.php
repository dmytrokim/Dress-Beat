<!DOCTYPE HTML>
<html lang="en">
<head>
    <link rel="stylesheet" href="PodStrona_1.css">
    <link rel="stylesheet" href="Sabmenu.css">
    <link rel="stylesheet" href="Strona_Zaloguj_się_2.css">
    <link rel="icon" type="image/x-icon" href="imageKrypto/favicon.ico">
    <title>DRESS&BEAT - login</title>
</head>
<body>
    <header>
        <a href="#"><img class="header1" src="imageKrupto/Binance.png" alt="Logo"></a>
        <div>
            <a class="header2" href="#">Znajdź sklep</a>
            <span>|</span>
            <a class="header2" href="strona_1.html">Pomoc</a>
            <span>|</span>
            <a class="header2" href="Strona_Dołącz_do_nas.php">Dołącz do nas</a>
            <span>|</span>
            <a class="header2" href="GlownaStrona.php">Zwrócz do sklepu</a>
        </div>
    </header>
    <nav>
        <div class="login_2">
        <?php
session_start(); // Rozpoczęcie sesji

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Pobieranie danych z formularza
    $email = $_SESSION['email']; // Odczyt e-maila z sesji
    $Kod = $_POST["Kod"];
    $First_name = $_POST["First_name"];
    $Last_name = $_POST["Last_name"];
    $password = $_POST["password"];
    $Preferencje_Zakupowe = $_POST["Preferencje_Zakupowe"];
    $Miesiąc = $_POST["Miesiąc"];
    $Dzień = $_POST["Dzień"];
    $Rok = $_POST["Rok"];
    $birthDate = "$Rok-$Miesiąc-$Dzień";

    // Walidacja preferencji zakupowych
    $valid_preferences = ['Męski', 'Damski'];
    if (!in_array($Preferencje_Zakupowe, $valid_preferences)) {
        die("Nieprawidłowa wartość Preferencji Zakupowych.");
    }

    // Hashowanie hasła
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Połączenie z bazą danych
    $conn = new mysqli("localhost", "root", "", "registred_users");

    if ($conn->connect_error) {
        die("Błąd połączenia z bazą danych: " . $conn->connect_error);
    }

    // Przygotowanie zapytania SQL
    $stmt = $conn->prepare("
        INSERT INTO registed (email, Kod, First_name, Last_name, password, Preferencje_Zakupowe, Birth_date) 
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("sisssss", $email, $Kod, $First_name, $Last_name, $hashedPassword, $Preferencje_Zakupowe, $birthDate);

    if ($stmt->execute()) {
        echo "Rejestracja zakończona sukcesem!";
        unset($_SESSION['email']); // Usuwanie e-maila z sesji po udanej rejestracji
    } else {
        echo "Błąd: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
<form method="POST" onsubmit="return validatePassword()">
    <label for="zagolovok">Teraz uczyńmy Cię <br> Członkiem DRESS&BEAT</label><br>
    <input class="text_2" type="text" name="Kod" placeholder="Kod*"><br>
    <input class="text_2" type="text" name="First_name" placeholder="First Name*">
    <input class="text_2" type="text" name="Last_name" placeholder="Last Name*"><br>
    <input class="text_2" type="password" name="password" id="password" placeholder="Hasło*" oninput="validatePassword()"><br>

    <p class="haslo_1" id="min" for="min">Minimum 8 znaków:  
        <span class="haslo_1" id="max" for="max">wielkie litery, </span>
        <span class="haslo_1" id="max_1" for="max_1">małe litery, </span>
        <span class="haslo_1" id="max_2" for="max_2">jedna cyfra</span>
        <span class="haslo_1" id="max_3" for="max_3">i znak specjalny</span>
    </p>

    <select class="text_2" name="Preferencje_Zakupowe" id="Preferencje_Zakupowe">
        <option value="" disabled selected hidden>Preferencje Zakupowe</option>
        <option value="Męski">Męski</option>
        <option value="Damski">Damski</option>
    </select><br>
    <label class="haslo_1" for="Data_urodzenia">Data urodzenia:</label><br>
    <input class="text_2" type="number" name="Miesiąc" id="Miesiąc" maxlength="2" placeholder="Miesiąc*" min="1" max="12">
    <input class="text_2" type="number" name="Dzień" id="Dzień" maxlength="2" placeholder="Dzień*" min="1" max="31">
    <input class="text_2" type="number" name="Rok" id="Rok" maxlength="4" placeholder="Rok*" min="1900" max="2024"><br>
    <button class="button_2" type="submit">Kontynuować</button>
</form>

            <script>
                // Функція для валідації значень
                function validateInput(input, min, max) {
                    let value = parseInt(input.value, 10);
                    if (value < min || value > max || isNaN(value)) {
                        input.setCustomValidity(Введіть число між ${min} і ${max});
                    } else {
                        input.setCustomValidity('');
                    }
                }
                document.getElementById('Miesiąc').addEventListener('input', function() {
                    validateInput(this, 1, 12); // Для місяця: від 1 до 12
                });
                document.getElementById('Dzień').addEventListener('input', function() {
                    validateInput(this, 1, 31); // Для дня: від 1 до 31
                });
                document.getElementById('Rok').addEventListener('input', function() {
                    validateInput(this, 1900, 2024); // Для року: від 1900 до 2024
                });
            </script>
<script>
    function validatePassword() {
    const password = document.getElementById('password').value;
    const minLabel = document.getElementById('min');
    const maxLabel = document.getElementById('max');
    const max1Label = document.getElementById('max_1');
    const max2Label = document.getElementById('max_2');
    const max3Label = document.getElementById('max_3');
    
    // Regular expression to check for password requirements
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+={}\[\]|\\:;'"<>,.?/-]).{8,}$/;
    const passwordRegex1 = /^(?=.*[A-Z]).+$/; // Checks for at least one uppercase letter
    const passwordRegex2 = /^(?=.*[a-z]).+$/; // Checks for at least one lowercase letter
    const passwordRegex3 = /^(?=.*\d).+$/; // Checks for at least one digit
    const passwordRegex4 = /^(?=.*[!@#$%^&*()_+={}\[\]|\\:;'"<>,.?/-]).+$/; // Checks for at least one special character

    // Check password length
    if (password.length >= 8) {
        minLabel.style.color = 'green';  // At least 8 characters
    } else {
        minLabel.style.color = 'red';  // Less than 8 characters
    }

    // Check if password contains all the required elements
    if (passwordRegex1.test(password)) {
        maxLabel.style.color = 'green'; // Uppercase letter
    } else {
        maxLabel.style.color = 'red';
    }

    if (passwordRegex2.test(password)) {
        max1Label.style.color = 'green'; // Lowercase letter
    } else {
        max1Label.style.color = 'red';
    }

    if (passwordRegex4.test(password)) {
        max3Label.style.color = 'green';  // Special character
    } else {
        max3Label.style.color = 'red';
    }

    if (passwordRegex3.test(password)) {
        max2Label.style.color = 'green';  // Digit
    } else {
        max2Label.style.color = 'red';
    }

    // Check the overall password validity
    if (passwordRegex.test(password)) {
        return true;  // Password is valid
    } else {
        return false;  // Password is invalid
    }
}
</script>

        </div>
    </nav>
    <footer>© 2024 DRESS&BEAT, Inc. Wszelkie prawa zastrzeżone</footer>
</body>
</html>