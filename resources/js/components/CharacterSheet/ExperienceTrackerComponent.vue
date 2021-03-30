<template>
  <div class="rounded bg-gray-50 rounded-lg flex items-center justify-items-stretch p-3 border border-gray-100">
    <h5 class="block flex-grow-0 text-gray-500 uppercase text-sm tracking-widest font-semibold">XP</h5>
    <div class="flex-grow ml-3 -mt-0.5">
      <button
        v-if="xp >= (level * 1000)"
        type="button"
        class="inline-flex items-center px-2 py-1 border border-transparent text-xs font-semibold rounded shadow-sm bg-purple-100 text-purple-800 focus:outline-none focus:ring-offset-0 focus:ring-0"
        @click="$emit('levelUp')"
      >
        Level Up
      </button>
    </div>
    <div class="w-24 flex-grow-0">
        <input
            v-model="xp"
            class="text-2xl pr-2 text-right font-fantasy border-none outline-none focus:outline-none text-center font-semibold bg-transparent text-violet flex-grow-0 w-full"
            @blur="updateXp"
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
    level: {
      type: Number,
      default: 1
    }
  },
  data() {
    return {
      xp: this.value,
      levelBrackets: []
    }
  },
  methods: {
    updateXp() {
      this.$emit('input', Number(this.xp));
    }
  }
};
</script>
