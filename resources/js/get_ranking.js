new Vue({
    el: '#stat',
    data: {
        world_ranking: [],
        country_ranking: [],
    },
    created: function () {
        this.getWorldRanking();
        this.getCountryRanking();
    },
    methods: {
        getWorldRanking: function() {
            axios.get('/api/course/' + course_id + '/ranking')
            .then(response=>{
                this.world_ranking = response.data;
                console.log(this.world_ranking);
            })
            .catch((error) => {
                console.log(error);
            });
        },
        getCountryRanking: function() {
            axios.get('/api/course/' + course_id + '/country/'+ country_id +'/ranking')
            .then(response=>{
                this.country_ranking = response.data;
                console.log(this.country_ranking);
            })
            .catch((error) => {
                console.log(error);
            });
        }

    }

});