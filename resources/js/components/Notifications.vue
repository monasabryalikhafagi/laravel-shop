<template>
<ul>
    <li v-for="notification in notifications">{{notification.id}} </li>
</ul>
</template>

<script>
    export default {
        name:'Notifications',
        data(){
            return{
              notifications:[]
            }   
        },
        mounted() {
          axios.get(`/notifications/get-notifications`).then((res) => {
            this.notifications = res.data.notifications;
           });
           Echo.private('Modules.Users.Entities.User.2' )
            .notification((notification) => {
                console.log(notification)
                  this.notifications.push(notification);
            });
        }
    }
</script>