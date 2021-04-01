<template>
    <FilterListing
        :options="options"
        :items="tenders"
    >
        <template v-slot:before-list>
            <h2 class="text-xl mb-10">
                Súťaže
            </h2>
        </template>
        <template v-slot:list-item="{ item }">
            <TeaserTender :tender="item" />
        </template>
        <template v-slot:after-list>
            <link-arrow url="/sutaze">
                Viac súťaží
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
                { key: 'running', title: 'Prebiehajúce' },
                { key: 'prepared', title: 'Pripravované' },
                { key: 'closed', title: 'Ukončené' },
            ]
        },
        tenders: {
            type: Array,
            default: () => [
                { filterTags: ['running'],  date: '11. 2. 2021 – 10. 12. 2020', days: '3 dni', title: 'Výsledky krajinársko-urbanistickej súťaže Revitalizácia Mlynského náhonu', url: '#' },
                { filterTags: ['running'],  date: '12. 1. 2021 – 10. 12. 2020', days: '3 dni', title: 'Výsledky krajinársko-urbanistickej súťaže Revitalizácia Mlynského náhonu', url: '#' },
                { filterTags: ['running'],  date: '13. 1. 2021 – 10. 12. 2020', days: '3 dni', title: 'Výsledky krajinársko-urbanistickej súťaže Revitalizácia Mlynského náhonu', url: '#' },
                { filterTags: ['prepared'],  date: '14. 1. 2021 – 10. 12. 2020', days: '3 dni', title: 'Výsledky krajinársko-urbanistickej súťaže Revitalizácia Mlynského náhonu', url: '#' },
                { filterTags: ['prepared'],  date: '15. 1. 2021 – 10. 12. 2020', days: '3 dni', title: 'Výsledky krajinársko-urbanistickej súťaže Revitalizácia Mlynského náhonu', url: '#' },
                { filterTags: ['prepared'],  date: '17. 1. 2021 – 10. 12. 2020', days: '3 dni', title: 'Výsledky krajinársko-urbanistickej súťaže Revitalizácia Mlynského náhonu', url: '#' },
                { filterTags: ['prepared'],  date: '18. 1. 2021 – 10. 12. 2020', days: '3 dni', title: 'Výsledky krajinársko-urbanistickej súťaže Revitalizácia Mlynského náhonu', url: '#' },
                { filterTags: ['closed'],  date: '19. 1. 2021 – 10. 12. 2020', days: '3 dni', title: 'Výsledky krajinársko-urbanistickej súťaže Revitalizácia Mlynského náhonu', url: '#' },
                { filterTags: ['closed'],  date: '20. 1. 2021 – 10. 12. 2020', days: '3 dni', title: 'Výsledky krajinársko-urbanistickej súťaže Revitalizácia Mlynského náhonu', url: '#' },
            ]
        }
    }
}
</script>
