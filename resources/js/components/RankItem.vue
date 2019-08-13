<template>
    <li class="courseRanking__rankItem"
        style="display: flex; flex-direction: row; padding: 10px;">
        <div class="position"
                style="font-size: 28px; color: rgb(132, 132, 132); text-align: right; width: 80px; padding-right: 10px;">
            {{ rank.position }}
        </div>
        <div class="info">
            <div :style="{'font-size': '16px', 'font-weight': my_ranking && my_ranking.user_id == rank.user_id ? 'bold' : 'normal'}">
                {{ rank.name }}
            </div>
            <div class="score" style="font-size: 10px; color: rgb(132, 132, 132);">
                {{ rank.points }} PTS (+93)
            </div>
        </div>
    </li>
</template>

<script>
    export default {
        mounted() {
            console.log('Rank item mounted.')
        },
        props: ['rank', 'my_ranking']
    }
</script>
