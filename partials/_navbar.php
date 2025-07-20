<nav class="navbar navbar-expand-lg bg-primary navbar-dark">
        <div class="container">
            <a href="index.php" class="navbar-brand">STACKOWER</a>

            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a href="index.php" class="nav-link">Home</a>
                </li>
                
                <li class="nav-item">
                    <a href="quesiton.php" class="nav-link">Questions</a>
                </li>
                <l class="nav-item">
                    <a href="addNewQuestion.php" class="nav-link">Add New Question</a>
                </l>
                <li class="nav-item">
                    <a href="profile.php" class="nav-link">Profile</a>
                </li>
                
            </ul>

            <ul class="navbar-nav me-2">
                <?php if (isset($_SESSION["isLogin"])) : ?>
                    
                    <li class="nav-item">
                        <a href="#" class="nav-link">Hoş geldiniz <?php echo $_COOKIE["name"] ?>!</a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link">Logout</a>
                    </li>

                <?php else : ?>
                    <li class="nav-item">
                        <a href="login.php" class="nav-link">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="register.php" class="nav-link">Register</a>
                    </li>
                    
                <?php endif; ?>
            </ul>

        </div>
    </nav>