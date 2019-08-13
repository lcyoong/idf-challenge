<template>
    <div>
        <div v-if="my_ranking">
        <h4>You are ranked <b>{{ my_ranking.position + nth(my_ranking.position) }}</b> {{ rank_category }}</h4>
        </div>
        <ul style="padding: 0px;">
            <rank-item v-for="rank in ranking" :key="rank.user_id" :rank="rank" :my_ranking="my_ranking"></rank-item>
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
                this.bumpMeUp();
            }
        },        

        data: function() {
            return {
                my_ranking: null,
                my_co_ranks: [],
            }
        },

        methods: {
            findByUser: function(rank) {
                return rank.user_id == this.target_user_id
            },
            nth: function(n) {
                return["st","nd","rd"][((n+90)%100-10)%10-1]||"th"
            },
            filterSameRank: function(rank) {
                return rank.position == this.my_ranking.position
            },
            bumpMeUp: function() {
                if(this.my_ranking) {
                    const that = this

                    // Get list of same rank
                    this.my_co_ranks = this.ranking.filter(this.filterSameRank);

                    if(this.my_co_ranks.length > 1) {

                        // Bump me to the top
                        var first_in_same_rank = this.my_co_ranks[0];

                        var new_index = this.ranking.findIndex(function(item) {
                            return item.user_id == first_in_same_rank.user_id;
                        });

                        this.ranking[new_index] = this.my_ranking;

                        // Re-position the rest
                        this.my_co_ranks.forEach(function (peer) {
                            if(peer.user_id != that.my_ranking.user_id) {
                                new_index++;
                                that.ranking[new_index] = peer;
                            }
                        });

                    }
                }
            },

        }

    }
</script>
