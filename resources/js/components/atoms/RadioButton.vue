<template>
    <label class="py-1 cursor-pointer flex items-center hover:underline">
        <input
            type="radio"
            :value="option.key"
            :checked="value.key === option.key"
            @change="$emit('input', option)"
            class="cursor-pointer h-5 w-5 border border-black rounded-full bg-white checked:bg-black appearance-none focus:outline-none"
        >
        <span class="ml-4">
            {{ option.title }}
        </span>
    </label>
</template>

<script>
  export default {
    props: {
        value: {
            type: Object,
            required: true
        },
        option: {
            type: Object,
            required: true
        }
    }
  }
</script>
