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

$user_id = $title = $text = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = $_SESSION["user_id"];
    $title = $_POST["title"];
    $text = $_POST["text"];

    $query = "INSERT INTO questions(user_id, title, text) VALUES (?, ?, ?);";
    $stmt = $baglanti->prepare($query);
    $result = $stmt->execute([$user_id, $title, $text]);

    if ($result) {
        echo "<div class='alert alert-success mb-0 text-center'>Question added</div>";
        header("refresh:2; url=quesiton.php");
    } else {
        echo "Question did not add";
        echo "<div class='alert alert-danger mb-0 text-center'>Question did not add</div>";

    }

    $baglanti = null;
}
?>

<?php include "partials/_header.php" ?>

<body>
    <?php include "partials/_navbar.php" ?>

    <?php if (isset($_SESSION["isLogin"])) : ?>
    <div class="container my-3">
        <div class="row">
            <div class="col-12">
                <form action="addNewQuestion.php" method="post">
                    <div class="mb-3">                       
                        <label for="title">Title</label>
                        <textarea name="title" class="form-control" cols="15" rows="5" placeholder="Write here your question title" required></textarea>
                    </div>

                    <div class="mb-3">                       
                        <label for="text">Text</label>
                        <textarea name="text" class="form-control" cols="15" rows="5" placeholder="Explain here your question " required></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary" name="add">Add</button>
                </form>
            </div>
        </div>

    </div>

    <?php else : ?>
        <h1>PLEASE LOGİN!!</h1>
        
    <?php endif; ?>


</body>

</html>

                    

                