import "./bootstrap";
import { createApp } from "vue/dist/vue.esm-bundler.js";
import SendMessage from "./components/SendMessage.vue";
import ChatButton from "./components/ChatButton.vue";
import ChatMessage from "./components/ChatMessage.vue";

const chatButtonApp = createApp({
    components: { ChatButton },
    methods: {
        openChatPopup() {
            document.getElementById("chatPopup").classList.add("active");
        },
    },
});
chatButtonApp.mount("#chatButtonApp");

// Ứng dụng dành cho SendMessage
const chatApp = createApp({
    components: { SendMessage },
});
chatApp.mount("#app-live-chat");

// Ứng dụng dành cho SendMessage
const chatBoxApp = createApp({
    components: { ChatMessage },
});
chatBoxApp.mount("#app-chat-box");

import Alpine from "alpinejs";
window.Alpine = Alpine;
Alpine.start();
