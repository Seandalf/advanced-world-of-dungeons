<template>
  <div class="bg-white sm:rounded py-6 px-4 sm:px-6 lg:px-8 bg-white shadow-xl bg-opacity-90">
    <template v-if="isLoading">
      <spinner
        line-bg-color="#e7e7e7"
        line-fg-color="#753a88"
        :line-size="4"
        size="48"
        message="Loading..."
      />
    </template>
    <template v-else>
      <h3 class="text-center font-fantasy text-4xl">{{ character.name }}</h3>
    </template>
  </div>
</template>

<script>
import Spinner from "vue-simple-spinner";

export default {
  components: {
    Spinner
  },
  props: {
    id: {
      type: Number,
      default: null
    }
  },
  data() {
    return {
      isLoading: true,
      character: null
    };
  },
  mounted() {
    this.fetchCharacter();
  },
  methods: {
    fetchCharacter() {
      axios
        .get("api/characters/show/" + this.id)
        .then(res => {
          this.character = res.data;
          this.isLoading = false;
        })
        .catch(e => {
          console.log(e.data);
          this.isLoading = false;
        });
    }
  }
};
</script>
