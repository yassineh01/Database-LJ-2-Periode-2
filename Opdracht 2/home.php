<?php
require_once('db.php');

$database = new Database();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = $_POST['naam'];
    $email = $_POST['email'];
    $leeftijd = $_POST['leeftijd'];

    $database->voegGebruikerToe($naam, $email, $leeftijd);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <div class="container">
        <h1>Welcome to my home page!</h1>

       
        <form method="post" action="">
            <label for="naam">Naam:</label>
            <input type="text" id="naam" name="naam" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="leeftijd">Leeftijd:</label>
            <input type="number" id="leeftijd" name="leeftijd" required>

            <button type="submit">Voeg Gebruiker Toe</button>
        </form>

        <?php
       
        $gebruikers = $database->haalGebruikersOp();

       
        if (!empty($gebruikers)) {
            echo '<h2>Gebruikers:</h2>';
            echo '<ul>';
            foreach ($gebruikers as $gebruiker) {
                echo '<li>' . $gebruiker['naam'] . ' - ' . $gebruiker['email'] . ' - ' . $gebruiker['leeftijd'] . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>Geen gebruikers gevonden.</p>';
        }
        ?>
    </div>
</body>
</html>
