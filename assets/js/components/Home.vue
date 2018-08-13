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
            <div class="card">
                <header class="card-header is-light">
                    <p class="card-header-title">
                        <a href="#">#1</a>&nbsp;<b-icon icon="plus" size="is-small"></b-icon>&nbsp;0&nbsp;<b-icon icon="minus" size="is-small"></b-icon>
                    </p>
                    <a href="#" class="card-header-icon" aria-label="more options">
      <span class="icon">
        <i class="fas fa-angle-down" aria-hidden="true"></i>
      </span>
                    </a>
                </header>
                <div class="card-content">
                    <div class="content">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec iaculis mauris.
                        <a href="#">@bulmaio</a>. <a href="#">#css</a> <a href="#">#responsive</a>
                        <br>
                        <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
                    </div>
                </div>
                <footer class="card-footer">
                    <p class="card-footer-item heading"><span>{{ new Date() | moment("dddd, MMMM Do YYYY") }}</span></p>
                </footer>
            </div>
            <hr>
            <div class="card">
                <header class="card-header is-light">
                    <p class="card-header-title">
                        <a href="#">#1</a>&nbsp;<b-icon icon="plus" size="is-small"></b-icon>&nbsp;0&nbsp;<b-icon icon="minus" size="is-small"></b-icon>
                    </p>
                    <a href="#" class="card-header-icon" aria-label="more options">
      <span class="icon">
        <i class="fas fa-angle-down" aria-hidden="true"></i>
      </span>
                    </a>
                </header>
                <div class="card-content">
                    <div class="content">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec iaculis mauris.
                        <a href="#">@bulmaio</a>. <a href="#">#css</a> <a href="#">#responsive</a>
                        <br>
                        <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
                    </div>
                </div>
                <footer class="card-footer">
                    <p class="card-footer-item heading"><span>{{ new Date() | moment("dddd, MMMM Do YYYY") }}</span></p>
                </footer>
            </div>
            <hr>
            <div class="card">
                <header class="card-header is-light">
                    <p class="card-header-title">
                        <a href="#">#1</a>&nbsp;<b-icon icon="plus" size="is-small"></b-icon>&nbsp;0&nbsp;<b-icon icon="minus" size="is-small"></b-icon>
                    </p>
                    <a href="#" class="card-header-icon" aria-label="more options">
      <span class="icon">
        <i class="fas fa-angle-down" aria-hidden="true"></i>
      </span>
                    </a>
                </header>
                <div class="card-content">
                    <div class="content">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec iaculis mauris.
                        <a href="#">@bulmaio</a>. <a href="#">#css</a> <a href="#">#responsive</a>
                        <br>
                        <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
                    </div>
                </div>
                <footer class="card-footer">
                    <p class="card-footer-item heading"><span>{{ new Date() | moment("dddd, MMMM Do YYYY") }}</span></p>
                </footer>
            </div>
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
        }
    }
</script>
