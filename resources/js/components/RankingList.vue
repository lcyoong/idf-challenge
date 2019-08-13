<template>
    <div>
        <h4>You are ranked <b>4th</b> Worldwide</h4>
        <ul style="padding: 0px;">
            <rank-item></rank-item>
        </ul>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Ranking List mounted.')
        }
    }
</script>
