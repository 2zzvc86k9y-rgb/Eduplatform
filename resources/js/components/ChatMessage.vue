<template>
  <div class="row" style="width: 990px;">
    <div class="col-md-3 myUser">
      <ul class="user">
        <strong>Chat List</strong>
        <hr/>
        <li v-for="(user, index) in users" :key="index">
          <a href="" @click.prevent="userMessage(user.id)">
            <img
              v-if="user.role === 'user'"
              :src="'/upload/user_image/' + user.photo"
              alt="UserImage"
              class="userImg"
            />
            <img
              v-else
              :src="'/upload/instructor_image/' + user.photo"
              alt="UserImage"
              class="userImg"
            />
            <span class="text-center username">{{ user.name }}</span>
          </a>
        </li>
      </ul>
    </div>







    <div class="col-md-9" v-if="allmessages && allmessages.user">
      <div class="card">
        <div class="text-center card-header myrow">
          <strong>Selected {{ allmessages.user.name }}</strong>
        </div>



        <div class="card-body chat-msg">
          <ul class="chat" v-for="(message,index) in allmessages.messages" :key="index" >
           <li class="sender clearfix" v-if="allmessages.user.id === message.sender_id" >
              <span class="chat-img left clearfix mx-2">
              <img :src="'/upload/instructor_image/'+ message.user.photo"
                  class="userImg"
                  alt="userImg"
                />
              </span>
              <div class="chat-body2 clearfix">
                <div class="header clearfix">
                  <strong class="primary-font">{{ message.user.name }}</strong>
                  <small class="right text-muted">
                    {{  formatDate(message.created_at) }}
                  </small>
                  
                </div>
                <p>{{ message.message }}</p>
              </div>
            </li>
        <!-- my part  -->
            <li class="buyer clearfix" v-else>
              <span class="chat-img right clearfix mx-2">
                <img :src="'/upload/user_image/'+ message.user.photo"
                  class="userImg"
                  alt="userImg"
                />
                 </span>
              <div class="chat-body clearfix">
                <div class="header clearfix">
                  <small class="left text-muted"
                    >{{  formatDate(message.created_at) }}</small>
                  <strong class="right primary-font">{{ message.user.name }} </strong>  
                  
                </div>
                <p>{{ message.message }}</p>
              </div>
            </li>
        
            <li class="sender clearfix">
              <span class="chat-img left clearfix mx-2"> </span>
            </li>
          </ul>
        </div>





        <div class="card-footer">
          <div class="input-group">
            <input
              id="btn-input"
              type="text"
              v-model="message"
              class="form-control input-sm"
              placeholder="Type your message here..."
            />
            <span class="input-group-btn">
              <button class="btn btn-primary" @click.prevent="sendMessage()">Send</button>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>



  <script>
export default {
  data() {
    return {
      users: {},
      allmessages: {},
      selectedUser: {},
      message: '',
    };
  },
  created() {
    this.getAllUsers();

    setInterval(() => {
      this.userMessage(this.selectedUser);
    },1000);
  },
  methods: {
    
    getAllUsers() {
      axios.get('/get-all-users')
        .then((res) => {
          this.users = res.data;
          console.log('Users:', res.data);
        })
        .catch((err) => {
          console.error('Error fetching users:', err);
        });
    },
    userMessage(userId) {
      console.log('Fetching messages for user ID:', userId); // Debugging log
      axios.get('/get-user-message/' + userId)
        .then((res) => {
          this.selectedUser = userId;
          this.allmessages = res.data;
          console.log('All messages:', res.data);
        })
        .catch((err) => {
          console.error('Error fetching user messages:', err);
        });
    },
    sendMessage() {
      axios.post('/send-message', { receiver_id: this.selectedUser, message: this.message })
        .then((res) => {
          this.message = '';
          this.userMessage(this.selectedUser);
          console.log('Message sent:', res.data);
        })
        .catch((err) => {
          console.error('Error sending message:', err);
        });
    },
    formatDate(dateString) {
      const options = { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' };
      return new Date(dateString).toLocaleDateString('en-US', options);
    }
  }
};
</script>


  <style>

  .username {
    color: #000;
    margin-left: 5px;
    font-size: 13px;
  }

  .myrow{
      background: #F3F3F3;
      padding: 25px;
  }

  .myUser{
       padding-top: 30px;
       overflow-y: scroll;
      /* height: 100%; */
      background: #F2F6FA;

  }
 
  .user li {
    list-style: none;
    margin-top: 20px;

  }

  .user li a:hover {
    text-decoration: none;
    color: red;
  }
  .userImg {
    height: 35px;
    border-radius: 50%;
  }
  .chat {
    list-style: none;
    margin: 0;
    padding: 0;
  }

  .chat li {
  margin-bottom: 30px;
  padding-bottom: 5px;
  margin-top: 20px;
  width: 85%;
  height: 10px;
}

  .chat li .chat-body p {
    margin: 0;
  }

  .chat-msg {
    overflow-y: scroll;
    height: 350px;
    background: #F2F6FA;
  }
  .chat-msg .chat-img {
    width: 100px;
    height: 100px;
  }
  .chat-msg .img-circle {
    border-radius: 50%;
  }
  .chat-msg .chat-img {
    display: inline-block;
  }
  .chat-msg .chat-body {
    display: inline-block;
    max-width: 85%;
    margin-right: -60px  !important;
    background-color: #f5dfe4;
    border-radius: 12.5px;
    padding: 15px;
  }
  .chat-msg .chat-body2 {
    display: inline-block;
    max-width: 85%;
    margin-left: -60px !important;
    background-color: #080000;
    border-radius: 12.5px;
    padding: 15px;
  }
  .chat-msg .chat-body strong {
    color: #0169da;
  }

  .chat-msg .buyer {
    text-align: right;
    float: right;
  }
  .chat-msg .buyer p {
    text-align: left;
  }
  .chat-msg .sender {
    text-align: left;
    float: left;
  }
  .chat-msg .left {
    float: left;
  }
  .chat-msg .right {
    float: right;
  }

  .clearfix {
    clear: both;
  }
  .clearfix::after {
  content: "";
  clear: both;
  display: table;
}

  </style>

