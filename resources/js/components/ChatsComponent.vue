<template>    
    <div class="row">
    
        <div class="col-8">
            <div class="card card-default">
                <div class="card-header">Messages</div>
                <div class="card-body p-0">
                    <ul class="list-unstyled" style="height:300px;overflow-y: scroll" v-chat-scroll>
                        <li class="p-2" v-for="(message, index) in messages" :key="index">
                            <strong>{{ message.user.name }}</strong>
                            {{ message.message }}
                        </li>
                    </ul>
                </div>
                <input type="text" @keydown="sendTypingEvent" @keyup.enter="sendMessage" v-model="newMessage" name="messages" placeholder="enter messages" class="form-control">                
            </div>
               <span class="text-muted" v-if="activeUser" >{{ activeUser.name }} is typing...</span>
        </div>
        <div class="col-4">
            <div class="div card card-default">
                <div class="card-header">Active User</div>
                <div class="card-body">
                    <ul>
                        <li class="py-2" v-for="(user, index) in users" :key="index">{{ user.name  }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['user'],
        data(){
            return {
                messages : [],
                newMessage : '',
                users : [],
                event : [],
                activeUser: false,
                typingTimer: false,
            }
        },
        created() {
            this.fetchMessages()

            Echo.join('chat.loh')
            .here(user => {
                this.users = user
            })
            .joining(user => {
                this.users.push(user)
            })
            .leaving(user => {
                this.users = this.users.filter(u => u.id != user.id)
            })
            .listen('MessageSent', (event) =>{
                this.messages.push(event.message)
                this.event.push(event)
            })
            .listenForWhisper('typing', user => {
                   this.activeUser = user;
                    if(this.typingTimer) {
                        clearTimeout(this.typingTimer);
                    }
                   this.typingTimer = setTimeout(() => {
                       this.activeUser = false;
                   }, 3000);
             })
        },
        methods: {
            fetchMessages(){
                axios.get('messages').then(response => {
                    this.messages = response.data;
                })
            },

            sendMessage(){
                this.messages.push({
                    user:this.user,
                    message:this.newMessage
                })
                axios.post('messages', {message:this.newMessage}).then(response => {
                    
                })
                this.newMessage = ''
            },
            sendTypingEvent(){
                Echo.join('chat.loh')
                    .whisper('typing', this.user);
            }
        },
    }
</script>
