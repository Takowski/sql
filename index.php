<?php
try
{
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=weatherapp;charset=utf8', 'root', 'root');

    // Prepare the SQL query
    $sql = "SELECT * FROM Météo";

    // Execute the query
    $result = $bdd->query($sql);

    // Fetch all the results
    $data = $result->fetchAll();

}
catch(Exception $e)
{
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Prepare the SQL query
    $sql = "DELETE FROM Météo WHERE ville = :ville";

    // Prepare statement
    $stmt = $bdd->prepare($sql);

    // Loop through each selected ville and delete it
    foreach ($_POST['ville'] as $ville) {
        // Execute the query with the form data
        $stmt->execute(array(
            ':ville' => $ville
        ));
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['haut']) && isset($_POST['bas'])) {
    // Prepare the SQL query
    $sql = "INSERT INTO Météo (ville, haut, bas) VALUES (:ville, :haut, :bas)";

    // Prepare statement
    $stmt = $bdd->prepare($sql);

    // Execute the query with the form data
    $stmt->execute(array(
        ':ville' => $_POST['ville'],
        ':haut' => $_POST['haut'],
        ':bas' => $_POST['bas']
    ));
}
?>

<form action="index.php" method="post">
    <table>
        <tr><th>Ville</th><th>Haut</th><th>Bas</th><th>Delete</th></tr>
        <?php foreach ($data as $row): ?>
            <tr>
                <td><?= $row['ville'] ?></td>
                <td><?= $row['haut'] ?></td>
                <td><?= $row['bas'] ?></td>
                <td><input type="checkbox" name="ville[]" value="<?= $row['ville'] ?>"></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <input type="submit" name="delete" value="Delete Selected">
</form>

<form action="index.php" method="post">
    <label for="ville">Ville</label>
    <input type="text" name="ville" id="ville">
    <label for="haut">Haut</label>
    <input type="text" name="haut" id="haut">
    <label for="bas">Bas</label>
    <input type="text" name="bas" id="bas">
    <input type="submit" value="Ajouter">
</form>