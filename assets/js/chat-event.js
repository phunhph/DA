// Lựa chọn các phần tử DOM
const form = document.querySelector(".typing-area");
const inputField = form.querySelector(".input-field");
const sendBtn = document.getElementById("button");
const chatBox = document.querySelector(".chat-box");
// Lấy giá trị incoming_id từ một trường ẩn trong form
const incoming_id = form.querySelector(".incoming_id").value;

// Ngăn chặn sự kiện gửi form mặc định
form.onsubmit = (e) => {
  e.preventDefault();
};

// Đặt trọng tâm vào trường nhập
inputField.focus();

// Sự kiện khi người dùng gõ vào trường nhập
inputField.onkeyup = () => {
  if (inputField.value != "") {
    sendBtn.classList.add("active"); // Thêm class "active" vào nút gửi khi trường nhập không trống
  } else {
    sendBtn.classList.remove("active"); // Loại bỏ class "active" khỏi nút gửi khi trường nhập trống
  }
};

// Sự kiện khi người dùng nhấn nút gửi
sendBtn.onclick = () => {
  // Tạo một đối tượng XMLHttpRequest để thực hiện yêu cầu HTTP
  let xhr = new XMLHttpRequest();

  // Cấu hình yêu cầu: gửi yêu cầu POST đến "api/insert-chat.php" và sử dụng chế độ bất đồng bộ
  xhr.open("POST", "api/insert-chat.php", true);

  // Xử lý sự kiện khi yêu cầu hoàn thành
  xhr.onload = () => {
    // Kiểm tra xem yêu cầu đã hoàn thành thành công và trả về mã HTTP 200 (OK)
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      // Đặt giá trị của trường nhập là chuỗi rỗng, xóa nội dung đã gửi
      inputField.value = "";

      // Cuộn hộp chat xuống dưới cùng để hiển thị tin nhắn mới nhất
      scrollToBottom();
    }
  };

  // Tạo một đối tượng FormData để chứa dữ liệu biểu mẫu từ form
  let formData = new FormData(form);

  // Gửi yêu cầu XMLHttpRequest với dữ liệu biểu mẫu
  xhr.send(formData);
};

// Lập lịch gửi yêu cầu cập nhật chat định kỳ
setInterval(() => {
  // Tạo một đối tượng XMLHttpRequest để thực hiện yêu cầu HTTP
  let xhr = new XMLHttpRequest();
  // Cấu hình yêu cầu: gửi yêu cầu POST đến "api/get-chat.php" và sử dụng chế độ bất đồng bộ
  xhr.open("POST", "api/get-chat.php", true);

  // Xử lý sự kiện khi yêu cầu hoàn thành
  xhr.onload = () => {
    // Kiểm tra xem yêu cầu đã hoàn thành thành công và trả về mã HTTP 200 (OK)
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      // Cập nhật nội dung của hộp chat với phản hồi từ máy chủ
      chatBox.innerHTML = xhr.response;
      // Nếu hộp chat không có lớp "active" (không đang tương tác), cuộn xuống dưới cùng để hiển thị tin nhắn mới nhất
      if (!chatBox.classList.contains("active")) {
        scrollToBottom();
      }
    }
  };

  // Đặt tiêu đề "Content-type" của yêu cầu là "application/x-www-form-urlencoded"
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  // Gửi yêu cầu XMLHttpRequest với dữ liệu "incoming_id" để xác định người nhận tin nhắn
  xhr.send("incoming_id=" + incoming_id);
}, 500);

// Sự kiện khi con trỏ chuột vào chat box
chatBox.onmouseenter = () => {
  chatBox.classList.add("active");
};

// Sự kiện khi con trỏ chuột ra khỏi chat box
chatBox.onmouseleave = () => {
  chatBox.classList.remove("active");
};

// Hàm cuộn xuống dưới cùng của chat box
function scrollToBottom() {
  chatBox.scrollTop = chatBox.scrollHeight;
}
