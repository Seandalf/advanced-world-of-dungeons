<template>
    <div :key="random + keyChange" class="mt-8">
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
        <!-- Header -->
        <div class="py-4 px-6 shadow rounded-t-lg bg-gradient-to-l from-taupe to-violet">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-center">
            <div class="col-span-1">
              <h3 class="block text-center mb-2 sm:text-left sm:mb-0 font-fantasy text-2xl text-white">{{ character.name }}</h3>
            </div>
            <div class="col-span-1">
              <h3 class="block text-center sm:text-right sm:mb-0 font-fantasy text-xl text-white">Level {{ character.level }}</h3>
            </div>
          </div>
        </div>
        <!-- Main Content -->
        <div class="p-6 shadow bg-white rounded-b-lg">
          <div class="grid grid-cols-2 sm:grid-cols-3 mdl:grid-cols-6 gap-4 grid-flow-row">
            <h4 class="font-fantasy text-xl border-b border-gray-100 pb-2 col-span-2 sm:col-span-3 mdl:col-span-6">Character Stats</h4>
            <stat name="Strength" :stat="character.str" color="red" class="col-span-1 flex-grow-0 flex-shrink-0"></stat>
            <stat name="Dexterity" :stat="character.dex" class="col-span-1 flex-grow-0 flex-shrink-0"></stat>
            <stat name="Constitution" :stat="character.con" class="col-span-1 flex-grow-0 flex-shrink-0"></stat>
            <stat name="Intelligence" :stat="character.int" class="col-span-1 flex-grow-0 flex-shrink-0"></stat>
            <stat name="Wisdom" :stat="character.wis" class="col-span-1 flex-grow-0 flex-shrink-0"></stat>
            <stat name="Charisma" :stat="character.cha" class="col-span-1 flex-grow-0 flex-shrink-0"></stat>
          </div>
          <div class="mt-6 grid grid-cols-1 mdl:grid-cols-3 gap-4">
          <!-- Sidebar -->
            <div class="col-span-1">
              <div>
                <h4 class="font-fantasy text-xl border-b border-gray-100 pb-2 mb-2 block">Character Info</h4>
                <health-tracker class="col-span-1 xs:col-span-2 mdl:col-span-1" v-model="character.current_hp" :max-hp="character.max_hp" :armour="armourStrength"></health-tracker>
                <experience-tracker v-model="character.xp" :level="character.level" v-on:levelUp="$refs.levelUpModal.open()" class="mt-3"></experience-tracker>
                <power-tracker v-if="character.class.has_power" v-model="character.power" class="mt-3"></power-tracker>
              </div>
              <div v-if="character.spells.length > 0" class="mt-4">
                <h4 class="font-fantasy text-xl border-b border-gray-100 pb-2 mb-2 block">Spells</h4>
                <div class="grid grid-cols-1 gap-y-3 px-2">
                  <div v-for="(spell, index) in character.spells" :key="'spells-' + random + index" class="col-span-1">
                    <h5 class="font-fantasy text-xl text-violet">{{ spell.name }}</h5>
                    <p class="leading-loose tracking-wide text-ds text-gray-700" v-html="spell.effect"></p>
                  </div>
                </div>
              </div>
              <div class="mt-4">
                <h4 class="font-fantasy text-xl border-b border-gray-100 pb-2 mb-2 block">Notes</h4>
                <notes v-model="character.notes"></notes>
              </div>
            </div>
            <!-- main body -->
            <div class="col-span-1 mdl:col-span-2">
              <div>
                <h4 class="font-fantasy text-xl border-b border-gray-100 pb-2 mb-2 block">{{ character.class.name }} <span class="font-sans text-gray-300 uppercase tracking-widest text-xs font-semibold ml-2">Class</span></h4>
                <p class="leading-loose tracking-wide text-ds text-gray-700 px-2" v-html="character.class.effect"></p>
              </div>
              <div v-if="character.background !== null" class="mt-4">
                <h4 class="font-fantasy text-xl border-b border-gray-100 pb-2 mb-2 block">{{ character.background.name }} <span class="font-sans text-gray-300 uppercase tracking-widest text-xs font-semibold ml-2">Background</span></h4>
                <p class="leading-loose tracking-wide text-ds text-gray-700 px-2" v-html="character.background.effect"></p>
              </div>
              <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="sm:col-span-2">
                  <h4 class="font-fantasy text-xl border-b border-gray-100 pb-2 mb-2 block">Abilities</h4>
                  <div class="grid grid-cols-1 gap-y-3 px-2">
                    <div v-for="(ability, index) in character.abilities" :key="'abilities-' + random + index" class="col-span-1">
                      <h5 class="font-fantasy text-xl text-violet">{{ ability.name }}</h5>
                      <p class="leading-loose tracking-wide text-ds text-gray-700" v-html="ability.effect"></p>
                    </div>
                  </div>
                </div>
                <div class="col-span-1">
                  <h4 class="font-fantasy text-xl border-b border-gray-100 pb-2 mb-2 block">Skills</h4>
                  <div class="px-2 grid grid-cols-2 sm:grid-cols-3 mdl:grid-cols-1">
                    <h6 v-for="(skill, index) in character.skills" :key="'skills-' + random + index" class="text-sm text-violet font-semibold">{{ skill.name }}</h6>
                  </div>
                </div>
              </div>
              <div class="mt-4">
                <div class="grid grid-cols-3 border-b border-gray-100 pb-2 mb-2 items-center justify-items-stretch">
                  <div class="col-span-2 flex items-center">
                    <h4 class="font-fantasy flex-grow-0 text-xl block">Equipment</h4>
                    <div class="flex-grow ml-3 -mt-0.5">
                      <button type="button" @click="$refs.shoppingModal.open()" class="inline-flex items-center px-2 py-1 border border-transparent text-xs font-semibold rounded shadow-sm bg-purple-100 text-purple-800 hover:bg-purple-200 focus:outline-none focus:ring-offset-0 focus:ring-0">
                        Go Shopping
                      </button>
                    </div>
                  </div>
                  <coin v-model="character.coin"></coin>
                </div>
                <!-- Equipment table -->
                <div>
                  <table class="min-w-full divide-y divide-gray-200 border border-gray-100 rounded-lg">
                      <thead class="bg-gray-50">
                      <tr>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Name
                          </th>
                          <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Quantity
                          </th>
                          <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Info
                          </th>
                          <th scope="col" class="relative px-6 py-3">
                          <span class="sr-only">Actions</span>
                          </th>
                      </tr>
                      </thead>
                      <tbody>
                        <!-- Armours -->
                        <tr v-for="(armour, index) in character.armours" :key="'equip-armours-' + random + index" :class="index%2 === 0 ? 'bg-white' : 'bg-gray-50'">
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-left font-medium text-gray-900">
                            {{ armour.name }}<br>
                            <span class="text-gray-500 text-xs font-normal">{{ armour.description }}</span>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                            <input type="text" class="text-sm text-center text-gray-500 w-10 border-none ring-0 bg-transparent focus:outline-none focus:ring-0 focus:border-none" v-model="armour.pivot.quantity" />
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                            +{{ armour.armour_value }} armour
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-center font-medium">
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
                          </td>
                        </tr>
                        <!-- Weapons -->
                        <tr v-for="(weapon, index) in character.weapons" :key="'equip-weapons-' + random + index" :class="(index + character.armours.length)%2 === 0 ? 'bg-white' : 'bg-gray-50'">
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-left font-medium text-gray-900">
                            {{ weapon.name }}<br>
                            <span class="text-gray-500 text-xs font-normal">{{ weapon.description }}</span>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                            {{ weapon.pivot.quantity }}
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                            {{ weapon.damage }} damage
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-center font-medium">
                            <div class="flex items-center block">
                              <input :id="'weapon-carried-' + index" type="checkbox" v-model="weapon.pivot.carried" class="h-4 w-4 text-violet focus:ring-0 focus:outline-none border-gray-300 rounded">
                              <label :for="'weapon-carried-' + index" class="ml-2 block text-xs text-gray-700">
                                Carried?
                              </label>
                            </div>
                          </td>
                        </tr>
                        <!-- Items -->
                        <tr v-for="(item, index) in character.equipment" :key="'equip-items-' + random + index" :class="(index + character.armours.length + character.weapons.length)%2 === 0 ? 'bg-white' : 'bg-gray-50'">
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-left font-medium text-gray-900">
                            {{ item.name }}<br>
                            <span class="text-gray-500 text-xs font-normal">{{ item.description }}</span>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                            {{ item.pivot.quantity }}
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                            {{ item.pivot.uses > 0 ? item.pivot.uses + ' uses' : 'N/A' }}
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-center font-medium">
                            <div class="flex items-center block">
                              <input :id="'item-carried-' + index" type="checkbox" v-model="item.pivot.carried" class="h-4 w-4 text-violet focus:ring-0 focus:outline-none border-gray-300 rounded">
                              <label :for="'item-carried-' + index" class="ml-2 block text-xs text-gray-700">
                                Carried?
                              </label>
                            </div>
                            <div v-if="item.pivot.uses !== null" class="mt-1 flex items-center block">
                              <button
                                :disabled="!item.pivot.carried || item.pivot.uses === 0"
                                class="w-full text-xs px-2 bg-transparent border rounded border-violet border-opacity-30 text-violet hover:bg-violet hover:text-white disabled:pointer-events-none disabled:opacity-50"
                                @click="item.pivot.uses = item.pivot.uses - 1"
                              >Use</button>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                  </table>
                </div>
                <!-- End table -->
              </div>
            </div>
          </div>
        </div>

        <sweet-modal ref="levelUpModal" hide-close-button blocking pulse-on-block>
          <level-up
            ref="levelUpComp"
            :character="character"
          ></level-up>
          <button
            slot="button"
            @click="$refs.levelUpModal.close()"
            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
          >
            Cancel
          </button>
          <button
            slot="button"
            @click="$refs.levelUpComp.submit()"
            class="ml-2 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
          >
            Confirm
          </button>
        </sweet-modal>

        <sweet-modal ref="shoppingModal" hide-close-button blocking pulse-on-block>
          <shopping
            ref="shoppingComp"
            :character="character.id"
            :coin="character.coin"
          ></shopping>
          <button
            slot="button"
            @click="$refs.shoppingModal.close()"
            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
          >
            Cancel
          </button>
          <button
            slot="button"
            @click="$refs.shoppingComp.submit()"
            class="ml-2 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:pointer-events-none disabled:opacity-50"
          >
            Purchase
          </button>
        </sweet-modal>
      </template>
    </div>
</template>

<script>
import Spinner from "vue-simple-spinner";
import Stat from "./StatComponent.vue";
import HealthTracker from "./HealthTrackerComponent";
import ExperienceTracker from "./ExperienceTrackerComponent";
import PowerTracker from "./PowerTrackerComponent";
import Coin from "./CoinComponent";
import LevelUp from "./LevelUpComponent";
import Notes from "./NotesComponent";
import Shopping from "./ShoppingComponent";

export default {
  components: {
    Spinner,
    Stat,
    HealthTracker,
    ExperienceTracker,
    PowerTracker,
    Coin,
    LevelUp,
    Notes,
    Shopping
  },
  props: {
    id: {
      type: Number,
      default: null,
    },
  },
  data() {
    return {
      isLoading: false,
      character: null,
      random: Math.floor(100000 + Math.random() * 900000),
      keyChange: 1
    };
  },
  computed: {
    armourStrength: function () {
      if (this.character !== null) {
        let total = 0;
        this.character.armours.forEach((armour) => {
          if (armour.pivot.equipped) {
            total += armour.armour_value;
          }
        });
        return total;
      }
      return 0;
    },
  },
  watch: {
    character: {
      handler(newVal, oldVal) {
        if (!this.stopCheck && oldVal !== null && newVal !== null) {
          this.updateCharacter();
        }
      },
      deep: true,
    },
    keyChange: function (newVal, oldVal) {
      if (newVal !== oldVal) {
        this.stopCheck = false;
      }
    },
  },
  created() {
    this.fetchCharacter();
  },
  methods: {
    sendError(e, defaultMessage) {
        let message;
        if (e.response.data.reason != null) {
        message = e.response.data.reason;
        } else {
        message = defaultMessage;
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
    },
    fetchCharacter() {
      this.isLoading = true;
      axios
        .get("api/characters/show/" + this.id)
        .then((res) => {
          this.character = res.data.character;
          this.isLoading = false;
          this.keyChange++;
        })
        .catch((e) => {
          this.sendError(e, "Problem fetching your character");
        });
    },
    updateCharacter() {
      this.stopCheck = true;
      axios
        .patch("api/characters/update", {
          character: this.character,
        })
        .then((res) => {
          if (res.data.success) {
            this.character = res.data.character;
            this.keyChange++;
          } else {
            throw new Error("fuck");
          }
        })
        .catch((e) => {
          let message;
          if (e.response.data.reason != null) {
            message = e.response.data.reason;
          } else {
            message = "Problem saving your character";
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
  }
}

</script>