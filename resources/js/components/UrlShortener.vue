-- Active: 1641621964259@@127.0.0.1@3307
<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="shortener">
                    <div class="section-heading text-center">
                        <h1>URL Shortener</h1>
                        <br>
                        <div class="py-2 align-center">
                            <div class="pageIntroDescription border border-info p-3 mb-0">
                                URL Shortener
                            </div>

                        </div>
                        <br>

                        <div v-if="user">
                            <form action="" class="form">
                                <div class="input-group">
                                    <input type="text" v-model="url" id="p1" class="form-control addUrlInput">
                                </div>
                                <br>
                                <div>
                                    <button class="btn btn-dark" @click.prevent="shortenUrl">Process URL</button>
                                </div>
                            </form>
                        </div>

                        <div v-else>
                            {{ user }}
                            <h5>You are required to register or log in</h5>
                            <hr>
                            To shorten your URL
                            <hr>
                            <a href="/register">
                                <small>Register Here</small>
                            </a>
                            or
                            <a href="/login">
                                <small>Login Here</small>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
export default {
    props: {
      user: {
          type: Number,
          default: null
      },
    },
    created() {
        console.log(this.AuthorizedUser)
    },
    data() {
        return {
            url:null
        }
    },
    methods: {
        shortenUrl() {
            console.log('hello url');
        }
    },
}
</script>
