<template>
  <div class="flex flex-grow-0 shadow">
    <div class="flex-grow grid grid-cols-3 rounded bg-white bg-opacity-95 p-3 font-semibold text-gray-800">
      <div class="col-span-1 py-1 px-2 border-r border-gray-900 border-opacity-10 text-center">
          <input
            v-model="current"
            class="text-2xl border-none outline-none focus:outline-none text-center w-full font-semibold bg-transparent"
            :class="current < (0.2 * maxHp) ? 'text-red-600' : 'text-violet'"
            @blur="$emit('changeHp', current)"
            ></input>
          <h4 class="text-xs tracking-widest uppercase font-bold text-gray-500">Current</h4>
      </div>
      <div class="col-span-1 py-1 px-2 border-r border-gray-900 border-opacity-10 text-center">
          <h3 class="text-2xl text-gray-800 font-semibold">{{ maxHp }}</h3>
          <h4 class="text-xs tracking-widest uppercase font-bold text-gray-500">Max</h4>
      </div>
      <div class="col-span-1 py-1 px-2 text-center">
          <h3 class="text-2xl text-gray-800 font-semibold">{{ armour }}</h3>
          <h4 class="text-xs tracking-widest uppercase font-bold text-gray-500">Armour</h4>
      </div>
      <div class="col-span-3 p-2 pb-0 text-center text-sm">
        <p class="font-semibold text-gray-800">Health</p>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  props: {
    currentHp: {
      type: Number,
      default: 0
    },
    maxHp: {
      type: Number,
      default: 0
    },
    armour: {
      type: Number,
      default: 0
    }
  },
  data() {
    return {
      current: this.currentHp
    }
  }
};
</script>
