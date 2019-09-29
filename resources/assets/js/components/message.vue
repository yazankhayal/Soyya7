<template>
    <div class="message_box">
        <li class="form_xhs p-s list-group-item" :class="className">
            <span v-html="avatar"></span>
            <slot></slot>
            <small id="time" class="badge">{{time}}</small>
            <span v-html="image"></span>
        </li>
        <small style="float: right;" class="badge " :class="badgeClass">{{user}}</small>
    </div>
</template>

<script>
    export default {
        props:[
            'color',
            'user',
            'time',
            'avatar',
            'image',
        ],
        computed:{
            className(){
                return 'list-group-item-' + this.color;
            },
            badgeClass(){
                return 'badge-' + this.color;
            }
        },
        mounted() {
            //console.log('Component mounted.')
        }
    }
</script>

<style>
    #time{
        margin-top:10px;
        color:#fff;
    }
</style>
