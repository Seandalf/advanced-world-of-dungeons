<template>
  <div class="flex flex-grow-0 rounded border border-gray-100">
    <div class="flex-grow grid grid-cols-3 py-2 font-semibold text-gray-800">
      <div class="col-span-1 py-1 px-2 border-r border-gray-700 border-opacity-10 text-center">
          <input
            v-model="current"
            class="text-2xl font-fantasy border-none outline-none focus:outline-none text-center w-full font-semibold bg-transparent"
            :class="current < (0.2 * maxHp) ? 'text-red-600' : 'text-violet'"
            @blur="updateHp"
            ></input>
          <h4
            class="text-xs tracking-widest uppercase font-semibold"
            :class="current < (0.2 * maxHp) ? 'text-red-500' : 'text-gray-400'"
          >
            HP
          </h4>
      </div>
      <div class="col-span-1 py-1 px-2 border-r border-gray-700 border-opacity-10 text-center">
          <h3 class="text-2xl font-fantasy text-gray-800 font-semibold">{{ maxHp }}</h3>
          <h4 class="text-xs tracking-widest uppercase font-semibold text-gray-400">Max HP</h4>
      </div>
      <div class="col-span-1 py-1 px-2 text-center">
          <h3 class="text-2xl font-fantasy text-gray-800 font-semibold">{{ armour }}</h3>
          <h4 class="text-xs tracking-widest uppercase font-semibold text-gray-400">Armour</h4>
      </div>
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
      current: this.value
    }
  },
  methods: {
    updateHp() {
      this.$emit('input', Number(this.current));
    }
  }
};
</script>
