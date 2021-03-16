<template>
  <div>
    <template v-if="isLoading">
      <spinner
        line-bg-color="#e7e7e7"
        line-fg-color="#753a88"
        :line-size="4"
        size="48"
        message="Buying your items..."
      />
    </template>
    <template v-else>
      <div>
        <p class="mb-4 text-center text-sm text-gray-800 font-semibold">
          Coin: <span class="text-violet">{{ coin }}</span> <span class="text-gray-50">|</span> Total: <span class="text-violet">{{ total }}</span>
        </p>
        <h4 class="uppercase text-violet tracking-widest text-left font-semibold">
          Armour
        </h4>
        <div class="mt-2 mb-4 grid grid-cols-1 mdl:grid-cols-2 gap-y-4 mdl:gap-x-4">
          <div
            v-for="(item, index) in armours"
            :key="'armour-shop-' + index"
            class="text-gray-800 p-4 rounded border shadow text-left"
            :class="
              selectedArmour.includes(item.id)
                ? 'bg-indigo-50 border-indigo-200'
                : 'bg-white border-gray-200'
            "
            @click="toggleArmour(item)"
          >
            <h3
              class="text-sm text-gray-700 uppercase tracking-widest uppercase block font-semibold"
            >
              {{ item.name }}
            </h3>
            <h4
              class="mt-1 text-xs text-gray-500 tracking-widest font-normal block"
            >
              {{ item.description }}
            </h4>
          </div>
        </div>

        <h4 class="uppercase text-violet tracking-widest text-left font-semibold">
          Equipment
        </h4>
        <div class="mt-2 mb-4 grid grid-cols-1 mdl:grid-cols-2 gap-y-4 mdl:gap-x-4">
          <div
            v-for="(item, index) in items"
            :key="'equipment-shop-' + index"
            class="text-gray-800 p-4 rounded border shadow text-left"
            :class="
              selectedItems.includes(item.id)
                ? 'bg-indigo-50 border-indigo-200'
                : 'bg-white border-gray-200'
            "
            @click="toggleItems(item)"
          >
            <h3
              class="text-sm text-gray-700 uppercase tracking-widest uppercase block font-semibold"
            >
              {{ item.name }}
            </h3>
            <h4
              class="mt-1 text-xs text-gray-500 tracking-widest font-normal block"
            >
              {{ item.description }}
            </h4>
          </div>
        </div>

        <h4 class="uppercase text-violet tracking-widest text-left font-semibold">
          Weapons
        </h4>
        <div class="mt-2 grid grid-cols-1 mdl:grid-cols-2 gap-y-4 mdl:gap-x-4">
          <div
            v-for="(item, index) in weapons"
            :key="'armour-shop-' + index"
            class="text-gray-800 p-4 rounded border shadow text-left"
            :class="
              selectedWeapons.includes(item.id)
                ? 'bg-indigo-50 border-indigo-200'
                : 'bg-white border-gray-200'
            "
            @click="toggleWeapons(item)"
          >
            <h3
              class="text-sm text-gray-700 uppercase tracking-widest uppercase block font-semibold"
            >
              {{ item.name }}
            </h3>
            <h4
              class="mt-1 text-xs text-gray-500 tracking-widest font-normal block"
            >
              {{ item.description }}
            </h4>
          </div>
        </div>
      </div>
    </template>
  </div>
</template>

<script>
import Spinner from "vue-simple-spinner";

export default {
  components: {
    Spinner,
  },
  props: {
    character: {
      type: Number,
      default: null,
    },
    coin: {
      type: Number,
      default: 0,
    },
  },
  data() {
    return {
      total: 0,
      selectedArmour: [],
      selectedItems: [],
      selectedWeapons: [],
      armours: [],
      items: [],
      weapons: [],
      isLoading: false
    };
  },
  created() {
    this.fetchArmour();
    this.fetchItems();
    this.fetchWeapons();
  },
  methods: {
    toggleArmour(item) {
      if (this.selectedArmour.includes(item.id)) {
        this.selectedArmour = _.without(this.selectedArmour, item.id);
        this.total -= item.cost;
      } else {
        this.selectedArmour.push(item.id);
        this.total += item.cost;
      }
    },
    toggleItems(item) {
      if (this.selectedItems.includes(item.id)) {
        this.selectedItems = _.without(this.selectedItems, item.id);
        this.total -= item.cost;
      } else {
        this.selectedItems.push(item.id);
        this.total += item.cost;
      }
    },
    toggleWeapons(item) {
      if (this.selectedWeapons.includes(item.id)) {
        this.selectedWeapons = _.without(this.selectedWeapons, item.id);
        this.total -= item.cost;
      } else {
        this.selectedWeapons.push(item.id);
        this.total += item.cost;
      }
    },
    fetchArmour() {
      axios
        .get("api/armours/index")
        .then((res) => {
          this.armours = res.data.armours;
        })
        .catch((e) => {
          let message;
          if (e.response.data.reason != null) {
            message = e.response.data.reason;
          } else {
            message = "Problem fetching armours";
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
        });
    },
    fetchItems() {
      axios
        .get("api/items/index")
        .then((res) => {
          this.items = res.data.items;
        })
        .catch((e) => {
          let message;
          if (e.response.data.reason != null) {
            message = e.response.data.reason;
          } else {
            message = "Problem fetching items";
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
        });
    },
    fetchWeapons() {
      axios
        .get("api/weapons/index")
        .then((res) => {
          this.weapons = res.data.weapons;
        })
        .catch((e) => {
          let message;
          if (e.response.data.reason != null) {
            message = e.response.data.reason;
          } else {
            message = "Problem fetching weapons";
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
        });
    },
    submit() {
      this.isLoading = true;
      axios
        .post("api/character/shop", {
          armour: this.selectedArmour,
          items: this.selectedItems,
          weapons: this.selectedWeapons,
          character: this.character
        })
        .then(res => {
          location.reload();
        })
        .catch((e) => {
          let message;
          if (e.response.data.reason != null) {
            message = e.response.data.reason;
          } else {
            message = "Problem shopping";
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
  },
};
</script>
