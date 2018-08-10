<template>
    <div>
        <p>HOME</p>
        <router-link to="/playground"> test linka </router-link>
    </div>
</template>

<script>
    export default {
        name: 'home',
        data () {
            return {
                selected: null,
                options: ['list', 'of', 'options']
            }
        }
    }
</script>
