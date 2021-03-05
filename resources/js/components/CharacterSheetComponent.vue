<template>
  <div :key="random + keyChange" class="py-6 px-4 sm:px-6 lg:px-8">
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
      <div class="flex bg-gradient-to-l from-taupe to-violet shadow rounded-xl p-4 items-center">
        <div class="flex-grow-0">
          <h3 class="text-3xl font-fantasy block text-white">{{ character.name }}</h3>
          <p class="ml-2 uppercase text-white opacity-60 text-xs font-semibold tracking-widest">Level {{ character.level }}</p>
        </div>
        <div class="flex-grow text-right flex justify-end items-center">
          <div class="mr-2 flex justify-end items-center">
            <h3 class="text-2xl font-fantasy block text-white inline">XP</h3>
            <input v-model="character.xp" class="text-xl ml-2 w-16 tracking-tighter font-semibold bg-transparent outline-none focus:outline-none text-white opacity-50 focus:opacity-100"></input>
          </div>
          <button class="rounded border border-white border-opacity-10 px-3 py-2 font-fantasy text-lg text-white hover:text-taupe hover:bg-white focus:text-taupe focus:bg-white outline-none focus:outline-none transition-all">
            Level Up!
          </button>
        </div>
      </div>
      <!-- Toolbox -->
      <div class="grid grid-cols-1 mdl:grid-cols-6 xs:grid-cols-2 gap-4 my-4">
        <!-- Calculate HP -->
        <div class="col-span-1">
          <button class="rounded-lg shadow block w-full border text-sm font-semibold border-white border-opacity-20 bg-white bg-opacity-10 tracking-tightest px-3 py-2 text-white hover:text-taupe hover:bg-opacity-100 focus:text-taupe focus:bg-white outline-none focus:outline-none transition-all">
            Calculate HP
          </button>
        </div>
        <!-- Roll dice -->
        <div class="col-span-1">
          <button class="shadow text-sm font-semibold bg-white bg-opacity-10 rounded-lg block w-full border border-white border-opacity-20 tracking-tightest px-3 py-2 text-white hover:text-taupe hover:bg-opacity-100 focus:text-taupe focus:bg-white outline-none focus:outline-none transition-all">
            Dice Roller
          </button>
        </div>
        <!-- Basic Rules -->
        <div class="col-span-1">
          <button class="shadow text-sm font-semibold bg-white bg-opacity-10 rounded-lg block w-full border border-white border-opacity-20 tracking-tightest px-3 py-2 text-white hover:text-taupe hover:bg-opacity-100 focus:text-taupe focus:bg-white outline-none focus:outline-none transition-all">
            Basic Rules
          </button>
        </div>
        <!-- Equipment and Items list -->
        <div class="col-span-1">
          <button class="shadow text-sm font-semibold bg-white bg-opacity-10 rounded-lg block w-full border border-white border-opacity-20 tracking-tightest px-3 py-2 text-white hover:text-taupe hover:bg-opacity-100 focus:text-taupe focus:bg-white outline-none focus:outline-none transition-all">
            Item list
          </button>
        </div>
        <!-- Random Generators -->
        <div class="col-span-1">
          <button class="shadow text-sm font-semibold bg-white bg-opacity-10 rounded-lg block w-full border border-white border-opacity-20 tracking-tightest px-3 py-2 text-white hover:text-taupe hover:bg-opacity-100 focus:text-taupe focus:bg-white outline-none focus:outline-none transition-all">
            Generators
          </button>
        </div>
        <!-- Character and Locations -->
        <div class="col-span-1">
          <button class="shadow text-sm font-semibold bg-white bg-opacity-10 rounded-lg block w-full border border-white border-opacity-20 tracking-tightest px-3 py-2 text-white hover:text-taupe hover:bg-opacity-100 focus:text-taupe focus:bg-white outline-none focus:outline-none transition-all">
            World Details
          </button>
        </div>
      </div>
      <!-- Side Content -->
      <div class="grid grid-cols-1 gap-y-3 md:gap-x-4 md:grid-cols-2 mdl:grid-cols-3 items-start">
        <div class="col-span-2 mdl:col-span-1 grid grid-cols-1 xs:grid-cols-2 mdl:grid-cols-1 gap-3 items-start">
          <health-tracker class="col-span-1 xs:col-span-2 mdl:col-span-1" :current-hp="character.current_hp" :max-hp="character.max_hp" :armour="armourStrength" v-on:changeHp="updateHp"></health-tracker>
          <power :character-power="character.power" v-on:changePower="updatePower"></power>
          <stat name="Strength" :stat="character.str"></stat>
          <stat name="Dexterity" :stat="character.dex"></stat>
          <stat name="Constitution" :stat="character.con"></stat>
          <stat name="Intelligence" :stat="character.int"></stat>
          <stat name="Wisdom" :stat="character.wis"></stat>
          <stat name="Charisma" :stat="character.cha"></stat>
        </div>
        <!-- Main Content -->
        <div class="col-span-2 items-start">
          <div class="block mb-2">
            <nav class="relative z-0 rounded-lg shadow flex">
              <button
                :class="selectedTab === 'details' ? 'text-gray-900 rounded-l-lg group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center focus:z-10 outline-none focus:outline-none' : 'text-gray-700 hover:text-gray-800 rounded-l-lg group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center hover:bg-opacity-100 bg-opacity-50 focus:z-10 transition-all outline-none focus:outline-none'"
                @click="changeTab('details')"
              >
                <span>Details</span>
                <span
                  class="absolute inset-x-0 bottom-0 h-0.5"
                  :class="selectedTab === 'details' ? 'bg-taupe' : 'bg-transparent'"
                ></span>
              </button>

              <button
                :class="selectedTab === 'skills' ? 'text-gray-900 group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center focus:z-10 outline-none focus:outline-none' : 'text-gray-700 hover:text-gray-800 group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center hover:bg-opacity-100 bg-opacity-50 focus:z-10 transition-all outline-none focus:outline-none'"
                @click="changeTab('skills')"
              >
                <span>Skills/Abilities</span>
                <span
                  class="absolute inset-x-0 bottom-0 h-0.5"
                  :class="selectedTab === 'skills' ? 'bg-taupe' : 'bg-transparent'"
                ></span>
              </button>

              <button
                :class="selectedTab === 'items' ? 'text-gray-900 rounded-r-lg group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center focus:z-10 outline-none focus:outline-none' : 'text-gray-700 hover:text-gray-800 rounded-r-lg group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center hover:bg-opacity-100 bg-opacity-50 focus:z-10 transition-all outline-none focus:outline-none'"
                @click="changeTab('items')"
              >
                <span>Inventory</span>
                <span
                  class="absolute inset-x-0 bottom-0 h-0.5"
                  :class="selectedTab === 'items' ? 'bg-taupe' : 'bg-transparent'"
                ></span>
              </button>
            </nav>
          </div>
          <template v-if="selectedTab === 'details'">
            <!-- Background -->
            <div class="overflow-hidden shadow rounded-lg divide-y divide-gray-200">
              <div class="bg-white px-2 py-3 sm:px-3 flex">
                <div class="text-xs font-semibold uppercase tracking-widest text-gray-600">
                  Background
                </div>
              </div>
              <div class="bg-white bg-opacity-95 px-2 py-3 sm:p-3">
                <h4 class="text-sm text-violet font-semibold tracking-wide">{{ character.background.name }}</h4>
                <p class="text-xs tracking-wide leading-loose text-gray-800">{{ character.background.effect }}</p>
              </div>
            </div>
            <!-- Class -->
            <div class="mt-4 overflow-hidden shadow rounded-lg divide-y divide-gray-200">
              <div class="bg-white px-2 py-3 sm:px-3 flex">
                <div class="text-xs font-semibold uppercase tracking-widest text-gray-600">
                  Class
                </div>
              </div>
              <div class="bg-white bg-opacity-95 px-2 py-3 sm:p-3">
                <h4 class="text-sm text-violet font-semibold tracking-wide">{{ character.class.name }}</h4>
                <p class="text-xs tracking-wide leading-loose text-gray-800">{{ character.class.effect }}</p>
              </div>
            </div>
          </template>
          <template v-if="selectedTab === 'skills'">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 sm:gap-y-0 gap-x-0 sm:gap-x-4">
              <!-- Abilities -->
              <div class="overflow-hidden divide-y divide-gray-200">
                <div class="bg-white px-2 py-3 sm:px-3 flex rounded-t-lg">
                  <div class="text-xs font-semibold uppercase tracking-widest text-gray-600">
                    Abilities
                  </div>
                </div>
                <div class="bg-white bg-opacity-95 px-2 sm:px-3 rounded-b-lg shadow">
                  <div
                    v-for="(ability, index) in character.abilities"
                    :key="'ability-' + index"
                    class="py-3 border-b border-gray-200 border-opacity-95"
                  >
                    <h4 class="text-sm text-violet font-semibold tracking-wide">{{ ability.name }}</h4>
                    <p class="text-xs tracking-wide leading-loose text-gray-800">{{ ability.effect }}</p>
                  </div>
                </div>
              </div>
              <!-- Skills -->
              <div class="overflow-hidden divide-y divide-gray-200">
                <div class="bg-white px-2 py-3 sm:px-3 flex rounded-t-lg">
                  <div class="text-xs font-semibold uppercase tracking-widest text-gray-600">
                    Skills
                  </div>
                </div>
                <div class="bg-white bg-opacity-95 px-2 sm:px-3 rounded-b-lg shadow">
                  <div
                    v-for="(skill, index) in character.skills"
                    :key="'skill-' + index"
                    class="py-3 border-b border-gray-200 border-opacity-95"
                  >
                    <h4 class="text-sm text-violet font-semibold tracking-wide">{{ skill.name }}</h4>
                    <p class="text-xs tracking-wide leading-loose text-gray-800">{{ skill.flavour_text }}</p>
                  </div>
                </div>
              </div>
            </div>
          </template>
          <template v-if="selectedTab === 'items'">
            <div class="grid grid-cols-1 gap-y-4">
              <!-- Armours -->
              <div class=" rounded-lg shadow overflow-hidden divide-y divide-gray-200">
                <div class="bg-white px-2 py-3 sm:px-3 flex">
                  <div class="text-xs font-semibold uppercase tracking-widest text-gray-600">
                    Armours / Clothing
                  </div>
                </div>
                <div class="bg-white bg-opacity-95 px-2 sm:px-3 flex">
                  <div class="flex-grow text-xs font-semibold text-violet uppercase tracking-widest py-2 px-3">
                    Item
                  </div>
                  <div class="flex-grow-0 w-24 text-center text-xs font-semibold text-violet uppercase tracking-widest py-2 px-3">
                    Value
                  </div>
                  <div class="flex-grow-0 w-24 text-center text-xs font-semibold text-violet uppercase tracking-widest py-2 px-3">
                    Quantity
                  </div>
                  <div class="flex-grow-0 w-24 text-center text-xs font-semibold text-violet uppercase tracking-widest py-2 px-3">
                  </div>
                </div>
                <div
                  v-for="(armour, index) in character.armours"
                  :key="'armour-list-' + index"
                  class="bg-white bg-opacity-95 px-2 sm:px-3 flex items-center"
                >
                  <div class="flex-grow text-sm font-semibold text-gray-800 py-2 px-3">
                    {{ armour.name }}<br>
                    <span class="text-xs font-normal text-gray-600">{{ armour.description }}</span>
                  </div>
                  <div class="flex-grow-0 w-24 text-center text-sm text-gray-800 py-2 px-3">
                    +{{ armour.armour_value }}
                  </div>
                  <div class="flex-grow-0 w-24 text-center text-sm text-gray-800 py-2 px-3">
                    {{ armour.pivot.quantity }}
                  </div>
                  <div class="flex-grow-0 w-24 text-center text-sm text-gray-800 py-2 px-3">
                    <div class="flex items-center block">
                      <input :id="'armour-carried-' + index" type="checkbox" v-model="armour.pivot.carried" class="h-4 w-4 text-violet focus:ring-0 focus:outline-none border-gray-300 rounded">
                      <label :for="'armour-carried-' + index" class="ml-2 block text-xs text-gray-700">
                        Carried?
                      </label>
                    </div>
                    <div class="mt-1 flex items-center block">
                      <input :id="'armour-equipped-' + index" type="checkbox" v-model="armour.pivot.equipped" class="h-4 w-4 text-violet focus:ring-0 focus:outline-none border-gray-300 rounded">
                      <label :for="'armour-equipped-' + index" class="ml-2 block text-xs text-gray-700">
                        Equipped?
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Weapons -->
              <div class="rounded-lg shadow overflow-hidden divide-y divide-gray-200">
                <div class="bg-white px-2 py-3 sm:px-3 flex">
                  <div class="text-xs font-semibold uppercase tracking-widest text-gray-600">
                    Weapons
                  </div>
                </div>
                <div class="bg-white bg-opacity-95 px-2 sm:px-3 flex">
                  <div class="flex-grow text-xs font-semibold text-violet uppercase tracking-widest py-2 px-3">
                    Item
                  </div>
                  <div class="flex-grow-0 w-24 text-center text-xs font-semibold text-violet uppercase tracking-widest py-2 px-3">
                    Damage
                  </div>
                  <div class="flex-grow-0 w-24 text-center text-xs font-semibold text-violet uppercase tracking-widest py-2 px-3">
                    Quantity
                  </div>
                  <div class="flex-grow-0 w-24 text-center text-xs font-semibold text-violet uppercase tracking-widest py-2 px-3">
                  </div>
                </div>
                <div
                  v-for="(weapon, index) in character.weapons"
                  :key="'weapon-list-' + index"
                  class="bg-white bg-opacity-95 px-2 sm:px-3 flex items-center"
                >
                  <div class="flex-grow text-sm font-semibold text-gray-800 py-2 px-3">
                    {{ weapon.name }}<br>
                    <span class="text-xs font-normal text-gray-600">{{ weapon.description }}</span>
                  </div>
                  <div class="flex-grow-0 w-24 text-center text-sm text-gray-800 py-2 px-3">
                    {{ weapon.damage }}
                  </div>
                  <div class="flex-grow-0 w-24 text-center text-sm text-gray-800 py-2 px-3">
                    {{ weapon.pivot.quantity }}
                  </div>
                  <div class="flex-grow-0 w-24 text-center text-sm text-gray-800 py-2 px-3">
                    <div class="flex items-center block">
                      <input :id="'weapon-carried-' + index" type="checkbox" v-model="weapon.pivot.carried" class="h-4 w-4 text-violet focus:ring-0 focus:outline-none border-gray-300 rounded">
                      <label :for="'weapon-carried-' + index" class="ml-2 block text-xs text-gray-700">
                        Carried?
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Items -->
              <div class=" rounded-lg shadow overflow-hidden divide-y divide-gray-200">
                <div class="bg-white px-2 py-3 sm:px-3 flex">
                  <div class="text-xs font-semibold uppercase tracking-widest text-gray-600">
                    Items
                  </div>
                </div>
                <div class="bg-white bg-opacity-95 px-2 sm:px-3 flex">
                  <div class="flex-grow text-xs font-semibold text-violet uppercase tracking-widest py-2 px-3">
                    Item
                  </div>
                  <div class="flex-grow-0 w-24 text-center text-xs font-semibold text-violet uppercase tracking-widest py-2 px-3">
                    Uses
                  </div>
                  <div class="flex-grow-0 w-24 text-center text-xs font-semibold text-violet uppercase tracking-widest py-2 px-3">
                    Quantity
                  </div>
                  <div class="flex-grow-0 w-24 text-center text-xs font-semibold text-violet uppercase tracking-widest py-2 px-3">
                  </div>
                </div>
                <div
                  v-for="(item, index) in character.equipment"
                  :key="'item-list-' + index"
                  class="bg-white bg-opacity-95 px-2 sm:px-3 flex items-center"
                >
                  <div class="flex-grow text-sm font-semibold text-gray-800 py-2 px-3">
                    {{ item.name }}<br>
                    <span class="text-xs font-normal text-gray-600">{{ item.description }}</span>
                  </div>
                  <div class="flex-grow-0 w-24 text-center text-sm text-gray-800 py-2 px-3">
                    {{ item.pivot.uses !== null ? item.pivot.uses : 'N/A' }}
                  </div>
                  <div class="flex-grow-0 w-24 text-center text-sm text-gray-800 py-2 px-3">
                    {{ item.pivot.quantity }}
                  </div>
                  <div class="flex-grow-0 w-24 text-center text-sm text-gray-800 py-2 px-3">
                    <div class="flex items-center block">
                      <input :id="'item-carried-' + index" type="checkbox" v-model="item.pivot.carried" class="h-4 w-4 text-violet focus:ring-0 focus:outline-none border-gray-300 rounded">
                      <label :for="'item-carried-' + index" class="ml-2 block text-xs text-gray-700">
                        Carried?
                      </label>
                    </div>
                    <div v-if="item.pivot.uses !== null" class="mt-1 flex items-center block">
                      <button
                        :disabled="!item.pivot.carried"
                        class="w-full text-xs px-2 bg-transparent border rounded border-violet text-violet hover:bg-violet hover:text-white"
                        @click="item.pivot.uses = item.pivot.uses - 1"
                      >Use</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </template>
          <div class="mt-4 overflow-hidden shadow rounded-lg divide-y divide-gray-200">
            <div class="bg-white px-2 py-3 sm:px-3 flex">
              <div class="text-xs font-semibold uppercase tracking-widest text-gray-600">
                Notes
              </div>
            </div>
            <div class="bg-white bg-opacity-95 px-2 py-2 sm:p-3">
              <textarea v-model="character.notes" class="text-lg border-0 w-full font-handwriting leading-loose bg-transparent outline-none focus:outline-none focus:outline-none focus:ring-0 focus:shadow-none"></textarea>
            </div>
            <button @click="$refs.testModel.open()">Test</button>
          </div>
        </div>
      </div>
    </template>
    <sweet-modal title="Oh noes…" ref="testModel" hide-close-button blocking pulse-on-block>
      This is an error…

      <button slot="button">That's fine!</button>
      <button slot="button">That's not fine!</button>
    </sweet-modal>
  </div>
</template>

<script>
import Spinner from "vue-simple-spinner";
import Stat from "./StatComponent";
import HealthTracker from "./HealthTrackerComponent";
import Power from "./PowerComponent";

export default {
  components: {
    Spinner,
    Stat,
    HealthTracker,
    Power
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
      character: null,
      selectedTab: 'items',
      random: Math.floor(100000 + Math.random() * 900000),
      keyChange: 1,
      stopCheck: false
    };
  },
  computed: {
    armourStrength: function () {
      if (this.character !== null) {
        let total = 0;
        this.character.armours.forEach(armour => {
          if (armour.pivot.equipped) {
            total += armour.armour_value;
          }
        })
        return total;
      }
      return 0;
    }
  },
  watch: {
    character: {
      handler(newVal, oldVal) {
        if (!this.stopCheck && oldVal !== null && newVal !== null) {
          this.updateCharacter();
        }
      },
      deep: true
    },
    keyChange: function (newVal, oldVal) {
      if (newVal !== oldVal) {
        this.stopCheck = false;
      }
    }
  },
  mounted() {
    this.fetchCharacter();
  },
  methods: {
    fetchCharacter() {
      this.isLoading = true;
      axios
        .get("api/characters/show/" + this.id)
        .then(res => {
          this.character = res.data.character;
          this.isLoading = false;
          this.keyChange++;
        })
        .catch(e => {
          console.log(e.data);
          this.isLoading = false;
        });
    },
    changeTab(tab) {
      this.selectedTab = tab;
    },
    updatePower(power) {
      this.character.power = Number(power);
    },
    updateHp(hp) {
      this.character.current_hp = Number(hp);
    },
    updateCharacter() {
      this.stopCheck = true;
      axios
        .patch('api/characters/update', {
          character: this.character
        })
        .then(res => {
          if (res.data.success) {
            this.character = res.data.character;
            this.keyChange++;
          } else {
            throw new Error('fuck');
          }
        })
        .catch(e => {
          console.log(e.data);
        })
    }
  }
};
</script>
