<template>
    <li :data-id="id" style="overflow: hidden;padding: 0;" class="click_message list-group-item list-group-item-success">
        <a :href="link" class="pull-left">
            <span v-html="image"></span>
            <slot></slot>
        </a>
        <span class="pull-right badge badge-primary">{{time}}</span>
    </li>
</template>

<script>
    export default {
        props:[
            'link',
            'time',
            'image',
            'id',
        ],
        computed:{
        },
        mounted() {
            //console.log('Component mounted.')
        }
    }
</script>

<style>
</style>
