<?php include('views/layout/user/header.php');
if (!isset($_SESSION)) {
    session_start();
} ?>

<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <a href="index.php?controller=home" class="back-icon">
                    <i class="fas fa-arrow-left"></i>
                </a>

            </header>
            <div class="chat-box">

            </div>
            <form action="#" class="typing-area">
                <input type="text" name="incoming_id" class="incoming_id" value="<?php echo $_GET['id_user'] ?>" id="" hidden>
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