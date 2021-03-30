<template>
  <div>
    <template v-if="isLoading">
      <spinner
        line-bg-color="#e7e7e7"
        line-fg-color="#753a88"
        :line-size="4"
        size="48"
        message="Levelling you up..."
      />
    </template>
    <template v-else>
      <h3
        class="mb-3 block text-center text-gray-700 font-semibold tracking-wide"
      >
        Congratulations! You're going from level
        <span class="text-violet font-bold">{{ current.level }}</span> to level
        <span class="text-violet font-bold">{{ current.level + 1 }}</span>
      </h3>
      <div class="grid grid-cols-1 divide-y divide-gray-100">
        <div
          v-if="damageLevels.includes(current.level + 1)"
          class="col-span-1 py-3"
        >
          <p class="text-sm leading-loose text-left">
            <span class="font-semibold">Your hits are getting stronger!</span>
            All physical damage you deal is increased by +1d6.
          </p>
        </div>
        <div
          v-if="healthLevels.includes(current.level + 1)"
          class="col-span-1 py-3"
        >
          <p class="text-sm leading-loose text-left">
            <span class="font-semibold">Your maximum HP increases!</span> To
            determine how much more HP you get, please roll a d6.
          </p>
          <p class="text-sm leading-loose text-center text-violet italic">
            "My HP is going to increase by
            <input
              type="text"
              v-model="hpIncrease"
              class="w-8 bg-transparent border-0 p-0 text-xl font-semibold text-violet outline-none ring-0 focus:border-0 focus:ring-0 focus:outline-none border-b border-gray-700 text-center"
            />"
          </p>
        </div>
        <div
          v-if="skillLevels.includes(current.level + 1)"
          class="col-span-1 py-3"
        >
          <p class="text-sm leading-loose text-left">
            <span class="font-semibold">You gain a new skill! </span>Please
            select a new skill from the list below and bask in your talented
            glory!
          </p>

          <select
            :disabled="skillsLoading"
            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
            v-model="selectedSkill"
          >
            <option disabled selected>-- Select Skill --</option>
            <option
              v-for="(skill, index) in skills"
              :key="'level-skills-' + index"
              :value="skill.id"
            >
              {{ skill.name }}
            </option>
          </select>
        </div>
        <div
          v-if="abilityLevels.includes(current.level + 1)"
          class="col-span-1 py-3"
        >
          <p class="text-sm leading-loose text-left">
            <span class="font-semibold">You gain a new ability! </span>Choose a
            new ability from the list below and enjoy your new power.
          </p>

          <select
            :disabled="abilitiesLoading"
            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
            v-model="selectedAbility"
          >
            <option disabled selected>-- Select Ability --</option>
            <option
              v-for="(ability, index) in abilities"
              :key="'level-abilities-' + index"
              :value="ability.id"
            >
              {{ ability.name }}
            </option>
          </select>
        </div>
        <div
          v-if="specialLevels.includes(current.level + 1)"
          class="col-span-1 py-3"
        >
          <p class="text-sm leading-loose text-left">
            <span class="font-semibold">You gain a new {{ character.has_spells ? 'spell' : 'speciality skill' }}! </span>Choose a
            new {{ character.has_spells ? 'spell' : 'speciality skill' }} from the list below and enjoy your new power.
          </p>

          <select
            :disabled="specialsLoading"
            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
            v-model="selectedSpecial"
          >
            <option disabled selected>-- Select {{ character.has_spells ? 'Spell' : 'Speciality Skill' }} --</option>
            <option
              v-for="(special, index) in specials"
              :key="'level-specials-' + index"
              :value="special.id"
            >
              {{ special.name }}
            </option>
          </select>
        </div>
        <div
          v-if="attrLevels.includes(current.level + 1)"
          class="col-span-1 py-3"
        >
          <p class="text-sm leading-loose text-left">
            <span class="font-semibold">Your stats are improving! </span>Choose
            one of your stats to increase by 1.
          </p>

          <select
            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
            v-model="statIncrease"
          >
            <option disabled selected>-- Select Ability --</option>
            <option value="str">Strength</option>
            <option value="dex">Dexterity</option>
            <option value="con">Constitution</option>
            <option value="int">Intelligence</option>
            <option value="wis">Wisdom</option>
            <option value="cha">Charisma</option>
          </select>
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
      type: Object,
      default: () => {},
    },
  },
  data() {
    return {
      current: this.character,
      healthLevels: [2, 4, 6, 8, 10],
      skillLevels: [3, 6, 9],
      specialLevels: [2,4,6,8,10],
      attrLevels: [4, 7, 10],
      abilityLevels: [3, 6, 9],
      damageLevels: [5, 10],
      skills: [],
      abilities: [],
      specials: [],
      skillsLoading: false,
      abilitiesLoading: false,
      specialsLoading: false,
      statIncrease: null,
      selectedSkill: null,
      selectedAbility: null,
      selectedSpecial: null,
      hpIncrease: null,
      isLoading: false,
    };
  },
  created() {
    if (this.skillLevels.includes(this.current.level + 1)) {
      this.fetchSkills();
    }
    if (this.abilityLevels.includes(this.current.level + 1)) {
      this.fetchAbilities();
    }
    if (this.specialLevels.includes(this.current.level + 1)) {
      if (this.character.has_spells) {
        this.fetchSpells();
      } else {
        this.fetchSpecials();
      }
    }
  },
  methods: {
    fetchSkills() {
      this.skillsLoading = true;
      axios
        .get("api/skills/index/" + this.character.id)
        .then((res) => {
          if (res.data.skills != null) {
            this.skills = res.data.skills;
            this.skillsLoading = false;
          } else {
            throw new Error("Missing skills data");
          }
        })
        .catch((e) => {
          let message;
          if (e.response.data.reason != null) {
            message = e.response.data.reason;
          } else {
            message = "Problem fetching skills";
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
          this.skillsLoading = false;
        });
    },
    fetchAbilities() {
      this.abilitiesLoading = true;
      axios
        .get("api/abilities/index/" + this.character.id)
        .then((res) => {
          if (res.data.abilities != null) {
            this.abilities = res.data.abilities;
            this.abilitiesLoading = false;
          } else {
            throw new Error("Missing abilities data");
          }
        })
        .catch((e) => {
          let message;
          if (e.response.data.reason != null) {
            message = e.response.data.reason;
          } else {
            message = "Problem fetching abilities";
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
          this.abilitiesLoading = false;
        });
    },
    fetchSpells() {
      this.specialsLoading = true;
      axios
        .get("api/spells/index/" + this.character.id)
        .then((res) => {
          if (res.data.spells != null) {
            this.specials = res.data.spells;
            this.specialsLoading = false;
          } else {
            throw new Error("Missing spells data");
          }
        })
        .catch((e) => {
          let message;
          if (e.response.data.reason != null) {
            message = e.response.data.reason;
          } else {
            message = "Problem fetching spells";
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
          this.specialsLoading = false;
        });
    },
    fetchSpecials() {
      this.specialsLoading = true;
      axios
        .get("api/specials/index/" + this.character.id)
        .then((res) => {
          if (res.data.specials != null) {
            this.specials = res.data.specials;
            this.specialsLoading = false;
          } else {
            throw new Error("Missing specialist skills data");
          }
        })
        .catch((e) => {
          let message;
          if (e.response.data.reason != null) {
            message = e.response.data.reason;
          } else {
            message = "Problem fetching specialist skills";
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
          this.specialsLoading = false;
        });
    },
    submit() {
      if (!this.isLoading) {
        this.isLoading = true;
        axios
          .post("api/character/level", {
            character: this.current.id,
            new_level: this.current.level + 1,
            ability: this.selectedAbility,
            skill: this.selectedSkill,
            hp: this.hpIncrease,
            stat: this.statIncrease,
            special: this.selectedSpecial
          })
          .then((res) => {
            location.reload();
          })
          .catch((e) => {
            let message;
            if (e.response.data.reason != null) {
              message = e.response.data.reason;
            } else {
              message = "Problem levelling up";
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
  },
};
</script>
