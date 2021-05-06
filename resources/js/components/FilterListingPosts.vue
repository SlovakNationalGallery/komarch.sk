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

        <!-- <transition name="items-list" mode="out-in"> -->
            <div v-for="post in posts">
                <TeaserSka :post="post" />
            </div>
        <!-- </transition> -->

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
            selectedOption: this.options[0]
        }
    },
    created() {
        //
    },
    props: {
        options: {
            type: Array,
            default: () => [
                { key: 'newest', title: 'Najnovšie', params: '' },
                { key: 'important', title: 'Dôležité', params: '?featured' },
                { key: 'COVID-19', title: 'COVID-19', params: '?categories=COVID-19' },
            ]
        },
        skaInformation: {
            type: Array,
            default: () => [
                { filterTags: ['newest'],  hashTags: [{ title: 'Vzdelávanie', url: '#'}], date: '29. Januára 2021', title: 'Cena Miesa van der Rohe 2022 - nominovaní slovenskí architekti', url: '#' },
                { filterTags: ['newest'], hashTags: [{ title: 'Vzdelávanie', url: '#'}], date: '29. Januára 2021', title: 'Cena Miesa van der Rohe 2022 - nominovaní slovenskí architekti', url: '#' },
                { filterTags: ['newest'], hashTags: [{ title: 'Vzdelávanie', url: '#'}], date: '29. Júna 2021', title: 'Cena Miesa van der Rohe 2022 - nominovaní slovenskí architekti', url: '#' },
                { filterTags: ['important'], hashTags: [{ title: 'Vzdelávanie', url: '#'}], date: '29. Júna 2021', title: 'Cena Miesa van der Rohe 2022 - nominovaní slovenskí architekti', url: '#' },
                { filterTags: ['important'], hashTags: [{ title: 'Vzdelávanie', url: '#'}], date: '29. Júna 2021', title: 'Cena Miesa van der Rohe 2022 - nominovaní slovenskí architekti', url: '#' },
                { filterTags: ['COVID-19'], hashTags: [{ title: 'Vzdelávanie', url: '#'}], date: '29. Septembra 2021', title: 'Cena Miesa van der Rohe 2022 - nominovaní slovenskí architekti', url: '#' },
                { filterTags: ['COVID-19'], hashTags: [{ title: 'Vzdelávanie', url: '#'}], date: '29. Januára 2021', title: 'Cena Miesa van der Rohe 2022 - nominovaní slovenskí architekti', url: '#' },
                { filterTags: ['COVID-19'], hashTags: [{ title: 'Vzdelávanie', url: '#'}], date: '29. Januára 2021', title: 'Cena Miesa van der Rohe 2022 - nominovaní slovenskí architekti', url: '#' },
            ]
        }
    },
    watch: {
        selectedOption: {
            immediate: true,
            handler(newValue) {
                axios.get('./api/posts' + newValue.params)
                .then(response => this.posts = response.data.data);
            }
        }
    }
}
</script>
