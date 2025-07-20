<?php 
    const host = "localhost";
    const username = "root";
    const password = "";
    const database = "stackower";

    session_start();

    try {
        $baglanti = new PDO("mysql:host=".host.";dbname=". database, username, password);
        $baglanti -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    $name = $password = "";

    if($_SERVER["REQUEST_METHOD"]=="POST") {
        $name = $_POST['name'];
        $password = $_POST['password'];
       
        $query = "SELECT * FROM users WHERE name = :name ";
        $stmt = $baglanti->prepare($query);
        $stmt->bindParam(':name', $name); 
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($row["password"] == $password) {
            $_SESSION["isLogin"] = true;
            $_SESSION["user_id"] = $row['id'];
            $_SESSION["user_name"] = $row['name'];
            $_SESSION["password"] = $row['password'];
            setcookie("name", $name, time() + (60 * 60 * 24));
            echo "Giriş başarılı. Hoş geldiniz, " . $row['name'] . "!";
            header("Location:quesiton.php");
        } else {
            echo "Kullanıcı bulunamadı.";
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
            <form action="login.php" method="post">
                <div class="mb-3">                   
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                </div>

                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password"  required >
                </div>
                
                <button type="submit" class="btn btn-primary" name="login">Login</button>
            </form>
        </div>
    </div>

</div>

</body>
</html>