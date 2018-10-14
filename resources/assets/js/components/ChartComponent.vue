<template>
    <ve-line :data="chartData"></ve-line>
</template>

<script>
    export default {
        name: "chart-component.vue",
        data: function () {
            return {
                chartData: {
                    columns: ['date', 'calorie_limit', 'calorie_had'],
                    rows: [
                        { 'date': '1/1', 'calorie_limit': 1393, 'calorie_had': 1093},
                        { 'date': '1/2', 'calorie_limit': 3530, 'calorie_had': 3230},
                        { 'date': '1/3', 'calorie_limit': 2923, 'calorie_had': 2623},
                        { 'date': '1/4', 'calorie_limit': 1723, 'calorie_had': 1423},
                        { 'date': '1/5', 'calorie_limit': 3792, 'calorie_had': 3492},
                        { 'date': '1/6', 'calorie_limit': 4593, 'calorie_had': 4293}
                    ]
                }
            }
        }
    }
</script>

<style scoped>

</style>