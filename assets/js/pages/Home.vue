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
                        <strong>123</strong> quotes total
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
            <Quote/>
            <hr>
            <Quote/>
            <hr>
            <Quote/>
            <hr>
            <b-pagination
                    :total="total"
                    :current.sync="current"
                    :order="order"
                    :size="size"
                    :simple="isSimple"
                    :rounded="isRounded"
                    :per-page="perPage">
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
                total: 200,
                current: 1,
                perPage: 20,
                order: '',
                size: '',
                isSimple: false,
                isRounded: false
            }
        },
        components: {
            Quote
        }
    }
</script>
