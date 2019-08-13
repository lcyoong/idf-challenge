<template>
    <div>
        <div v-if="my_ranking">
        <h4>You are ranked <b>{{ my_ranking.position }}</b> {{ rank_category }}</h4>
        </div>
        <ul style="padding: 0px;">
            <rank-item v-for="rank in ranking" :key="rank.user_id" :rank="rank"></rank-item>
        </ul>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Ranking List mounted.')
        },

        props: ['ranking', 'target_user_id', 'rank_category'],

        watch: {
            ranking: function () {
                this.my_ranking = this.ranking.find(this.findByUser);
            }
        },        

        data: function() {
            return {
                my_ranking: null,
            }
        },

        methods: {
            findByUser: function(rank) {
                return rank.user_id == this.target_user_id
            },
        }

    }
</script>
