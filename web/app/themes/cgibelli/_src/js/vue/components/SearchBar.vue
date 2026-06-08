<template>
	<div class="teq-row mb-8">
		<div class="col-12 input-svg relative">
			<input @keyup.enter="change" :placeholder="placeholder" class="width-100 custom_text txt-20 w-400 c-dark" @input="getSearchResultAutoComplete" />
			<svg @click="change" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle cx="8" cy="8" r="7" stroke="#0B0B0B" stroke-width="2" />
				<rect x="11.7988" y="13.0962" width="2" height="6" transform="rotate(-45 11.7988 13.0962)" fill="#0B0B0B" />
			</svg>
		</div>
	</div>
    <div class="col-12 d-flex column" v-if="showAutcomplete && showAutocompletion">
        <template v-if="resultAutcomplete && resultAutcomplete.length > 0">
            <a :href="item.link" v-for="(item, key) in resultAutcomplete" :key="key" class="txt-16 w-400 autocomplete" v-html="item.title" />
        </template>
        <template v-if=" resultAutcomplete && resultAutcomplete.length == 0">
            {{textNoCompletion}}
        </template>
    </div>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";


// PROPS
const props = defineProps({
	placeholder: String,
    list: [Array, Object],
    baseUrlAutocompletion: String,
    showAutocompletion:Boolean,
    textNoCompletion: String
});

// DATA
const query = ref('');
const resultAutcomplete = ref(null);
const showAutcomplete = ref(false);


const emit = defineEmits(['update-search', 'update-filter', 'autocomplete-active'])

// METHODS
const change = async (e) => {
	const words = encodeURI(e.target.value);
    query.value = words
    emit('update-search', words)
    emit('update-filter', '', '', '')
    showAutcomplete.value = false
    emit('autocomplete-active', false)
};

const getSearchResultAutoComplete = async (e) => {

    if(!props.showAutocompletion)return

    const words = e.target.value;
    query.value = words

    if(words.length === 0) {
        emit('autocomplete-active', false)
        showAutcomplete.value = false
    }

    if(words.length >= 3) {
        showAutcomplete.value = true
        const data = await axios.get(props.baseUrlAutocompletion + "&search_term=" + words);
        resultAutcomplete.value = data.data.lists
        emit('autocomplete-active', true)
    }
}

</script>

