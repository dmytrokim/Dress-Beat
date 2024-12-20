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
            <a class="header2" href="Strona_Dołącz_do_nas.html">Dołącz do nas</a>
            <span>|</span>
            <a class="header2" href="GlownaStrona.html">Zwrócz do sklepu</a>
        </div>
    </header>
    <nav>
        <div class="login_2">
            <?php
            if (isset($_POST["Kod"])){
                $Kod = $_POST["Kod"];
                $First_name = $_POST["First_name"];
                $Last_name = $_POST["Last_name"];
                $password = $_POST["password"];
                $Preferencje_Zakupowe = $_POST["Preferencje_Zakupowe"];
                $Miesiąc = $_POST["Miesiąc"];
                $Dzień = $_POST["Dzień"];
                $Rok = $_POST["Rok"];
                $conn = mysqli_connect( "localhost","root","","registred_users");
                $odp = $conn->query("INSERT INTO registred(Kod, First_name, Last_name, password, Preferencje_Zakupowe, Birth_date)  VALUES ($Kod, '$First_name', '$Last_name', $password, $Preferencje_Zakupowe, STR_TO_DATE(CONCAT($Rok, '-', $Miesiąc, '-', $Dzień), '%Y-%m-%d'))");
                
                $conn->close();
            }
            ?>
            <form method="POST">
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
                        input.setCustomValidity(`Введіть число між ${min} і ${max}`);
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
        
        // Wyrażenie regularne dla spełnienia wszystkich warunków:
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+={}\[\]|\\:;'"<>,.?/-]).{8,}$/;
        const passwordRegex1 = /^(?=.*[A-Z]).+$/; // Sprawdza, czy hasło zawiera przynajmniej jedną wielką literę
        const passwordRegex2 = /^(?=.*[a-z]).+$/; // Sprawdza, czy hasło zawiera przynajmniej jedną małą literę
        const passwordRegex3 = /^(?=.*\d).+$/; // Sprawdza, czy hasło zawiera przynajmniej jedną cyfrę
        const passwordRegex4 = /^(?=.*[!@#$%^&*()_+={}\[\]|\\:;'"<>,.?/-]).+$/; // Sprawdza, czy hasło zawiera przynajmniej jeden znak specjalny
        
        // Sprawdzanie długości hasła
        if (password.length >= 8) {
            minLabel.style.color = 'green';  // Jeśli hasło ma co najmniej 8 znaków
        } else {
            minLabel.style.color = 'red';  // Jeśli hasło ma mniej niż 8 znaków
        }

        // Sprawdzanie poszczególnych wymagań
        if (passwordRegex1.test(password)) {
            maxLabel.style.color = 'green'; // Wielka litera
        } else {
            maxLabel.style.color = 'red';
        }

        if (passwordRegex2.test(password)) {
            max1Label.style.color = 'green'; // Mała litera
        } else {
            max1Label.style.color = 'red';
        }

        if (passwordRegex4.test(password)) {
            max3Label.style.color = 'green';  // Znak specjalny
        } else {
            max3Label.style.color = 'red';
        }

        if (passwordRegex3.test(password)) {
            max2Label.style.color = 'green';  // Cyfra 
        } else {
            max2Label.style.color = 'red';
        }

        // Sprawdzanie całościowego hasła
        if (passwordRegex.test(password)) {
            // Jeśli hasło spełnia wszystkie warunki
            minLabel.style.color = 'green';  // Oznaczenie całości jako poprawne
            maxLabel.style.color = 'green';
            max1Label.style.color = 'green';
            max2Label.style.color = 'green';
        }
    }
</script>

        </div>
    </nav>
    <footer>© 2024 DRESS&BEAT, Inc. Wszelkie prawa zastrzeżone</footer>
</body>
</html>