<template>
    <li class="courseRanking__rankItem"
        style="display: flex; flex-direction: row; padding: 10px;">
        <div class="position"
                style="font-size: 28px; color: rgb(132, 132, 132); text-align: right; width: 80px; padding-right: 10px;">
            1
        </div>
        <div class="info">
            <div style="font-size: 16px;">
                Sandra Lidstream
            </div>
            <div class="score" style="font-size: 10px; color: rgb(132, 132, 132);">
                205 PTS (+93)
            </div>
        </div>
    </li>
</template>

<script>
    export default {
        mounted() {
            console.log('Rank item mounted.')
        },
    }
</script>
