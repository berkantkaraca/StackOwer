<?php
const host = "localhost";
const username = "root";
const password = "";
const database = "stackower";

try {
    $baglanti = new PDO("mysql:host=" . host . ";dbname=" . database, username, password);
    $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$name = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $password = $_POST["password"];

    $query = "INSERT INTO users(name, password) VALUES (?, ?);";
    $stmt = $baglanti->prepare($query);
    $result = $stmt->execute([$name, $password]);

    if ($result) {
        echo "kayıt eklendi";
        header("refresh:2; url=login.php");
    } else {
        echo "kayıt eklenemedi";
    }

    $baglanti = null;
}
?>

<?php include "partials/_header.php" ?>

<body>
    <?php include "partials/_navbar.php" ?>

    <div class="container my-3">
        <div class="row">
            <div class="col-12">
                <form action="register.php" method="post">
                    <div class="mb-3">                       
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" value="<?php echo $password; ?>" placeholder="Password" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary" name="register">Register</button>
                </form>
            </div>
        </div>

    </div>


</body>

</html>