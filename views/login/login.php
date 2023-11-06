<?php include('views/layout/user/header.php');
if (!isset($_SESSION)) {
    session_start();
} ?>

<body>
    <div class="wrapper">
        <section class="form login">
            <header>Chatapp Realtime</header>
            <form action="index.php?controller=login" method="post">
                <div class="error-text"></div>


                <div class="field input">
                    <label for="">Username</label>
                    <input type="text" name="username" <?php
                                                        if (isset($_SESSION['username'])) {
                                                            echo 'value="' . $_SESSION['username'] . '"';
                                                        }
                                                        ?> placeholder="Nhập Email" required>
                </div>
                <div class="field input">
                    <label for="">Password</label>
                    <input type="password" name="password" <?php
                                                            if (isset($_SESSION['password'])) {
                                                                echo 'value="' . $_SESSION['password'] . '"';
                                                            }
                                                            ?> placeholder="Nhập mật khẩu" required>
                    <i class="fas fa-eye"></i>
                </div>

                <div class="field button">
                    <input type="submit" name="signin" value="Sign in">
                </div>

            </form>
            <div class="link">Chưa có tài khoản? <a href="index.php?controller=signup">Đăng ký ngay</a></div>
        </section>
    </div>

    <script src="assets/password-event.js"></script>
    <script src="assets/login.js"></script>
</body>

</html>