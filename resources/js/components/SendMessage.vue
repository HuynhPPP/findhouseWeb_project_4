<template>
  <!-- Popup chat -->
  <div class="chat-popup" id="chatPopup">
    <!-- Tiêu đề popup -->
    <div class="chat-popup-header">
      <h5>Hộp thoại</h5>
      <button class="close-btn" onclick="closeChatPopup()">&times;</button>
    </div>
    <!-- Nội dung 2 cột -->
    <div class="chat-popup-body">
      <!-- Cột trái: Danh sách chat -->
      <div class="chat-list-col">
        <!-- Thanh tìm kiếm -->
        <div class="chat-search">
          <input type="text" placeholder="Nhập ít nhất 3 ký tự để tìm...">
        </div>
        <!-- Danh sách cuộc hội thoại -->
        <div class="chat-list">
          <a href="javascript:void(0)" class="chat-list-item active">
            <div class="user-info">
              <img src="{{ asset('front\images\avt\avt1.jpg') }}" alt="avatar">
              <div>
                <h6>Trường Giang</h6>
                <small>Hoạt động 2 ngày trước</small>
              </div>
            </div>
          </a>
          <a href="javascript:void(0)" class="chat-list-item">
            <div class="user-info">
              <img src="{{ asset('front\images\avt\avt2.jpg') }}" alt="avatar">
              <div>
                <h6>Quang Phạm</h6>
                <small>1 ngày trước</small>
              </div>
            </div>
          </a>
          <!-- Thêm các item khác nếu muốn -->
        </div>
      </div>
      <!-- Cột phải: Khung chat chính -->
      <div class="chat-content-col">
        <!-- Header khung chat -->
        <div class="chat-content-header">
          <img src="{{ asset('front\images\avt\avt3.jpg') }}" alt="avatar">
          <div>
            <h6>Trường Giang</h6>
            <small>Hoạt động 2 ngày trước</small>
          </div>
        </div>
        <!-- Nội dung tin nhắn -->
        <div class="chat-messages">
          <div class="message-bubble">
            <p class="mb-1">
              Phòng Trọ FULL NỘI THẤT Cao Cấp 25M2, công viên Hùng Vương 2.5tr
            </p>
            <span class="price">3 triệu/tháng</span>
          </div>
          <div class="message-bubble">
            <p class="mb-1">Nội dung tin nhắn khác...</p>
            <small class="text-muted">1 giờ trước</small>
          </div>
        </div>
        <!-- Ô nhập tin nhắn -->
        <div class="chat-input">
          <div style="display: flex; align-items: center;">
            <input type="text" class="chat-input-box" id="chatMessage" placeholder="Nhập tin nhắn...">
            <button class="send-btn" onclick="sendChatMessage()">
              <i class="fa fa-paper-plane"></i> Gửi
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    openChatPopup() {
      document.getElementById('chatPopup').classList.add('active');
    },
    closeChatPopup() {
      document.getElementById('chatPopup').classList.remove('active');
    }
  },
  mounted() {
    window.openChatPopup = this.openChatPopup;
    window.closeChatPopup = this.closeChatPopup;
  }
};
</script>

<style>
@import '/public/front/css/popup_chat.css';
</style>
