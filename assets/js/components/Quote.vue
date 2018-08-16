<template>
    <section id="quote">
        <div class="card tile is-vertical">
            <header v-if="!isPreview" class="card-header is-light">
                <p class="card-header-title">
                    <router-link :to="`/q/${quoteData.id}`">#{{ quoteData.id }}</router-link>&nbsp;<b-icon icon="plus" size="is-small"></b-icon>&nbsp;{{ quoteData.score }}&nbsp;<b-icon icon="minus" size="is-small"></b-icon>
                </p>
                <a href="#" class="card-header-icon" aria-label="more options">
      <span class="icon">
        <i class="fas fa-angle-down" aria-hidden="true"></i>
      </span>
                </a>
            </header>
            <div class="card-content">
                <div class="quote-content content" v-html="quoteData.content"></div>
            </div>
            <footer class="card-footer">
                <time class="card-footer-item heading"><span>{{ new Date(quoteData.created_at) | moment("dddd, MMMM Do YYYY") }}</span></time>
            </footer>
        </div>
    </section>
</template>

<script>
    export default {
        name: "quote",
        props: {
            quoteData: {
                type: Object,
                default: function () {
                    return {
                        id: 0,
                        content: '',
                        created_at: Date.now(),
                        score: 0,
                        updated_at: Date.now()
                    }
                }
            },
            isPreview: false
        }
    }
</script>

<style scoped>

</style>