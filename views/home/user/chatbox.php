<?php include('views/layout/user/header.php');
if (!isset($_SESSION)) {
    session_start();
}
?>

<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <!-- <a href="users.php" class="back-icon">
                    <i class="fas fa-arrow-left"></i>
                </a> -->
                <!-- <img src="api/images/<?php echo $row['img']; ?>" alt="">
                <div class="details">
                    <span><?php echo $row['lname'] . ' ' . $row['fname']; ?></span>
                    <div><?php echo $row['status']; ?></div>
                </div> -->
            </header>
            <div class="chat-box">

            </div>
            <form action="#" class="typing-area">
                <input type="text" name="incoming_id" class="incoming_id" value="2" id="" hidden>
                <input type="text" name="message" class="input-field" placeholder="Nhập nội dung ở đây..." autocomplete="off">
                <button id="button">
                    <i class="fab fa-telegram-plane"></i>
                </button>
            </form>
        </section>
    </div>

    <script src="assets/js/chat-event.js"></script>

</body>

</html>