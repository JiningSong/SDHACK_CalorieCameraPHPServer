<template>
    <ve-ring :data="chartData"></ve-ring>
</template>

<script>
    export default {
        name: "progress-component.vue",
        data: function () {
            return {
                chartData: {
                    columns: ['date', 'calorie'],
                    rows: [
                        { 'date': 'calorie_have', 'calorie': 1393 },
                        { 'date': 'calorie_left', 'calorie': 3530 },
                    ]
                }
            }
        }
    }
</script>

<style scoped>

</style>