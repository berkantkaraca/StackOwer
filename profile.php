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

$name = $_SESSION["user_name"];



if(isset($_POST["update_password"]) && $_SESSION["password"] == $_POST['oldpassword']) {

    $newPassword = $_POST['newpassword'];
    $name = $_POST['name'];
    $id = $_SESSION["user_id"];

    if($_POST['newpassword'] == $_POST['repassword']){
        $query = "UPDATE users SET  password = :newPassword, name = :name WHERE id = :id";
        $stmt = $baglanti -> prepare($query);        
        $stmt->bindParam(':newPassword', $newPassword);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();

        if ($result) {
            echo "<div class='alert alert-success mb-0 text-center'>updated</div>";
            header("Location: logout.php");
        } else {
            echo "<div class='alert alert-danger mb-0 text-center'>did not updated</div>";
        }
    }

}

if(isset($_POST["delete_account"])) {

    $userid = $_SESSION["user_id"];

    $query = "DELETE FROM users WHERE id = :userid";
    $stmt = $baglanti -> prepare($query);        
    $stmt->bindParam(':userid', $userid);
    $result = $stmt->execute();

    if ($result) {
        echo "<div class='alert alert-success mb-0 text-center'>deleted</div>";
        header("Location: logout.php");
    } else {
        echo "<div class='alert alert-danger mb-0 text-center'>did not deleted</div>";
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
                <h3>Update İnformation</h3>
                <form action="profile.php" method="post">

                    <div class="mb-3">                       
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Name" required>
                    </div>

                    <div class="mb-3">                   
                        <label for="oldpassword">Old Password</label>
                        <input type="password" name="oldpassword" class="form-control" placeholder="old password" required>
                    </div>

                    <div class="mb-3">
                        <label for="newpassword">New Password</label>
                        <input type="password" name="newpassword" class="form-control" placeholder="new Password"  required >
                    </div>

                    <div class="mb-3">
                        <label for="repassword">Repassword</label>
                        <input type="password" name="repassword" class="form-control" placeholder="write again new password"  required >
                    </div>
                    
                    <button type="submit" class="btn btn-primary" name="update_password">Update Password</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container my-3">
        <div class="row">
            <div class="col-12">
            <h3>DELETE PROFİLE</h3>
            <form action="profile.php" method="post">
                <button type="submit" class="btn btn-primary" name="delete_account">Delete your account</button>
            </form>  
            </div>
        </div>
    </div>

    

</body>
</html>