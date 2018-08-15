<template>
    <section id="quote">
        <div class="card tile is-vertical">
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
                <div class="quote-content content">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec iaculis mauris.
                    <a href="#">@bulmaio</a>. <a href="#">#css</a> <a href="#">#responsive</a>
                    <br>
                    <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
                </div>
            </div>
            <footer class="card-footer">
                <time class="card-footer-item heading"><span>{{ new Date() | moment("dddd, MMMM Do YYYY") }}</span></time>
            </footer>
        </div>
    </section>
</template>

<script>
    export default {
        name: "quote"
    }
</script>

<style scoped>

</style>