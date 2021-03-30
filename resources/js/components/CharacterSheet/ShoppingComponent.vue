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
          Coin: <span class="text-violet text-base font-fantasy">{{ coin }}</span> <span class="text-gray-50">|</span> Spent: <span class="text-violet text-base font-fantasy">{{ total }}</span>
        </p>
        <h4 class="font-fantasy text-xl border-b border-gray-100 pb-2 mb-2 block text-left">Armour</h4>
        <div>
          <table class="min-w-full divide-y divide-gray-200 border border-gray-100 rounded-lg">
              <thead class="bg-gray-50">
              <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Name
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Description
                  </th>
                  <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Value
                  </th>
              </tr>
              </thead>
              <tbody>
                <!-- Armours -->
                <tr
                  v-for="(armour, index) in armours"
                  :key="'shop-armours-' + index"
                  class="border border-opacity-0"
                  :class="
                    selectedArmour.includes(armour.id)
                      ? 'bg-purple-100 border-opacity-100 border-purple-200'
                      : (index%2 === 0 ? 'bg-white' : 'bg-gray-50')
                  "
                  @click="toggleArmour(armour)"
                >
                  <td class="px-6 py-3 whitespace-nowrap text-sm text-left font-medium text-gray-900">
                    {{ armour.name }}
                  </td>
                  <td class="px-6 py-3 whitespace-nowrap text-sm text-left text-gray-500">
                    {{ armour.description }}
                  </td>
                  <td class="px-6 py-3 whitespace-nowrap text-sm text-center text-gray-500">
                    +{{ armour.armour_value }} armour
                  </td>
                </tr>
              </tbody>
          </table>
        </div>

        <h4 class="mt-4 font-fantasy text-xl border-b border-gray-100 pb-2 mb-2 block text-left">Items</h4>
        <div>
          <table class="min-w-full divide-y divide-gray-200 border border-gray-100 rounded-lg">
              <thead class="bg-gray-50">
              <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Name
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Description
                  </th>
                  <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Uses
                  </th>
              </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(item, index) in items"
                  :key="'shop-items-' + index"
                  class="border border-opacity-0"
                  :class="
                    selectedItems.includes(item.id)
                      ? 'bg-purple-100 border-opacity-100 border-purple-200'
                      : (index%2 === 0 ? 'bg-white' : 'bg-gray-50')
                  "
                  @click="toggleItems(item)"
                >
                  <td class="px-6 py-3 whitespace-nowrap text-sm text-left font-medium text-gray-900">
                    {{ item.name }}
                  </td>
                  <td class="px-6 py-3 whitespace-nowrap text-sm text-left text-gray-500">
                    {{ item.description }}
                  </td>
                  <td class="px-6 py-3 whitespace-nowrap text-sm text-center text-gray-500">
                    {{ item.uses > 0 ? item.uses + ' uses' : 'N/A' }}
                  </td>
                </tr>
              </tbody>
          </table>
        </div>

        <h4 class="mt-4 font-fantasy text-xl border-b border-gray-100 pb-2 mb-2 block text-left">Weapons</h4>
        <div>
          <table class="min-w-full divide-y divide-gray-200 border border-gray-100 rounded-lg">
              <thead class="bg-gray-50">
              <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Name
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Description
                  </th>
                  <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Damage
                  </th>
              </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(weapon, index) in weapons"
                  :key="'shop-weapons-' + index"
                  class="border border-opacity-0"
                  :class="
                    selectedWeapons.includes(weapon.id)
                      ? 'bg-purple-100 border-opacity-100 border-purple-200'
                      : (index%2 === 0 ? 'bg-white' : 'bg-gray-50')
                  "
                  @click="toggleWeapons(weapon)"
                >
                  <td class="px-6 py-3 whitespace-nowrap text-sm text-left font-medium text-gray-900">
                    {{ weapon.name }}
                  </td>
                  <td class="px-6 py-3 whitespace-nowrap text-sm text-left text-gray-500">
                    {{ weapon.description }}
                  </td>
                  <td class="px-6 py-3 whitespace-nowrap text-sm text-center text-gray-500">
                    {{ weapon.damage }} damage
                  </td>
                </tr>
              </tbody>
          </table>
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
          character: this.character,
          total: this.total
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
