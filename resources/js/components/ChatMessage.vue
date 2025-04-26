<template>
    <div class="container-2">
        <h3 class="text-center">Danh sách liên hệ</h3>
        <div class="messaging">
            <div class="inbox_msg">
                <!-- Cột danh sách liên hệ -->
                <div class="inbox_people">
                    <div class="headind_srch">
                        <div class="recent_heading">
                            <h4>Liên hệ gần đây</h4>
                        </div>
                        <div class="srch_bar">
                            <div class="stylish-input-group">
                                <input type="text" class="search-bar" placeholder="Tìm kiếm theo tên bài đăng ..." v-model="searchQuery" />

                            </div>
                        </div>
                    </div>
                    <div class="inbox_chat">
                        <div v-for="group in filteredChatsGrouped" :key="group.post.id" class="chat_list"
                            :class="{ active_chat: selectedGroup && selectedGroup.post.id === group.post.id }">
                            <div class="chat_people" @click="selectGroup(group)">
                                <div class="chat_img">
                                    <img :src="getFirstImage(group.post)" alt="profile"
                                        style="height: 60px; width: 60px;" />
                                </div>
                                <div class="chat_ib">
                                    <h5>
                                        {{ group.post.title }}
                                        <span v-if="group.post.user_id === authId" class="badge badge-primary ml-1">Bài
                                            của bạn</span>
                                    </h5>

                                </div>
                            </div>
                            <!-- Danh sách người gửi tin nhắn -->
                            <div v-if="selectedGroup && selectedGroup.post.id === group.post.id" class="sender_list">
                                <div v-for="user in group.users" :key="user.id" class="sender_item"
                                    :class="{ active_sender: selectedReceiverId === user.id }"
                                    @click="selectReceiver(user.id)">
                                    <p>{{ user.name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cột tin nhắn -->
                <div class="mesgs" v-if="selectedGroup && selectedReceiverId">
                    <div class="msg_history" ref="msgHistory">
                        <div v-for="msg in sortedMessages" :key="msg.id">
                            <div v-if="msg.sender_id === authId" class="outgoing_msg">
                                <div class="sent_msg">
                                    <p>{{ msg.message }}</p>
                                    <span class="time_date">{{ formatDate(msg.created_at) }}</span>
                                </div>
                            </div>
                            <div v-else class="incoming_msg">
                                <div class="received_msg">
                                    <div class="received_withd_msg">
                                        <p>{{ msg.message }}</p>
                                        <span class="time_date">{{ formatDate(msg.created_at) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="type_msg">
                        <div class="input_msg_write">
                            <input type="text" v-model="newMessage" class="write_msg" placeholder="Tin nhắn"
                                @keyup.enter="sendMessage" />
                            <button class="msg_send_btn" type="button" @click="sendMessage">
                                <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                            </button>
                        </div>
                        <span class="text-danger" v-if="errors.newMessage">{{ errors.newMessage[0] }}</span>
                    </div>
                </div>
                <div class="mesgs" v-else>
                    <p>Chọn một bài đăng và người gửi để xem tin nhắn</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            chatsGrouped: [],
            selectedGroup: null,
            selectedReceiverId: null,
            newMessage: '',
            authId: null,
            errors: {},
            searchQuery: '',
        };
    },
    created() {
        this.authId = window.authId; // Giả sử authId được truyền từ global
        this.fetchChats();

        // Cập nhật tin nhắn định kỳ
        setInterval(() => {
            if (this.selectedGroup && this.selectedReceiverId) {
                this.refreshMessages();
            }
        }, 3000); // Giảm tần suất để tối ưu
    },
    methods: {
        fetchChats() {
            axios.get('/user-all')
                .then((res) => {
                    this.chatsGrouped = res.data;
                    // Không tự động chọn group đầu tiên để tránh lỗi khi không có dữ liệu
                })
                .catch((err) => {
                    console.error('Lỗi khi lấy danh sách chat:', err);
                });
        },
        selectGroup(group) {
            this.selectedGroup = group;
            this.selectedReceiverId = null; // Reset người nhận
            this.refreshMessages();
        },
        selectReceiver(userId) {
            this.selectedReceiverId = userId;
            this.refreshMessages();
        },
        refreshMessages() {
            if (!this.selectedGroup) return;

            axios.get(`/messages-of-group/${this.selectedGroup.post.id}`)
                .then((res) => {
                    this.selectedGroup.messages = res.data.messages;
                    // Cuộn xuống tin nhắn mới nhất
                    this.$nextTick(() => {
                        const msgHistory = this.$refs.msgHistory;
                        if (msgHistory) {
                            msgHistory.scrollTop = msgHistory.scrollHeight;
                        }
                    });
                })
                .catch((err) => {
                    console.error('Lỗi khi làm mới tin nhắn:', err);
                });
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
        getFirstImage(post) {
            if (post.images && post.images.length > 0) {
                let imagePath = post.images[0].image_url;
                if (imagePath.charAt(0) !== '/') {
                    imagePath = '/upload/post_images/' + imagePath;
                }
                return imagePath;
            }
            return '/upload/no_image.jpg';
        },
        async sendMessage() {
            if (!this.newMessage.trim()) {
                this.errors.newMessage = ['Vui lòng nhập tin nhắn'];
                return;
            }
            if (!this.selectedReceiverId) {
                this.errors.newMessage = ['Vui lòng chọn người nhận'];
                return;
            }

            try {
                const response = await axios.post('/send-message', {
                    newMessage: this.newMessage,
                    receiver_id: this.selectedReceiverId,
                    post_id: this.selectedGroup.post.id,
                });

                if (response.data.success) {
                    this.selectedGroup.messages.push(response.data.message);
                    this.newMessage = '';
                    this.errors = {};
                    // Cuộn xuống tin nhắn mới nhất
                    this.$nextTick(() => {
                        const msgHistory = this.$refs.msgHistory;
                        if (msgHistory) {
                            msgHistory.scrollTop = msgHistory.scrollHeight;
                        }
                    });
                }
            } catch (error) {
                console.error('Lỗi khi gửi tin nhắn:', error);
                this.errors.newMessage = [error.response?.data?.message || 'Lỗi khi gửi tin nhắn'];
            }
        },
    },
    computed: {
        sortedMessages() {
            if (!this.selectedGroup || !this.selectedReceiverId) return [];
            return [...(this.selectedGroup.messages || [])]
                .filter((msg) =>
                    (msg.sender_id === this.authId && msg.receiver_id === this.selectedReceiverId) ||
                    (msg.sender_id === this.selectedReceiverId && msg.receiver_id === this.authId)
                )
                .sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
        },
        filteredChatsGrouped() {
            if (!this.searchQuery) return this.chatsGrouped;

            const keyword = this.searchQuery.toLowerCase();
            return this.chatsGrouped.filter(group =>
                group.post.title.toLowerCase().includes(keyword)
            );
        },
    },
};
</script>



<style>
@import '/public/front/css/messages_chat_box.css';
</style>