<template>
	<div class="teq-row max-w filters-container">
		<div class="col-10 offset-1">
			<!-- search bar -->
			<search-bar 
            :placeholder="textSearch" 
            @update-search="searchTest" 
            @update-filter="updateFilter" 
            :list="list" 
            :base-url-autocompletion="baseUrlAutocompletion" 
            @autocomplete-active="autcompleteActive" 
            :show-autocompletion="showAutocomplete"
            :text-no-completion="textNoCompletion"
            />
		</div>
	</div>
    
	<div class="teq-row max-w" v-if="!activeAutocomplete">
		<!-- number resultats -->
		<div class="d-flex align-center filters-inner col-12 col-lg-3 col-sm-6">
			<h3 class="txt-32 w-600 c-dark">{{ postTotal }} {{ results }}</h3>
		</div>

		<div class="filters col-12  col-lg-3 offset-lg-6 d-flex column row-lg  row-sm col-sm-6 justify-between" v-if="showFilter">
			<!-- filters -->
			<template v-for="(filters, key) in filters" :key="key">
				<div class="align-center custom-select txt-16 c-dark w-400" v-for="filter in filters">
					<filter-select :filter="filter" :keyValue="key" @update-filter="updateFilter" :reset-element="resetBool"></filter-select>
				</div>
			</template>
		</div>
	</div>
	<div class="teq-row max-w">
		<div class="col-12 justify-lg-end mt-2 mt-lg-0">
			<reset-button v-if="Object.keys(selectedFilter).length || Object.keys(selectedTaxo).length" @update-filter="updateFiltersSelected" @reset-filter="resetFilter" :textReste="textReste" />
		</div>
	</div>
	<div class="teq-row max-w" v-if="!activeAutocomplete">
		<div class="mt-5 container-result" v-if="list">
			<!-- list card -->
			<div class="items-list gap-32">
				<div  v-for="(item, key) in list" :key="key" class="item relative bg-c-grey-40">
					<div class="illust relative">
						<div class="tag absolute txt-12 w-400 c-dark" v-if="showTag">{{ item.type_content }}</div>
						<img :src="item.image" :alt="item.title" />
					</div>
					<div class="p-24 gap-8 d-flex column">
						<p class="txt-14 w-700 c-dark">{{ item.date_publication }}</p>
						<p class="txt-16 w-400 c-dark" v-html="item.title"></p>
					</div>
                    <a :href="item.link"  class="stretched-link" :title="item.title"/>
				</div>
                
			</div>
		</div>
		<div class="mt-4" v-else>
			<!-- no result -->
			<p class="col-12 txt-15 c-dark w-700">{{ textEmptyList }}</p>
		</div>
    </div>
    <div class="teq-row max-w" v-if="!activeAutocomplete">
		<div class="mt-4 ml-auto mr-auto" v-if="list && totalPages > 1 && testPagination">
			<!-- pagination -->
			<pagination :current-page="currentPage" :total-pages="totalPages" :range-size="1" @change-page="updateHandler" :prev-button="prevButton" :next-button="nextButton" />
		</div>
	</div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import SearchBar from "./SearchBar.vue";
import FilterSelect from "./FilterSelect.vue";
import { initFilters } from "../_utils/initFilters";
import pagination from "./Pagination.vue";
import resetButton from "./resetButton.vue";
import gsap from "gsap";
import axios from "axios";

// DATA
const page = ref(1);
const totalPages = ref(null);
const selectedFilter = ref({});
const selectedTaxo = ref({});
const list = ref([]);
const postTotal = ref("");
const apiUrl = ref("");
const searchWords = ref("");
const currentPage = ref(1);
const testPagination = ref(true);
const activeAutocomplete = ref(false)

let params = {};

const props = defineProps({
	textEmptyList: String,
	filters: [Array, Object],
	list2: [Array, Object],
	textSearch: String,
	results: String,
	baseUrl: String,
    baseUrlAutocompletion: String,
	prevButton: String,
	nextButton: String,
	showTag: Boolean,
	textReste: String,
	testMode: Boolean,
    showAutocomplete: Boolean,
    textNoCompletion: String,
    showFilter: Boolean
});

// MOUNTED
onMounted(() => {
	if (props.testMode) {
		updateFiltersSelected("", "");
	} else {
		list.value = updateFiltersSelected("", "");
	}
});

const autcompleteActive = (e) => {
    activeAutocomplete.value = e
}

// METHODS
const updateSearch = (words) => {
	searchWords.value = words;
};

const resetBool = ref(false);

const resetFilter = (value) => {
	resetBool.value = value;
};

const updateFilter = (value1, value2, value3) => {
	if (props.testMode) {
        if(value2 == '') {
            return
        }

		testPagination.value = false;
		let xx = [];
		list.value.forEach((element) => {
			if (element.type_content.toLowerCase() == value2) {
				xx.push(element);
			}
		});
		list.value = xx;
        postTotal.value = xx.length

		if (list.value.length === 0) {
			xx = [];
			props.list2.items.forEach((element) => {
				element.lists.forEach((item) => {
					xx.push(item);
				});
			});
			list.value = xx;
		}

		if (value2 == "desc") {
			list.value.sort(function (a, b) {
				return new Date(b.date_publication) - new Date(a.date_publication);
			});
		}
		if (value2 == "asc") {
			list.value.sort(function (a, b) {
				return new Date(a.date_publication) - new Date(b.date_publication);
			});
		}
	} else {
		updateFiltersSelected(value1, value2, value3);
	}
};

const searchTest = (value) => {
	if (props.testMode) {
		let xx = [];
		props.list2.items.forEach((element) => {
			element.lists.forEach((item) => {
				if (item.title.indexOf(value) >= 0) {
					xx.push(item);
				}
			});
		});
		list.value = xx;
		postTotal.value = xx.length;
		totalPages.value = 1;
	} else {
		updateSearch(value);
	}
};

const updateFiltersSelected = async (slug, value, type) => {
	const infos = initFilters(props.baseUrl, slug, value, type, selectedFilter.value, selectedTaxo.value);
	const url = searchWords.value ? infos.url + "&search_term=" + searchWords.value : infos.url;
	apiUrl.value = url;
	selectedFilter.value = infos.selectedFilter;
	selectedTaxo.value = infos.selectedTaxo;
	params.taxo = infos.selectedTaxo;

	if (props.testMode) {
		list.value = props.list2.items[0].lists;
		totalPages.value = props.list2.items[0].page_total;
		postTotal.value = props.list2.items[0].post_total;
		page.value = 1;
	} else {
		const data = await axios.get(url, { params: params });
		list.value = data.data.lists;
		totalPages.value = data.data.page_total;
		postTotal.value = data.data.post_total;
		page.value = 1;
	}
	gsap.to(".container-result", {
		alpha: 1,
		delay: 0.3,
		duration: 0.3,
	});
};
const updateHandler = async (page) => {
	if (props.testMode) {
		currentPage.value = props.list2.items[page - 1].page_current;
		list.value = props.list2.items[page - 1].lists;
		totalPages.value = props.list2.items[page - 1].page_total;
		postTotal.value = props.list2.items[page - 1].post_total;
	} else {
		const data = await axios.get(apiUrl.value + "&page=" + page, { params: params });
		currentPage.value = data.data.page_current;
		list.value = data.data.lists;
	}
};
</script>