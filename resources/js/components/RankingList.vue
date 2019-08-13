<template>
    <div>
        <div v-if="my_ranking">
        <h4>You are ranked <b>{{ my_ranking.position + nth(my_ranking.position) }}</b> {{ rank_category }}</h4>
        </div>
        <ul style="padding: 0px;">
            <rank-item v-for="rank in tier1" :key="rank.user_id" :rank="rank" :my_ranking="my_ranking"></rank-item>
            <hr>
            <rank-item v-for="rank in tier3" :key="rank.user_id" :rank="rank" :my_ranking="my_ranking"></rank-item>
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
                this.buildTiers();
            }
        },        

        data: function() {
            return {
                my_ranking: null,
                my_co_ranks: [],
                my_index: null,
                tier1: [],
                tier2: [],
                tier3: [],
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
            buildTiers: function() {

                if (this.my_ranking) this.my_index = this.my_ranking.position - 1;

                const max = 9;
                var found = 0;
                var limit = max > this.ranking.length ? this.ranking.length : max;
                console.log(this.ranking.length);

                //Build tier 1
                var tier1_end_index = 2;

                if (this.my_index && this.my_index <= tier1_end_index + 1) {
                    tier1_end_index = this.my_index + 1;
                    found = 1;
                }

                this.tier1 = this.ranking.slice(0, tier1_end_index + 1);

                limit -= this.tier1.length;

                if (limit > 0) {

                    //Build tier 3
                    var tier_limit = Math.min(3, limit);
                    var tier3_start_index = this.ranking.length - tier_limit;

                    if (this.my_index && this.my_index >= tier3_start_index - 1) {
                        if (this.my_index - 1 < tier3_start_index) {
                            tier3_start_index = this.my_index - 1;
                        }
                        found = 1;
                    }
                    this.tier3 = this.ranking.slice(tier3_start_index);

                    limit -= this.tier3.length;

                }

            }

        }

    }
</script>
