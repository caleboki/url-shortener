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
                                    <input type="text" v-model="url" id="p1" placeholder="Put URL here" class="form-control addUrlInput">
                                </div>
                                <br>
                                <div>
                                    <button class="btn btn-dark" @click.prevent="shortenUrl">Process URL</button>
                                </div>
                            </form>
                            <br>
                            <p v-if="!urlNotFound" class="alert alert-danger">
                                URL is not valid
                            </p>

                            <div class="copyLink mb-5">
                                <span id="output_url"></span>
                                <span id="clipBoard" @click.prevent="copyContent">
                                    {{copyTextString}}
                                </span>
                            </div>
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
            url:null,
            urlNotFound:true,
            copyTextString:'Copy Text To Clipboard'
        }
    },
    methods: {
        shortenUrl(){
            let self = this;
            let newUrl = self.url;
            let newArray = newUrl.split('//');
            let counter = 0;
            let resultNewUrl = Math.round((Math.pow(36,8) - Math.random() * Math.pow(36, 8))).toString(36).slice(1);

            for(let i = 0; i < newArray.length; i++){
                if(newArray[i] == 'http:' || newArray[i] == 'https:'){
                    counter++;
                }
                if(counter == 0){
                    let newArrayOne = newUrl.split('.');
                    if(newArrayOne[i] == 'www'){
                        counter++;
                    }
                    console.log(newArray, newArrayOne)
                    let newArrayTwo = newUrl.indexOf('.com');
                    if(newArrayTwo >= 0){
                        counter++;
                    }
                }

                if(counter ==0){
                    self.urlNotFound = false;
                }else{
                    let currentUrl = window.location.href+'u/'+resultNewUrl;
                    this.callShortenerApi('/url/shorten', newUrl, currentUrl)
                }
            }
        },

        callShortenerApi(url, newUrl, currentUrl) {
            axios.post(url,{
                url: newUrl,
                shortlink: currentUrl
            }).then(function(response){
                self.response = response.data;
                $('.copyLink').fadeIn(500);
                $('.copyLink').siblings('.form').find("#p1").val(self.response);
            });
        },

        copyContent() {
            $("#p1").select();
            this.copyTextString = 'Url Copied Successfully';
            document.execCommand("copy");
            this.url = this.response;
        }
    },
}
</script>

<style scoped>
    .copyLink{
        display:none;
    }

    #clipBoard{
        display:block;
        margin-top: 28px;
        background-color: #03cbf8;
        color:#fff;
        font-weight: 900;
        font-size:17px;
    }

    #clipBoard:hover{
        background-color:#333;
    }

    #clipBoard:visited, #clipBoard:active, #clipBoard:focus{
        background-color:green;
        color:#333;
    }
</style>
