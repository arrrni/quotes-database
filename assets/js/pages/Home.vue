<template>
    <section class="main">
        <div class="container">
            <h1 class="title main-heading">Newest quotes</h1>
        </div>
        <nav class="level container">
            <!-- Left side -->
            <div class="level-left">
                <div class="level-item">
                    <p class="subtitle is-5">
                        <strong>{{ pagination.total }}</strong> quotes total
                    </p>
                </div>
                <div class="level-item">
                    <div class="field has-addons">
                        <p class="control">
                            <input class="input" type="text" placeholder="Find a quote">
                        </p>
                        <p class="control">
                            <button class="button">
                                Search
                            </button>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right side -->
            <div class="level-right">
                <p class="level-item"><strong>All</strong></p>
                <p class="level-item"><a>Newest</a></p>
                <p class="level-item"><a>Popular</a></p>
                <p class="level-item"><a class="button is-success">New</a></p>
            </div>
        </nav>
        <div class="container">
            <b-loading :active.sync="loading"></b-loading>
            <div v-if="isEmptyMessage">
                <article class="message is-warning">
                    <div class="message-header">
                        <p>Message</p>
                    </div>
                    <div class="message-body">
                        No quotes found in database.
                    </div>
                </article>
                <hr>
            </div>
            <div v-for="quote in quotes">
                <Quote :quote-data="quote" :key="quote.id"/>
                <hr>
            </div>
            <b-pagination
                    :total="pagination.total"
                    :current.sync="pagination.current"
                    :order="pagination.order"
                    :size="pagination.size"
                    :simple="pagination.isSimple"
                    :rounded="pagination.isRounded"
                    :per-page="pagination.perPage"
                    @change="pageChange">
            </b-pagination>
        </div>
        <br>
    </section>
</template>

<script>
    import Quote from '../components/Quote'
    export default {
        name: 'home',
        data () {
            return {
                quotes: [],
                pagination: {
                    current: 1,
                    total: 0,
                    startFrom: 0,
                    perPage: 20,
                    order: '',
                    size: '',
                    isSimple: false,
                    isRounded: false
                },
                loading: false
            }
        },
        mounted () {
            this.$store.commit('setUser', 'some_user');
            if (!this.isEmpty(this.$route.query)) {
                this.pagination.current = this.$route.query.page
            }
            this.fetchQuotes(this.pagination.current, this.pagination.perPage)
        },
        methods: {
            fetchQuotes (page, perPage) {
                this.quotes = [];
                this.loading = true;
                this.$route.query.page = this.pagination.current;
                axios
                    .get('/api/quotes/page/' + page + '/' + perPage)
                    .then(response => {
                        this.quotes = response.data.quotes;
                        this.pagination.total = response.data.total;
                    })
                    .catch(error => {
                        console.log(error);
                        this.error = true;
                    })
                    .finally(() => this.loading = false)
            },
            pageChange (page) {
                this.currentPage = page;
                this.fetchQuotes(page, this.pagination.perPage);
                this.$router.push({ query: { page: page } });
            },
            isEmpty(obj) {
                for(let key in obj) {
                    if(obj.hasOwnProperty(key))
                        return false;
                }
                return true;
            }
        },
        computed: {
            isEmptyMessage: function () {
                return this.pagination.total === 0;
            }
        },
        components: {
            Quote
        }
    }
</script>
