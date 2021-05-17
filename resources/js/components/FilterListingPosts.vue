<template>
    <section class="mt-20">

        <h2 class="text-xl mb-10">
            <LinkArrow url="/informacie-ska">
                Informácie SKA
            </LinkArrow>
        </h2>

        <radio-button
            v-for="option in options"
            :key="option.key"
            :option="option"
            v-model="selectedOption"
        />

         <transition name="items-list" mode="out-in">
            <div
                v-for="option in options"
                v-if="displayOption.key === option.key"
                :key="option.key"
                class="mt-10"
            >
                <template v-if="posts.length > 0">
                    <div v-for="post in posts">
                        <TeaserSka :post="post" />
                    </div>
                </template>
                <p class="py-10" v-else>
                    Nenašli sa žiadne články.
                </p>
            </div>
         </transition>

        <LinkArrow url="/informacie-ska">
            Informácie SKA
        </LinkArrow>

    </section>
</template>

<script>
import LinkArrow from "./atoms/links/LinkArrow";
import TeaserSka from "./TeaserSka";
import RadioButton from "./atoms/RadioButton";

export default {
    components: {
        TeaserSka,
        LinkArrow,
        RadioButton,
    },
    data() {
        return {
            posts: [],
            selectedOption: this.options[0],
            displayOption: this.options[0]
        }
    },
    props: {
        options: {
            type: Array,
            default: () => [
                { key: 'newest', title: 'Najnovšie', params: '' },
                { key: 'important', title: 'Dôležité', params: '&featured' },
                { key: 'COVID-19', title: 'COVID-19', params: '&categories=COVID-19' },
            ]
        }
    },
    watch: {
        selectedOption: {
            immediate: true,
            async handler(newValue) {
                const response = await axios.get(`./api/posts?per_page=4${newValue.params}`)
                this.displayOption = newValue
                this.posts = response.data.data
            }
        }
    }
}
</script>
