<template>
	<div class="select">
		<select :data-type="keyValue" :id="filter.slug" @input="change" :ref="filter.slug" v-model="selectedOption" >
			<option value="" selected><span v-html="filter['name']"></span></option>
			<option v-for="(f, index) in filter.list" :value="f.slug" :key="index" v-html="f.name"></option>
		</select>
	</div>
</template>

<script setup>
import { ref, watch } from 'vue';

const selectedOption = ref('');
const props = defineProps({
    filter: [Array, Object],
    keyValue: String,
    resetElement: Boolean
})

const emit = defineEmits(['update-filter']);

watch(() => props.resetElement, (newValue) => {
    if(newValue === true) {
        reset()
    }
})

const change = (e) => {
    let type = ""
    if(e.target.dataset.type){
        type = e.target.dataset.type;
    } 
    emit('update-filter', e.target.id, e.target.value, type)
   
}

const reset = () => {
    selectedOption.value = ''
}

const decoder = (str) => {
    var textArea = document.createElement('textarea');
    textArea.innerHTML = str;
    return textArea.value;
}
</script>

