<template>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Chat With Instructor {{receivername}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form @submit.prevent="sendMessage()" >
      <div class="modal-body">
        <textarea class="form-control" v-model="form.message" rows="5" id="comment" placeholder="Write you message"></textarea>
        <span class="text-success" v-if="successMessage.message">{{ successMessage.message }}</span>
        <span class="text-danger" v-if="errors.message">{{ errors.message[0] }}</span>
      </div>
      <div class="modal-footer">

        <button type="submit" class="btn btn-danger"> Send <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
        </button>
      </div>
      </form>
    </div>
  </div>
</div>
</template>



<script>
export default {
  props: ['receiverid', 'receivername'],
  data() {
    return {
      form: {
        message: "",
        receiver_id: this.receiverid,
      },
      errors :{},
      successMessage : {}
    };
  },
  methods: {
    sendMessage() {
        //   alert(this.form.message);
        axios.post('/send-message', this.form)
        .then((res) => {
            this.form.message = "",
            this.successMessage = res.data;
            
        }).catch((err) => {
            this.errors = err.response.data.errors;
        })
    }
  }
};
</script>