<?php
const host = "localhost";
const username = "root";
const password = "";
const database = "stackower";

session_start();
$deneme = $_GET['id'];

try {
    $baglanti = new PDO("mysql:host=" . host . ";dbname=" . database, username, password);
    $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$query = "SELECT questions.id, questions.title, questions.text, users.name 
            FROM questions 
            JOIN users 
            ON questions.user_id = users.id 
            WHERE questions.id = $deneme";
$stmt = $baglanti->query($query);
$rows = $stmt->fetch(PDO::FETCH_ASSOC);

$query2 = "SELECT  answers.text2, users.name, users.id
            FROM answers 
            JOIN users 
            ON answers.user_id = users.id 
            WHERE question_id = $deneme";
$stmt2 = $baglanti->query($query2);
$rows2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

$question_id = $user_id = $text2 = "";

if(isset($_POST["add"])) {
    $question_id = $rows["id"];
    $user_id = $_SESSION["user_id"];
    $text2 = $_POST["text2"];

    $query = "INSERT INTO answers(question_id, user_id, text2) VALUES (?, ?, ?);";
    $stmt = $baglanti -> prepare($query);
    $result = $stmt -> execute([$question_id, $user_id, $text2]);

    if ($result) {
        echo "<div class='alert alert-success mb-0 text-center'>Answer added</div>";
        header("refresh:2");
    } else {
        echo "Answer did not add";
        echo "<div class='alert alert-danger mb-0 text-center'>Answer did not add</div>";
    }
}

$baglanti = null;
?>

<?php include "partials/_header.php" ?>

<body>
    <?php include "partials/_navbar.php" ?>

    <div class="container my-3">
        <div class="row">
            <div class="col-12">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 50px;;">Name</th>
                            <th>Question</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td> <?php echo $rows["name"] ?> </td>
                            <td> <?php echo $rows["title"] . " - " . $rows["text"] . "<br>"; ?> </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="container my-3">
        <div class="row">
            <div class="col-12">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 50px;;">Name</th>
                            <th>Answers</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows2 as $row2) : ?>
                            <tr>
                                <td> <?php echo $row2["name"] ?> </td>
                                <td> <?php echo $row2["text2"] ?> </td>

                            </tr>
                        <?php endforeach ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION["isLogin"])) : ?>
    <div class="container my-3">
        <div class="row">
            <div class="col-12">
                <?php if ($_SESSION["isLogin"]) : ?>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="text2">Add your answer...</label>
                            <textarea name="text2" class="form-control" cols="15" rows="5" placeholder="Write here your answer" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="add">Add</button>
                    </form>
                <?php endif ?>
            </div>
        </div>
    </div>
    <?php endif ?>

</body>
</html>