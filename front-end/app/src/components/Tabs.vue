<template>
  <v-tabs>
    <v-tab
      v-for="item in tabs"
      :key="item"
    >
      {{ item }}
    </v-tab>
  </v-tabs>
</template>

<script>
export default {
  data() {
    return {
      tabs: [
        '週間',
        '月間',
      ],
    }
  }
}
</script>