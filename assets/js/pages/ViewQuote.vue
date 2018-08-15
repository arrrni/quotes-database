<template>
    <div class="main container">
        {{quoteData}}
        <Quote/>
        <hr>
    </div>
</template>

<script>
    import Quote from '../components/Quote'
    export default {
        name: 'viewQuote',
        computed: {
            quoteData: function () {
                let link = '/api/quotes/' + this.$route.params.id
                axios.get(link)
                    .then(function (response) {
                        console.log(response)
                }).catch(function (error) {
                    console.log(error)
                })
            }
        },
        components: {
            Quote
        }
    }
</script>

<style scoped>

</style>