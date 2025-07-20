<?php
const host = "localhost";
const username = "root";
const password = "";
const database = "stackower";

session_start(); 

try {
    $baglanti = new PDO("mysql:host=" . host . ";dbname=" . database, username, password);
    $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$query = "SELECT questions.title, questions.id, users.name 
            FROM questions 
            JOIN users 
            ON questions.user_id = users.id";
$stmt = $baglanti->query($query);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include "partials/_header.php" ?>

<body>

    <?php include "partials/_navbar.php" ?>

    <h1 style="text-align: center;">STACKOWER QUESTİON</h1>

    <div class="container my-3">
        <div class="row">
            <div class="col-12">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Users</th>
                            <th>Questions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $row) : ?>
                            <tr>
                                <td> <?php echo $row["name"] ?> </td>
                                <td> 
                                    <a style="text-decoration: none;" href="template.php?id=<?php echo  $row["id"]; ?>"> <?php echo  $row["title"] . "<br>"  ?> </a>
                                </td>

                            </tr>
                        <?php endforeach ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>




</body>

</html>