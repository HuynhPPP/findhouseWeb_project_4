<template>
    <div class="container-2">
        <h3 class="text-center">Danh sách liên hệ</h3>
        <div class="messaging">
            <!-- Cột danh sách liên hệ -->
            <div class="inbox_msg">
                <div class="inbox_people">
                    <div class="headind_srch">
                        <div class="recent_heading">
                            <h4>Liên hệ gần đây</h4>
                        </div>
                        <div class="srch_bar">
                            <div class="stylish-input-group">
                                <input type="text" class="search-bar" placeholder="Tìm kiếm..." />
                                <span class="input-group-addon">
                                    <button type="button">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="inbox_chat">
                        <!-- Lặp qua từng nhóm chat (mỗi nhóm ứng với 1 bài đăng) -->
                        <div v-for="group in chatsGrouped" :key="group.post.id" class="chat_list"
                            :class="{ active_chat: selectedGroup && selectedGroup.post.id === group.post.id }"
                            @click="selectGroup(group)">
                            <div class="chat_people">
                                <div class="chat_img">
                                    <!-- Hiển thị ảnh bài đăng nếu có, hoặc dùng ảnh của user đầu tiên -->
                                    <img :src="getFirstImage(group.post)" alt="profile"
                                        style="height: 60px; width: 60px;" />
                                </div>
                                <div class="chat_ib">
                                    <h5>{{ group.post.title }}</h5>
                                    <!-- Gộp tin nhắn và thời gian vào một hàng -->
                                    <div class="message-row">
                                        <p class="message">{{ group.messages[0].message }}</p>
                                        <span class="chat_date">{{ formatDate(group.messages[0].created_at) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cột tin nhắn của nhóm được chọn -->
                <div class="mesgs" v-if="selectedGroup">
                    <div class="msg_history">
                        <div class="msg_history" ref="msgHistory">
                            <div v-for="msg in sortedMessages" :key="msg.id">
                                <!-- Nếu tin nhắn do người dùng gửi -->
                                <div v-if="msg.sender_id === authId" class="outgoing_msg">
                                    <div class="sent_msg">
                                        <p>{{ msg.message }}</p>
                                        <span class="time_date">{{ formatDate(msg.created_at) }}</span>
                                    </div>
                                </div>
                                <!-- Nếu tin nhắn nhận -->
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
                    </div>
                    <div class="type_msg">
                        <div class="input_msg_write">
                            <input type="text" v-model="newMessage" class="write_msg" placeholder="Type a message" />
                            <button class="msg_send_btn" type="button" @click="sendMessage">
                                <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                            </button>
                        </div>
                        <span class="text-danger" v-if="errors.newMessage">{{ errors.newMessage[0] }}</span>
                    </div>
                </div>
                <!-- Nếu chưa chọn nhóm nào -->
                <div class="mesgs" v-else>
                    <p>Chọn một liên hệ để xem tin nhắn</p>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    data() {
        return {
            chatsGrouped: [], // Mảng chứa nhóm chat theo bài đăng
            selectedGroup: null, // Nhóm chat hiện đang chọn
            newMessage: "",
            authId: null, // Lưu id user hiện tại
            errors: {},
            allMessages: {}, // Dữ liệu tin nhắn trả về từ endpoint /user-message
            selectedUser: null,
        };
    },
    created() {
        // Giả sử authId được truyền từ global (hoặc từ API)
        this.authId = window.authId; // Ví dụ authId = 1
        this.getAllUser();

        setInterval(() => {
            if (this.selectedGroup) {
                this.refreshSelectedGroupMessages();
            }
        }, 1000);

    },
    methods: {
        getAllUser() {
            axios
                .get("/user-all")
                .then((res) => {
                    this.chatsGrouped = res.data;
                    // Nếu có dữ liệu, mặc định chọn nhóm đầu tiên
                    if (!this.selectedGroup && this.chatsGrouped.length > 0) {
                        this.selectedGroup = this.chatsGrouped[0];
                    } else {
                        // Giả sử trong selectedGroup có trường users chứa danh sách đối tác chat
                        const oldPostId = this.selectedGroup?.post?.id;
                        if (oldPostId) {
                            const newSelectedGroup = this.chatsGrouped.find(
                                (g) => g.post.id === oldPostId
                            );
                            if (newSelectedGroup) {
                                this.selectedGroup = newSelectedGroup;
                            }
                        }
                    }
                })
                .catch((err) => {
                    console.error(err);
                });
        },
        userMessage(userId) {
            axios.get('/user-message/' + userId)
                .then((res) => {
                    // Cập nhật dữ liệu tin nhắn từ endpoint
                    // Giả sử res.data có cấu trúc { user: {...}, messages: [...] }
                    this.allMessages = res.data;
                    // Nếu bạn muốn cập nhật lại selectedGroup.messages dựa trên tin nhắn mới,
                    // có thể thực hiện tùy vào logic của bạn. Ví dụ:
                    if (this.selectedGroup) {
                        this.selectedGroup.messages = res.data.messages;
                    }
                    this.selectedUser = userId;
                })
                .catch((err) => {
                    console.error(err);
                });
        },
        selectGroup(group) {
            this.selectedGroup = group;
            // Tìm user còn lại trong group.users
            const otherUser = group.users.find((u) => u.id !== this.authId);
            if (otherUser) {
                this.selectedUser = otherUser.id;
            } else {
                this.selectedUser = null;
            }
        },
        refreshSelectedGroupMessages() {
            if (!this.selectedGroup) return;

            axios.get(`/messages-of-group/${this.selectedGroup.post.id}`)
                .then((res) => {
                    // Cập nhật lại mảng messages cho group hiện tại
                    this.selectedGroup.messages = res.data.messages;
                })
                .catch((err) => {
                    console.error(err);
                });
        },
        formatDate(date) {
            // Định dạng ngày đơn giản; có thể thay bằng moment.js hoặc dayjs
            return new Date(date).toLocaleString();
        },

        getFirstImage(post) {
            // Nếu post có mảng images và có phần tử nào đó, chọn ngẫu nhiên 1 ảnh
            if (post.images && post.images.length > 0) {
                let imagePath = post.images[0].image_url;
                // Nếu đường link không bắt đầu bằng '/', thêm vào phía trước
                if (imagePath.charAt(0) !== '/') {
                    imagePath = '/' + imagePath;
                }
                return imagePath;
            }
            return "/upload/no_image.jpg";
        },

        async sendMessage() {
            if (!this.newMessage.trim()) {
                this.errors.newMessage = ["Vui lòng nhập tin nhắn"];
                return;
            }

            // Giả sử otherUser là đối tác chat (có ID khác authId)
            const otherUser = this.selectedGroup.users.find(u => u.id !== this.authId);
            if (!otherUser) {
                console.error("Không tìm thấy user nào khác trong nhóm chat!");
                return;
            }

            try {
                let response = await axios.post("/send-message", {
                    newMessage: this.newMessage,
                    receiver_id: otherUser.id,   // ID của người kia
                    post_id: this.selectedGroup.post.id,
                });

                if (response.data.success) {
                    this.selectedGroup.messages.push(response.data.message);
                    this.newMessage = "";
                    this.errors = {};
                }
            } catch (error) {
                console.error("Lỗi khi gửi tin nhắn:", error);
                if (error.response && error.response.data.errors) {
                    this.errors = error.response.data.errors;
                }
            }
        }

    },

    computed: {
        sortedMessages() {
            return [...(this.selectedGroup?.messages || [])].sort((a, b) => {
                return new Date(a.created_at) - new Date(b.created_at);
            });
        }
    }

};
</script>



<style>
@import '/public/front/css/messages_chat_box.css';
</style>