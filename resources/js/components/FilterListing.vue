<template>
    <section class="mt-20">
        <slot name="before-list"></slot>
        <radio-button
            v-for="option in options"
            :key="option.key"
            :option="option"
            v-model="selectedOption"
        />
        <transition name="items-list" mode="out-in">
            <div
                v-for="option in options"
                v-if="selectedOption.key === option.key"
                :key="option.key"
                class="mt-10"
            >
                <div v-for="(item, index) in items.filter(it => it.filterTags.includes(option.key))" :key="index">
                    <slot name="list-item" :item="item"></slot>
                </div>
            </div>
        </transition>
        <slot name="after-list"></slot>
    </section>
</template>

<script>
import RadioButton from "./atoms/RadioButton";

export default {
    components: {
        RadioButton,
    },
    data() {
        return {
            selectedOption: this.options[0]
        }
    },
    props: {
        options: {
            type: Array,
            required: true
        },
        items: {
            type: Array,
            required: true
        }
    }
}
</script>

<style>
.items-list-leave-active {
    @apply transition duration-200 ease-in;
}

.items-list-enter-active {
    @apply transition duration-300 ease-out;
}

.items-list-leave-to {
    @apply opacity-0 transform -translate-x-8
}

.items-list-enter {
    @apply opacity-0 transform translate-x-8
}
</style>
