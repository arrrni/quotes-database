<template>
    <nav class="navbar is-light is-fixed-top">
        <div class="container">
            <div class="navbar-brand">
                <router-link to="/" class="navbar-item is-size-4">QDB</router-link>
                <div class="navbar-burger burger" @click="toggleMenu" :class="{'is-active': navIsActive}" data-target="navbarExampleTransparentExample">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

            <div id="navbarExampleTransparentExample" class="navbar-menu" :class="{'is-active': navIsActive}">
                <div class="navbar-start">
                    <router-link class="navbar-item" to="/about">
                        <b-icon icon="information-outline" size="is-small"></b-icon><span>About</span>
                    </router-link>
                    <router-link class="navbar-item" to="/new">
                        <b-icon icon="plus" size="is-small"></b-icon><span>New quote</span>
                    </router-link>
                </div>

                <div class="navbar-end">
                    <router-link class="navbar-item" to="/rss">
                        <b-icon icon="rss" size="is-small"></b-icon><span>RSS</span>
                    </router-link>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        name: 'navbar',
        data() {
            return {
                navIsActive: false
            }
        },
        methods: {
            toggleMenu: function () {
                this.navIsActive = !this.navIsActive
            }
        }
    }
</script>

<style scoped>

</style>