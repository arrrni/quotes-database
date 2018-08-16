<template>
    <div class="container main">
        <div class="columns">
            <div class="column">
                <h2 class="title">Add new quote</h2>
            </div>
        </div>
        <div class="columns">
            <div class="column is-8">
                <div class="field">
                    <div class="control">
                        <vue-editor :editorToolbar="customToolbar" v-model="content"></vue-editor>
                    </div>
                </div>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <a class="button is-primary" @click="saveQuote"><b-icon icon="floppy" size="is-small"></b-icon><span>Save</span></a>&nbsp;<a class="button" @click="togglePreview">Podgląd</a>
            </div>
        </div>
        <hr>
        <b-modal :active.sync="isPreviewModalActive" :width="640">
            <Quote :quote-data="previewQuote" :is-preview="true"/>
        </b-modal>
    </div>
</template>

<script>
    import { VueEditor } from 'vue2-editor'
    import Quote from '../components/Quote';

    export default {
        name: 'addQuote',
        components: {
            Quote,
            VueEditor
        },
        data() {
            return {
                content: '',
                customToolbar: [
                    ['bold', 'italic', 'underline'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['image', 'code-block']
                ],
                isPreviewModalActive: false
            }
        },
        computed: {
            previewQuote: function () {
                return {
                    id: 0,
                    content: this.content,
                    created_at: Date.now(),
                    score: 0,
                    updated_at: Date.now()
                }
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
            },
            togglePreview: function () {
                this.isPreviewModalActive = !this.isPreviewModalActive
            }
        }
    }
</script>

<style scoped>

</style>