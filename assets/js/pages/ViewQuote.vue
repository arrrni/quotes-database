<template>
    <div class="main container">
        <section v-if="error">
            <article class="message is-danger">
                <div class="message-header">
                    <p>404 Not Found</p>
                </div>
                <div class="message-body">
                    <p>Looking for something? It seems that you were looking for <strong>something</strong>.</p>
                    <p>We didn't found content that you've been loking for. Check if you got correct link in your address bar.</p>
                </div>
            </article>
            <hr>
        </section>
        <section v-else>
            <b-loading :active.sync="loading"></b-loading>
            <Quote :quote-data="quote"/>
            <hr>
        </section>
    </div>
</template>

<script>
    import Quote from '../components/Quote'
    export default {
        name: 'viewQuote',
        data () {
            return {
                quote: null,
                loading: true,
                error: false
            }
        },
        mounted () {
            axios
                .get('/api/quotes/' + this.$route.params.id)
                .then(response => {this.quote = response.data})
                .catch(error => {
                    console.log(error)
                    this.error = true
                })
                .finally(() => this.loading = false)
        },
        components: {
            Quote
        }
    }
</script>

<style scoped>

</style>