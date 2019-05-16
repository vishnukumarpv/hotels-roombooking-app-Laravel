<template>
    <div class="btn-group">
        <li @click="toggleMenu()" class="dropdown-toggle" v-if="selectedOption.name !== undefined">
          {{ selectedOption.name }}
          <span class="caret"></span>
        </li>

        <li @click="toggleMenu()" class="dropdown-toggle" v-if="selectedOption.name === undefined">
          {{placeholderText}}
          <span class="caret"></span>
        </li>

        <ul class="dropdown-menu" v-if="showMenu">
            <li v-for="option in options">
                <a href="javascript:void(0)" @click="updateOption(option)">
                    {{ option.name }}
                </a>
            </li> 
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                selectedOption: {
                  name: '',
                },
                showMenu: false,
                placeholderText: 'Please select an item',
            }
        },
        props: {
            options: {
                type: [Array, Object]
            },
            selected: {},
            placeholder: [String]
        },
        mounted() {
            this.selectedOption = this.selected;
            if (this.placeholder)
            {
                this.placeholderText = this.placeholder;
            }
        },
        methods: {
            updateOption(option) {
                this.selectedOption = option;
                this.showMenu = false;
                this.$emit('updateOption', this.selectedOption);
            },
            toggleMenu() {
              this.showMenu = !this.showMenu;
            }
        }
    }
</script>