<?php
require_once('db.php');

$database = new Database();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['edit'])) {
       
        $gebruikerId = $_POST['edit'];
        $gebruiker = $database->haalGebruikerOp($gebruikerId);

        if ($gebruiker) {
          
            $bewerkId = $gebruiker['id'];
            $bewerkNaam = $gebruiker['naam'];
            $bewerkEmail = $gebruiker['email'];
            $bewerkLeeftijd = $gebruiker['leeftijd'];
        }
    } elseif (isset($_POST['delete'])) {
       
        $gebruikerId = $_POST['delete'];
        $database->verwijderGebruiker($gebruikerId);
    } else {
       
        $naam = $_POST['naam'];
        $email = $_POST['email'];
        $leeftijd = $_POST['leeftijd'];

        if (isset($_POST['bewerkId'])) {
          
            $bewerkId = $_POST['bewerkId'];
            $database->updateGebruiker($bewerkId, $naam, $email, $leeftijd);
        } else {
           
            $database->voegGebruikerToe($naam, $email, $leeftijd);
        }
    }
}


$gebruikers = $database->haalGebruikersOp();
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
            <input type="text" id="naam" name="naam" required value="<?php echo isset($bewerkNaam) ? $bewerkNaam : ''; ?>">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required value="<?php echo isset($bewerkEmail) ? $bewerkEmail : ''; ?>">

            <label for="leeftijd">Leeftijd:</label>
            <input type="number" id="leeftijd" name="leeftijd" required value="<?php echo isset($bewerkLeeftijd) ? $bewerkLeeftijd : ''; ?>">

          
            <?php if (isset($bewerkId)) : ?>
                <input type="hidden" name="bewerkId" value="<?php echo $bewerkId; ?>">
            <?php endif; ?>

            <button type="submit"><?php echo isset($bewerkId) ? 'Bewerk Gebruiker' : 'Voeg Gebruiker Toe'; ?></button>
        </form>

        <?php
       
        if (!empty($gebruikers)) {
            echo '<h2>Gebruikers:</h2>';
            echo '<ul>';
            foreach ($gebruikers as $gebruiker) {
                echo '<li>';
                echo $gebruiker['naam'] . ' - ' . $gebruiker['email'] . ' - ' . $gebruiker['leeftijd'];
                echo '<div class="buttons-container">';
                echo ' <form method="post" action=""><input type="hidden" name="edit" value="' . $gebruiker['id'] . '"><button type="submit" class="edit">Edit</button></form>';
                echo ' <form method="post" action=""><input type="hidden" name="delete" value="' . $gebruiker['id'] . '"><button type="submit">Verwijder</button></form>';
                echo '</div>';
                echo '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>Geen gebruikers gevonden.</p>';
        }
        ?>
    </div>
</body>
</html>
