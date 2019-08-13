<template>
    <div>
        <h4>You are ranked <b>4th</b> Worldwide</h4>
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

        props: ['ranking'],
    }
</script>
