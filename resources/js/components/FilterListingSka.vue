<template>
    <FilterListing
        :options="options"
        :items="tenders"
    >
        <template v-slot:before-list>
            <h2 class="text-xl mb-10">
                Informácie SKA
            </h2>
        </template>
        <template v-slot:list-item="{ item }">
            <TeaserTender :tender="item" />
        </template>
        <template v-slot:after-list>
            <link-arrow url="/informacie-ska">
                Informácie SKA
            </link-arrow>
        </template>
    </FilterListing>
</template>

<script>
import TeaserTender from "./TeaserTender"
import LinkArrow from "./atoms/LinkArrow"
import FilterListing from "./FilterListing";

export default {
    components: {
        FilterListing,
        LinkArrow,
        TeaserTender
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
        tenders: {
            type: Array,
            default: () => [
                { key: 'newest',  date: '11. 2. 2021 – 10. 12. 2020', days: '3 dni', title: 'Výsledky krajinársko-urbanistickej súťaže Revitalizácia Mlynského náhonu', url: '#' },
                { key: 'newest',  date: '12. 1. 2021 – 10. 12. 2020', days: '3 dni', title: 'Výsledky krajinársko-urbanistickej súťaže Revitalizácia Mlynského náhonu', url: '#' },
                { key: 'newest',  date: '13. 1. 2021 – 10. 12. 2020', days: '3 dni', title: 'Výsledky krajinársko-urbanistickej súťaže Revitalizácia Mlynského náhonu', url: '#' },
                { key: 'newest',  date: '14. 1. 2021 – 10. 12. 2020', days: '3 dni', title: 'Výsledky krajinársko-urbanistickej súťaže Revitalizácia Mlynského náhonu', url: '#' },
                { key: 'important',  date: '15. 1. 2021 – 10. 12. 2020', days: '3 dni', title: 'Výsledky krajinársko-urbanistickej súťaže Revitalizácia Mlynského náhonu', url: '#' },
                { key: 'important',  date: '16. 1. 2021 – 10. 12. 2020', days: '3 dni', title: 'Výsledky krajinársko-urbanistickej súťaže Revitalizácia Mlynského náhonu', url: '#' },
                { key: 'important',  date: '17. 1. 2021 – 10. 12. 2020', days: '3 dni', title: 'Výsledky krajinársko-urbanistickej súťaže Revitalizácia Mlynského náhonu', url: '#' },
                { key: 'important',  date: '18. 1. 2021 – 10. 12. 2020', days: '3 dni', title: 'Výsledky krajinársko-urbanistickej súťaže Revitalizácia Mlynského náhonu', url: '#' },
                { key: 'COVID-19',  date: '19. 1. 2021 – 10. 12. 2020', days: '3 dni', title: 'Výsledky krajinársko-urbanistickej súťaže Revitalizácia Mlynského náhonu', url: '#' },
                { key: 'COVID-19',  date: '20. 1. 2021 – 10. 12. 2020', days: '3 dni', title: 'Výsledky krajinársko-urbanistickej súťaže Revitalizácia Mlynského náhonu', url: '#' },
            ]
        }
    }
}
</script>
