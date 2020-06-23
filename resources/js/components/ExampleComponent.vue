<template>
        <div class="container">
            <div class="pt-3 pb-3">
                <div v-for="posts in list">
                    <div class="card" style="background-color: rgb(23, 23, 24)">
                        <div class="media m-0 mt-4">
                            <div class="d-flex ml-3">
                                <img class="responsive-image rounded-circle" v-bind:src="'https://pigeon.test/public/storage/avatars/'+posts.user.avatar" alt="Profile Pic" style="height: 65px;width: 65px;">
                                <div class="media-body ml-3 mt-2">
                                    <a class="lead text-white text-justify small-text">{{ posts.user.name }}</a>
                                    <p class="text-muted m-0 p-0" style="font-size: 0.7em">Posted at: {{ posts.updated_at }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                                <div>
                                    <a style="font-size: 2em" v-bind:href="'https://pigeon.test/post/'+posts.id">{{ posts.title }} </a>
                                </div>
                            <p class="lead text-white text-justify small-text mt-2 mb-3">{{ posts.description }}</p>
                        </div>
                    </div>
                        <infinite-loading @distance="1" @infinite="infiniteHandler"></infinite-loading>
                </div>
            </div>
        </div>
</template>

<script>

    export default {

        mounted() {

            console.log('Component mounted.')

        },

        data() {

            return {

              list: [],

              page: 1,

            };

          },

          methods: {

            infiniteHandler($state) {

                let vm = this;



                this.$http.get('/posts?page='+this.page)

                    .then(response => {

                        return response.json();

                    }).then(data => {

                        $.each(data.data, function(key, value) {

                                vm.list.push(value);

                        });

                        $state.loaded();

                    });



                this.page = this.page + 1;

            },

          },

    }

</script>
