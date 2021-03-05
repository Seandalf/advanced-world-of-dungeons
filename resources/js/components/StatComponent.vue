<template>
  <div class="flex flex-grow-0 shadow">
    <div class="flex-grow rounded-l bg-white p-3 font-semibold text-gray-800 bg-opacity-95">
      {{ name }}
    </div>
    <div class="flex-grow-0 w-12 bg-gray-100 border-l border-gray-200 shadow text-center py-2 pr-1 h-12 text-2xl font-semibold text-violet rounded-r">
      {{ stat > -1 ? '+' : '' }}{{ stat }}
    </div>
  </div>
</template>

<script>

export default {
  props: {
    name: {
      type: String,
      default: null
    },
    stat: {
      type: Number,
      default: 0
    }
  }
};
</script>
