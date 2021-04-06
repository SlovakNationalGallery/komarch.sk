<template>
    <FilterListing
        :options="options"
        :items="skaInformation"
    >
        <template v-slot:before-list>
            <h2 class="text-xl mb-10">
                Informácie SKA
            </h2>
        </template>
        <template v-slot:list-item="{ item }">
            <TeaserSka :ska-information="item" />
        </template>
        <template v-slot:after-list>
            <link-arrow url="/informacie-ska">
                Informácie SKA
            </link-arrow>
        </template>
    </FilterListing>
</template>

<script>
import LinkArrow from "./atoms/LinkArrow"
import FilterListing from "./FilterListing";
import TeaserSka from "./TeaserSka";

export default {
    components: {
        TeaserSka,
        FilterListing,
        LinkArrow,
    },
    props: {
        options: {
            type: Array,
            default: () => [
                { key: 'newest', title: 'Najnovšie' },
                { key: 'important', title: 'Dôležité' },
                { key: 'COVID-19', title: 'COVID-19' },
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
    }
}
</script>
