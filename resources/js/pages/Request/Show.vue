<script>
import Layout from '../../layouts/Layout'

export default {
  layout: Layout,
}
</script>

<script setup>
defineProps({ request: Object })

</script>

<template>
  <div>
    <h1>{{ request.path }}</h1>
    <h2>{{  request.action }}</h2>
    <p>{{ request.status }}</p>
  </div>
</template>