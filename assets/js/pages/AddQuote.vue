<template>
    <div class="container main">
        <div class="columns">
            <div class="column">
                <h2 class="title">Add new quote</h2>
            </div>
        </div>
        <div class="columns">
            <div class="column is-6">
                <div class="field">
                    <div class="control">
                        <textarea class="textarea is-primary" type="text" placeholder="Your content here" v-model="content"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <a class="button is-primary" @click="saveQuote"><b-icon icon="floppy" size="is-small"></b-icon><span>Save</span></a>
            </div>
        </div>
        <hr>
    </div>
</template>

<script>
    export default {
        name: 'addQuote',
        data() {
            return {
                content: ''
            }
        },
        methods: {
            saveQuote() {
                if (this.content.length === 0) {
                    this.$toast.open({
                        duration: 5000,
                        message: 'Add some content before saving it',
                        type: 'is-danger'
                    })
                } else {
                    this.$toast.open({
                        duration: 5000,
                        message: 'This would be message for saving something successfully!',
                        type: 'is-success'
                    })
                }
            }
        }
    }
</script>

<style scoped>

</style>