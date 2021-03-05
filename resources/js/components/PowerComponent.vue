<template>
  <div class="flex flex-grow-0 shadow">
    <div class="flex-grow rounded-l bg-white bg-opacity-95 p-3 font-semibold text-gray-800">
      Power
    </div>
    <div class="flex-grow-0 w-12 bg-gray-100 border-l border-gray-200 shadow py-2 px-2 h-12 rounded-r">
      <input v-model="power" @blur="$emit('changePower', power)" class="w-full bg-transparent text-2xl font-semibold text-violet text-center outline-none focus:outline-none"></input>
    </div>
  </div>
</template>

<script>

export default {
  props: {
    characterPower: {
      type: Number,
      default: 0
    }
  },
  data() {
    return {
      power: this.characterPower
    }
  }
};
</script>
