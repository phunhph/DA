<?php
class CommentDAO
{
    private $pdo;
    public function __construct()
    {
        require('../config/config.php');
        $this->pdo = $pdo;
    }

    public function getChat()
    {
        session_start(); // You need to start the session to access $_SESSION variables.

        $outgoing_id = $_SESSION['acc'];
        $incoming_id = $_POST['incoming_id'];
        if ($outgoing_id != 10) {
            $incoming_id = 10;
        } // No need to escape this value for PDO.
        $output = "";
        $sql = "SELECT * FROM `chatbox` join users ON users.id_user= chatbox.id_out WHERE id_out=$outgoing_id and id_in=$incoming_id OR id_out=$incoming_id and id_in=$outgoing_id ORDER BY id_msg";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($row['id_out'] == $outgoing_id) {
                    $output .= '<div class="chat outgoing">
                                  <div class="details">
                                    <p>' . $row['msg'] . '</p>
                                  </div>
                                </div>';
                } else {
                    $output .= '<div class="chat incoming">
                                  <div class="details">
                                    <p>' . $row['msg'] . '</p>
                                  </div>
                                </div>';
                }
            }
        } else {
            $output .= "<div class='text'>Không có tin nhắn. Khi bạn có, tin nhắn sẽ hiện tại đây.</div>";
        }

        echo $output;
    }
    public function insertChat()
    {
        session_start(); // Start the session if not already started
        $outgoing_id = $_SESSION['acc'];
        $incoming_id = $_POST['incoming_id'];
        $message = $_POST['message'];
        if ($outgoing_id != 10) {
            $incoming_id = 10;
        }

        if (!empty($message)) {
            // Use prepared statements to prevent SQL injection
            $sql = "INSERT INTO `chatbox`( `id_in`, `id_out`, `msg`) VALUES (:incoming_id, :outgoing_id, :message)";
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':incoming_id', $incoming_id, PDO::PARAM_INT);
            $stmt->bindParam(':outgoing_id', $outgoing_id, PDO::PARAM_INT);
            $stmt->bindParam(':message', $message, PDO::PARAM_STR);

            if ($stmt->execute()) {
                echo "Message inserted successfully.";
            } else {
                echo "Error: " . $stmt->errorInfo()[2];
            }
        }
    }

    public function searchUser($searchTerm)
    {
        session_start(); // Start the session if not already started
        $outgoing_id = $_SESSION['acc'];
        $sql = "SELECT * FROM `users` WHERE id_user != $outgoing_id
        AND (tai_khoan LIKE '%{$searchTerm}%' OR ten LIKE '%{$searchTerm}%')";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();
        $output = "";

        if ($stmt->rowCount() > 0) {
            $output = $this->getFriendList($stmt);
        } else {
            $output .= "Không tìm thấy người dùng liên quan đến từ khóa";
        }
        echo $output;
    }
    public function getusers()
    {
        session_start(); // Start the session if not already started
        $outgoing_id = $_SESSION['acc'];
        $sql = "SELECT * FROM `users` WHERE id_user != :outgoing_id ORDER BY id_user DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':outgoing_id', $outgoing_id);
        $stmt->execute();

        $output = "";

        if ($stmt->rowCount() > 0) {
            $output = $this->getFriendList($stmt);
        } else {
            $output .= "Không có bạn bè hoạt động";
        }
        echo $output;
    }

    public function getFriendList($stmt): string
    {
        $rs = '';

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Use prepared statements to avoid SQL injection
            $sql = "SELECT msg FROM chatbox WHERE 
                (id_in = :unique_id OR id_out = :unique_id) 
                AND (id_out = :outgoing_id OR id_in = :outgoing_id)
                ORDER BY id_msg DESC LIMIT 1";

            $stmt2 = $this->pdo->prepare($sql);
            $stmt2->bindParam(':unique_id', $_SESSION['acc']);
            $stmt2->bindParam(':outgoing_id', $row['id_user']);
            $stmt2->execute();
            $data = $stmt2->fetch(PDO::FETCH_ASSOC);

            $last_mess = (empty($data)) ? "Không có tin nhắn" : $data['msg'];
            $last_mess = (strlen($last_mess) > 28) ? substr($last_mess, 0, 28) . '...' : $last_mess;

            // Determine if you are the last respondent
            $you = ($_SESSION['acc'] == $row['id_user']) ? "Bạn: " : "";

            // Determine user activity
            // $offline = ($row['status'] == "Không hoạt động") ? "offline" : "";
            $offline = "";
            // Generate the user list content
            $rs .= '<a href="index.php?controller=chat&id_user=' . $row['id_user'] . '">
                      <div class="content">
                        <img src="assets/image/user/' . $row['anh'] . '"/>
                        <div class="details">
                          <span>' . $row['tai_khoan'] . ' ' . $row['ten'] . '</span>
                          <div>' . $you . $last_mess . '</div>
                        </div>
                      </div>
                      <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                    </a>';
        }
        return $rs;
    }
}
