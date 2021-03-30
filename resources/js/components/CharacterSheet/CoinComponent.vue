<template>
  <div class="flex items-center justify-items-stretch">
    <h5 class="block flex-grow text-gray-500 uppercase text-sm tracking-widest font-semibold text-right">Coin</h5>
    <div class="w-20 flex-grow-0">
        <input
            v-model="coin"
            class="text-2xl pr-2 text-right font-fantasy border-none outline-none focus:outline-none text-center font-semibold bg-transparent text-violet flex-grow-0 w-full"
            @blur="updateCoin"
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
      coin: this.value
    }
  },
  methods: {
    updateCoin() {
      this.$emit('input', Number(this.coin));
    }
  }
};
</script>
