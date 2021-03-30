<template>
  <div class="grid grid-cols-1">
    <div
        class="col-span-1 border rounded-t p-3 border-gray-100"
    >
        <h5 class="block text-center font-fantasy text-2xl">{{ stat }}</h5>
    </div>
    <div
        class="col-span-1 rounded-b p-3 bg-gray-100"
    >
        <h5 class="block text-center text-gray-500 uppercase text-xs tracking-widest font-semibold">{{ name }}</h5>
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
    },
    color: {
        type: String,
        default: 'gray'
    }
  }
};
</script>
