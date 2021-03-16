<template>
  <div>
    <p class="text-sm">Use this tool to randomly generate anything you might need inspiration for!</p>
    <div v-if="!isLoading" class="grid grid-cols-3 mt-2 border-t border-gray-100 py-2 gap-4">
      <div class="col-span-1">
        <select
          class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
          v-model="toGenerate"
        >
          <option disabled selected>-- Select --</option>
          <option v-for="(type, index) in types" :key="'types-' + index" :value="type">{{ type | capitalise }}</option>
        </select>
      </div>
      <div class="col-span-1">
        <select
          class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
          v-model="amount"
        >
          <option disabled selected>-- Select --</option>
          <option :value="1">1</option>
          <option :value="2">2</option>
          <option :value="3">3</option>
          <option :value="4">4</option>
          <option :value="5">5</option>
          <option :value="6">6</option>
          <option :value="7">7</option>
          <option :value="8">8</option>
          <option :value="9">9</option>
          <option :value="10">10</option>
        </select>
      </div>
      <button
        :disabled="toGenerate === null || amount === null || isLoading"
        @click="generate"
        class="mt-1 block col-span-1 text-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:pointer-events-none disabled:opacity-50"
      >
        Generate
      </button>
    </div>
    <div v-else class="mt-2 border-t border-gray-100 py-2">
      <spinner
        line-bg-color="#e7e7e7"
        line-fg-color="#753a88"
        :line-size="4"
        size="48"
        message="Generating..."
      />
    </div>
    <div v-if="results.length > 0" class="mt-4 grid grid-cols-2 gap-4">
      <h3 class="block text-left text-sm font-semibold text-violet mb-2 col-span-2">Your Results</h3>
      <div v-for="(result, index) in results" :key="'results-' + index" class="block text-sm text-center">
        {{ result }}
      </div>
    </div>
  </div>
</template>

<script>
import Spinner from "vue-simple-spinner";

export default {
  components: {
    Spinner
  },
  data() {
    return {
      toGenerate: null,
      amount: null,
      isLoading: false,
      types: [],
      results: []
    }
  },
  created() {
    this.fetchTypes();
  },
  methods: {
    generate() {
      this.isLoading = true;
      axios
        .get("api/tools/generator/" + this.toGenerate + "/" + this.amount)
        .then(res => {
          this.results = res.data.results;
          this.isLoading = false;
        })
        .catch((e) => {
          let message;
          if (e.response.data.reason != null) {
            message = e.response.data.reason;
          } else {
            message = "Problem generating";
          }
          this.$notify({
            message: message,
            type: "error",
            top: false,
            bottom: true,
            left: false,
            right: true,
            showClose: true,
            closeDelay: 0,
          });
          this.isLoading = false;
        });
    },
    fetchTypes() {
      this.isLoading = true;
      axios
        .get("api/tools/generator/types")
        .then(res => {
          this.types = res.data.types;
          this.isLoading = false;
        })
        .catch((e) => {
          let message;
          if (e.response.data.reason != null) {
            message = e.response.data.reason;
          } else {
            message = "Problem fetching types";
          }
          this.$notify({
            message: message,
            type: "error",
            top: false,
            bottom: true,
            left: false,
            right: true,
            showClose: true,
            closeDelay: 0,
          });
          this.isLoading = false;
        });
    }
  }
};
</script>
