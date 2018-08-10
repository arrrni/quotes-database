<template>
    <div>
        <template slot="header">
            404 Not Found
        </template>
        <template slot="lead">
            Looking for something? It seems that you were looking for something.
        </template>
        <hr class="my-4">
        <p>
            We didn't found content that you've been loking for. Check if you got correct link in your address bar.
        </p>
    </div>
</template>

<script>
    export default {
        name: 'notfound'
    }
</script>

<style scoped>
    b-jumbotron {
        background-size: 100% 100%;
        padding-top: 20%;
        padding-bottom: 20%;
        height: calc(100%);
    }

</style>
