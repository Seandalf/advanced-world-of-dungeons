<template>
  <div class="rounded bg-gray-50 rounded-lg flex items-center justify-items-stretch p-3 border border-gray-100">
    <h5 class="block flex-grow text-gray-500 uppercase text-sm tracking-widest font-semibold">Power</h5>
    <div class="w-12 flex-grow-0">
        <input
            v-model="power"
            class="text-2xl pr-2 text-right font-fantasy border-none outline-none focus:outline-none text-center font-semibold bg-transparent text-violet flex-grow-0 w-full"
            @blur="updatePower"
        ></input>
    </div>
  </div>
</template>

<script>

export default {
  props: {
    value: {
      type: Number,
      default: 0
    },
  },
  data() {
    return {
      power: this.value
    }
  },
  methods: {
    updatePower() {
      this.$emit('input', Number(this.power));
    }
  }
};
</script>
