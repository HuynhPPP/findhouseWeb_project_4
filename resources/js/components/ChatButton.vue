<template>
    <input class="multiple-send-message-2" @click="$emit('open-chat')" value="Nhắn tin" />
</template>

<script>
export default {
    methods: {
        openChatPopup() {
            // Gọi sự kiện mở popup chat
            this.$emit("open-chat");
            this.fetchMessages();
        },
    },
};
</script>
