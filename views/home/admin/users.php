<?php include('views/layout/user/header.php');
if (!isset($_SESSION)) {
    session_start();
} ?>

<body>
    <div class="wrapper">
        <section class="users">
            <header>

            </header>
            <div class="search">
                <span class="text">Lựa chọn bạn bè để trò chuyện</span>
                <input class="" type="text" name="search" id="" placeholder="Nhập tên để tìm kiếm">
                <button class=""><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">
            </div>
        </section>
    </div>

    <script src="assets/js/users-event.js"></script>
</body>

</html>