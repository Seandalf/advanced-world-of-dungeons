<template>
  <textarea
    v-model="notes"
    class="h-48 border border-gray-100 bg-gray-50 rounded-lg w-full font-handwriting leading-loose outline-none focus:outline-none focus:border-gray-100 focus:ring-0 focus:shadow-none"
    @blur="updateNotes"
  ></textarea>
</template>

<script>

export default {
  props: {
    value: {
      type: String,
      default: null
    },
  },
  data() {
    return {
      notes: this.value
    }
  },
  methods: {
    updateNotes() {
      this.$emit('input', this.notes);
    }
  }
};
</script>
