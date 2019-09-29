require('./bootstrap');

window.Vue = require('vue');

//For Scroll Down
import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll)

//For Notifcation
import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'
Vue.use(Toaster, {timeout: 5000})

Vue.component('message', require('./components/message.vue'));
Vue.component('notification', require('./components/notification.vue'));
Vue.component('alerts', require('./components/alerts.vue'));

const app = new Vue({
    el: '#app',
    data:{
        message : '',
        user_id : $('#user_id').val(),
        user_email : $('#user_email').val(),
        resident : $('#txt_resident').val(),
        chat:{
            message:[],
            user:[],
            color:[],
            time:[],
            image:[],
            avatar:[],
        },
        limit : 8,
        notification_count : 0,
        alerts_resident_count : 0,
        alerts_resident_type : $('#user_role').val(),
        notification_data : {
            link :[],
            image :[],
            message :[],
            email :[],
            time :[],
            id :[],
        } ,
        alerts_resident : {
            visitor_id :[],
            statues :[],
            resident_id :[],
            finish :[],
            time :[],
            id :[],
            links :[],
        } ,
        msg:{
            error: '',
            type: '',
            view: false,
        },
        typing:'',
    },
    watch:{
        message(){
            Echo.private('chat')
                .whisper('typing', {
                    name: this.message
                });
        }
    },
    methods : {
        load_more(){
            var current = this.limit;
            this.limit = current + 10;
            this.getOldMessage();
        },
        send(){
            if(this.message.length == 0){
                this.msg.type = 'alert-danger';
                this.msg.view = true;
                this.msg.error = 'no data to send';
            }
            else{
                let formData = new FormData();
                formData.append('resident',this.resident);
                formData.append('message', this.message);
                axios.post('/send_message', formData, null)
                    .then(response => {
                        //console.log(response);
                        this.getOldMessage();
                        this.notification();
                        this.message = '';
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        },
        alerts_resident_met(){
            axios.post('/alerts_resident',{
                type:this.alerts_resident_type,
            })
                .then(response =>  {
                    //console.log(response);
                    this.alerts_resident.visitor_id = [];
                    this.alerts_resident.resident_id = [];
                    this.alerts_resident.statues = [];
                    this.alerts_resident.finish = [];
                    this.alerts_resident.id = [];
                    this.alerts_resident.time = [];
                    this.alerts_resident.links = [];
                    if(response.data.length != 0){
                        for (var r = 0 ;r < response.data.length ; r ++){
                            if(this.user_id == response.data[r].resident_id){
                                this.alerts_resident.id.push(response.data[r].id);
                                this.alerts_resident.time.push(response.data[r].created_at);
                                this.alerts_resident.finish.push(response.data[r].finish);
                                this.alerts_resident.statues.push('You have been selected to help ' + response.data[r].statues + ' move around the country');
                                this.alerts_resident.resident_id.push(response.data[r].resident.name);
                                this.alerts_resident.visitor_id.push(response.data[r].visitor.name);
                                this.alerts_resident.links.push('/profile/' + response.data[r].visitor.email + "/" + response.data[r].visitor.id);
                            }
                            else{
                                this.alerts_resident.id.push(response.data[r].id);
                                this.alerts_resident.time.push(response.data[r].created_at);
                                this.alerts_resident.finish.push(response.data[r].finish);
                                this.alerts_resident.statues.push('The tour is now On Progress');
                                this.alerts_resident.resident_id.push(response.data[r].resident.name);
                                this.alerts_resident.visitor_id.push(response.data[r].visitor.name);
                                this.alerts_resident.links.push('/profile/' + response.data[r].resident.email + "/" + response.data[r].resident.id);
                            }
                        }
                    }
                    this.alerts_resident_count = response.data.length;
                })
                .catch(error => {
                    //console.log(error);
                });
        },
        notification(){
            axios.get('/notification',)
                .then(response =>  {
                    //console.log(response);
                    this.notification_data.image = [];
                    this.notification_data.email = [];
                    this.notification_data.link = [];
                    this.notification_data.message = [];
                    this.notification_data.id = [];
                    this.notification_data.time = [];
                    var count = 0;
                    if(response.data.length != 0){
                        for (var r = 0 ;r < response.data.length ; r ++){
                            if(this.user_id != response.data[r].resident_id){
                                if(this.user_email == response.data[r].resident.email){
                                    this.notification_data.email.push(response.data[r].resident.email);
                                    this.notification_data.link.push('/profile/'+response.data[r].resident.email+"/"+response.data[r].resident.id);
                                    this.notification_data.id.push(response.data[r].id);
                                    this.notification_data.message.push(response.data[r].message);
                                    this.notification_data.time.push(response.data[r].created_at);
                                    var img = '<img src="/'+ response.data[r].resident.avatar +'" class="img" style="border-radius:100%;width: 30px;height: 30px">';
                                    this.notification_data.image.push(img);
                                    count = count + 1;
                                }
                            }
                            else{
                                if(this.user_email != response.data[r].visitor.email){
                                    this.notification_data.email.push(response.data[r].visitor.email);
                                    this.notification_data.link.push('/profile/'+response.data[r].visitor.email+"/"+response.data[r].visitor.id);
                                    this.notification_data.id.push(response.data[r].id);
                                    this.notification_data.message.push(response.data[r].message);
                                    this.notification_data.time.push(response.data[r].created_at);
                                    var img = '<img src="/'+ response.data[r].visitor.avatar +'" class="img" style="border-radius:100%;width: 30px;height: 30px">';
                                    this.notification_data.image.push(img);
                                    count = count + 1;
                                }
                            }
                            this.notification_count = count;
                        }
                    }
                    else{
                        this.notification_count = 0;
                    }
                })
                .catch(error => {
                    //console.log(error);
                });
        },
        getOldMessage(x){
            axios.post('/message_travel',{
                resident:this.resident,
                limit:this.limit,
            })
                .then(response =>  {
                    //console.log(response);
                    this.chat.message = [];
                    this.chat.color = [];
                    this.chat.user = [];
                    this.chat.image = [];
                    this.chat.time = [];
                    if(response.data.length != 0){
                        var current = this.limit;
                        this.limit = current + 1;
                        this.msg.type = '';
                        this.msg.view = false;
                        this.msg.error = '';
                        var avatat_local = '';
                        for (var r = 0 ;r < response.data.length ; r ++){
                            this.chat.message.push(response.data[r].message);
                            if(this.resident == response.data[r].resident_id){
                                this.chat.color.push('success');
                                //this.chat.user.push(response.data[r].visitor.name);
                                this.chat.user.push('You');
                            }
                            else{
                                this.chat.color.push('warning');
                                this.chat.user.push(response.data[r].visitor.name);
                            }

                            if(x){
                                avatat_local = '<img src="'+ geturlphoto() + response.data[r].resident.avatar +'" class="img" style="border-radius:100%;width: 40px;height: 40px">';
                            }
                            else{
                                avatat_local = '<img src="'+ geturlphoto() + response.data[r].visitor.avatar +'" class="img" style="border-radius:100%;width: 40px;height: 40px">';
                            }

                            this.chat.time.push(response.data[r].created_at);
                            if(response.data[r].read_it == 0){
                                 axios.post('/read_send_message',{
                                     id:response.data[r].id,
                                 })
                                     .then(response =>  {
                                     })
                                     .catch(error => {
                                         //console.log(error);
                                     });

                            }
                            this.chat.avatar.push(avatat_local);
                        }
                    }
                    else{
                        this.msg.type = 'alert-danger';
                        this.msg.view = true;
                        this.form_post = true;
                        this.msg.error = 'no data to display';
                    }
                })
                .catch(error => {
                    //console.log(error);
                });
        },
    },
    mounted(){
        let self = this;
        self.notification();
        self.getOldMessage();
        self.alerts_resident_met();

        $(document).on('click', '.click_message', function () {
            var va = $(this).data('id');
            axios.post('/read_it_message',{
                id : va,
            })
                .then(response =>  {
                   console.log(response);



                })
                .catch(error => {
                    //console.log(error);
                });
        });
        Echo.private('travel')
            .listen('ChoiceTravelEvent', (e) => {
                this.alerts_resident_met();
            });
        Echo.private('chat')
            .listen('ChatEvent', (e) => {
                //console.log(e);
                this.notification();
                this.alerts_resident_met();
                this.getOldMessage('yes');
                var x = document.getElementById("plucky");
                x.play();
            })
            .listenForWhisper('typing', (e) => {
                if(e.name != ''){
                    this.typing = 'typing...';
                }
                else{
                    this.typing = '';
                }
            });
    }
});
