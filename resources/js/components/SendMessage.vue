<template>
  <!-- Popup chat -->
  <div class="chat-popup" id="chatPopup">
    <!-- Tiêu đề popup -->
    <div class="chat-popup-header">
      <h5>Hộp thoại</h5>
      <button class="close-btn" @click="closeChatPopup()">&times;</button>
    </div>
    <!-- Nội dung 2 cột -->
    <div class="chat-popup-body">
      <div class="chat-content-col">
        <!-- Header khung chat -->
        <div class="chat-content-header">
          <img :src="poster_avatar" alt="Avatar" class="user-avatar">
          <div>
            <h6>{{ poster_name }}</h6>
            <small v-if="onlineStatus">
              <span v-if="onlineStatus.status === 'online'" class="text-success">Đang hoạt động</span>
              <span v-else>Hoạt động {{ onlineStatus.last_seen }}</span>
            </small>

          </div>
        </div>
        <!-- Nội dung tin nhắn -->
        <div class="chat-messages">
          <div class="message-bubble">
            <p class="mb-1">
              {{ post_name }}
            </p>
            Giá thuê: <span class="price">{{ formattedPrice }}</span>
          </div>
          <!-- Danh sách tin nhắn -->
          <div class="chat-container">
            <div v-for="(message, index) in messages" :key="index"
              :class="{ 'message-bubble-sender': message.sender_id === currentUserId, 'message-bubble-receiver': message.sender_id !== currentUserId }">
              <p class="message-text">{{ message.message }}</p>
              <span class="time_date">{{ formatDate(message.created_at) }}</span>
            </div>
          </div>
        </div>

        <!-- Ô nhập tin nhắn -->
        <form @submit.prevent="sendMessage">
          <div class="chat-input">
            <div style="display: flex; align-items: center;">
              <input v-model="newMessage" type="text" class="chat-input-box" placeholder="Nhập tin nhắn..." />
              <button type="submit" class="send-btn">
                <i class="fa fa-paper-plane"></i> Gửi
              </button>
            </div>
            <span class="text-danger" v-if="errors.newMessage">{{ errors.newMessage[0] }}</span>
          </div>
        </form>

      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['poster_id', 'post_name', 'poster_name', 'price', 'poster_avatar', 'post_id'],

  data() {
    return {
      newMessage: "", // Nội dung tin nhắn mới
      messages: [], // Danh sách tin nhắn hiển thị
      receiver_id: this.poster_id,
      currentUserId: null,
      errors: {},
      onlineStatus: null,
    };
  },

  created() {
    this.currentUserId = window.authId; // Gán ID người dùng hiện tại
  },

  mounted() {
    this.fetchMessages(); // Tải tin nhắn khi component được mount
    this.intervalId = setInterval(this.fetchMessages, 1000);

    this.fetchUserOnlineStatus();
    setInterval(this.fetchUserOnlineStatus, 60000); // Kiểm tra mỗi phút

  },

  methods: {

    async fetchMessages() {
      try {
        const response = await axios.get(`/messages-of-group/${this.post_id}`);
        if (response.data.success) {
          this.messages = response.data.messages;
        } else {
          this.errors.message = response.data.message || 'Không thể tải tin nhắn';
        }
      } catch (error) {
        console.error('Lỗi khi lấy tin nhắn:', error);
        this.errors.message = 'Không thể tải tin nhắn';
      }
    },

    async sendMessage() {
      if (!this.newMessage.trim()) {
        this.errors.newMessage = ["Vui lòng nhập tin nhắn"];
        return;
      }

      try {
        let response = await axios.post("/send-message", {
          newMessage: this.newMessage,
          receiver_id: this.receiver_id,
          post_id: this.post_id,
        });

        if (response.data.success) {
          this.messages.push({ text: this.newMessage });
          this.newMessage = ""; // Xoá nội dung input
          this.errors = {}; // Xóa lỗi nếu có trước đó
          await this.fetchMessages();
        }
      } catch (error) {
        console.error("Lỗi khi gửi tin nhắn:", error);
        if (error.response && error.response.data.errors) {
          this.errors = error.response.data.errors;
        }
      }
    },

    async fetchUserOnlineStatus() {
      try {
        const response = await axios.get(`/user-online-status/${this.poster_id}`);
        this.onlineStatus = response.data;
      } catch (error) {
        console.error('Không thể lấy trạng thái hoạt động:', error);
      }
    },


    formatDate(date) {
      return new Date(date).toLocaleString('vi-VN', {
        hour: '2-digit',
        minute: '2-digit',
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
      });
    },

    closeChatPopup() {
      document.getElementById('chatPopup').classList.remove('active');
    },
  },


  computed: {
    formattedPrice() {
      if (this.price >= 1000000) {
        return (this.price / 1000000).toFixed(1) + " triệu/tháng";
      }
      return new Intl.NumberFormat('vi-VN').format(this.price) + " đồng/tháng";
    }
  },
};
</script>

<style>
@import '/public/front/css/popup_chat.css';
</style>
