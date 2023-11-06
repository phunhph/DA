<?php include('views/layout/user/header.php') ?>

<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Chatapp Realtime</header>
            <form action="index.php?controller=signup" method="post">
                <div class="error-text"></div>

                <!-- name row -->
                <div class="name-details">
                    <div class="field input">
                        <ltabel for="">tài khoản</ltabel>
                        <input type="text" name="tai_khoan" placeholder="tài khoản" required>
                    </div>
                    <!-- <div class="field input">
                        <label for="">Họ</label>
                        <input type="text" name="lname" placeholder="Họ" required>
                    </div> -->
                </div>

                <div class="field input">
                    <label for="">Email</label>
                    <input type="email" name="email" placeholder="Nhập Email" required>
                </div>

                <div class="field input">
                    <label for="">Mật khẩu</label>
                    <input type="password" name="password" placeholder="Nhập mật khẩu" required>
                    <input type="hidden" name="role" value="4">
                    <i class="fas fa-eye"></i>
                </div>

                <!-- <div class="field image">
                    <label for="">Ảnh đại diện</label>
                    <input type="file" name="image" accept="image/x-png,image/jpeg,image/jpg" required>
                </div> -->
                <div class="field button">
                    <input type="submit" name="signup" value="sign up">
                </div>

            </form>
            <div class="link">Đã có tài khoản? <a href="index.php?controller=login">Đăng nhập ngay</a></div>
        </section>
    </div>
</body>

</html>