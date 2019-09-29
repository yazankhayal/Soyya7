<template>
    <li :data-id="id" style="overflow: hidden;padding: 0;" class="click_message list-group-item list-group-item-success">
        <a :href="links" class="pull-left">
            <slot></slot>
        </a>
        <span class="pull-right badge badge-primary">{{time}}</span>
    </li>
</template>

<script>
    export default {
        props:[
            'links',
            'time',
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
