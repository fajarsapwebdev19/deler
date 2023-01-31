<div class="page-content">
    <div class="form-v5-content">
        
        <form class="form-detail" action="#" method="post">
            <h2>Login</h2>
            <?php
                session_start();

                if(isset($_SESSION['val']))
                {
                    echo $_SESSION['val'];
                    unset($_SESSION['val']);
                }
            ?>
            <div id="pesan"></div>
            <div class="form-row">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="input-text" placeholder="Your Username" required>
                <i class="fas fa-user"></i>
            </div>
            <div class="form-row">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="input-text" placeholder="Your Password" required>
                <i class="fas fa-lock"></i>
            </div>
            <div class="form-row-last">
                <input type="button" id="login" class="register" value="Login">
            </div>
        </form>
    </div>