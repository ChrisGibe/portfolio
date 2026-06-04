<template>
	<div class="d-flex ">
		<button class="previous pagination txt-16 w-400 c-dark mr-4" @click="gotoPrev" :class="{ 'disabled': currentPage == 1 }">{{prevButton}}</button>
		<button v-for="page in listPages" :key="page" class="pagination ml-1 txt-16 w-400 c-dark" :class="{ active: page == currentPage, 'd-none': isMobile && currentPage !== page }" @click="goPage(page)">
			<div v-if="page == null">•••</div>

			{{ page }}
		</button>
		<button class="next pagination txt-16 w-400 c-dark ml-4" @click="goToNext" :class="{ 'disabled': currentPage == totalPages }">{{nextButton}}</button>
	</div>
</template>

<script setup>
import { computed } from "vue";
const emit = defineEmits(['change-page'])
const props = defineProps({
    currentPage: Number,
    totalPages: Number,
    rangeSize: Number, // number element before ...
    nextButton: {
        type: String,
        default: '>'
    },
    prevButton: {
        type: String,
        default: '<'
    }
})

// COMPUTED
const isMobile = computed(() => {
    if (
        /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
            navigator.userAgent
        )
    ) {
        return true;
    } else {
        return;
    }
})

// Pagination list  and …
const listPages = computed(() => {
	const res = [];
	const minPaginationElems = 5 + props.rangeSize * 2;
	let rangeStart = props.totalPages <= minPaginationElems ? props.rangeSize : props.currentPage - props.rangeSize;
	let rangeEnd = props.totalPages <= minPaginationElems ? props.totalPages : props.currentPage + props.rangeSize;
	rangeEnd = rangeEnd > props.totalPages ? props.totalPages : rangeEnd;
	rangeStart = rangeStart < 1 ? 1 : rangeStart;

	if (props.totalPages > minPaginationElems) {
		const isStartBoundaryReached = rangeStart - 1 < 3;
		const isEndBoundaryReached = props.totalPages - rangeEnd < 3;

		if (isStartBoundaryReached) {
			rangeEnd = minPaginationElems - 2;
			for (let i = 1; i < rangeStart; i++) {
				res.push(i);
			}
		} else {
			res.push(1);
			res.push(null);
		}
		if (isEndBoundaryReached) {
			rangeStart = props.totalPages - (minPaginationElems - 3);
			for (let i = rangeStart; i <= props.totalPages; i++) {
				res.push(i);
			}
		} else {
			for (let i = rangeStart; i <= rangeEnd; i++) {
				res.push(i);
			}
			res.push(null);
			res.push(props.totalPages);
		}
	} else {
		for (let i = rangeStart; i <= rangeEnd; i++) {
			res.push(i);
		}
	}
	return res;
});

// METHODS
const goPage = (value) => {
    emit('change-page', value)
}
const goToNext = () => {
    emit('change-page', props.currentPage + 1)
};
const gotoPrev = () => {
    emit('change-page', props.currentPage - 1)
};

</script>