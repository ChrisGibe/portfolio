<template>
    <button class="d-flex align-center txt-14 w-700 c-dark no-btn" @click="reset">
        {{ textReste }}
        <svg class="ml-1" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_3327_11179)">
                <path d="M0.833984 3.33337V8.33337H5.83398" stroke="#7F8789" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M19.166 16.6666V11.6666H14.166" stroke="#7F8789" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M17.0756 7.49998C16.653 6.30564 15.9347 5.23782 14.9878 4.39616C14.0408 3.55451 12.8961 2.96645 11.6604 2.68686C10.4247 2.40727 9.13835 2.44527 7.92132 2.79729C6.70429 3.14932 5.59627 3.80391 4.70065 4.69998L0.833984 8.33331M19.1673 11.6666L15.3007 15.3C14.405 16.1961 13.297 16.8506 12.08 17.2027C10.8629 17.5547 9.57657 17.5927 8.34089 17.3131C7.10521 17.0335 5.96048 16.4455 5.01354 15.6038C4.06659 14.7621 3.34829 13.6943 2.92565 12.5" stroke="#7F8789" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
            <defs>
                <clipPath id="clip0_3327_11179">
                    <rect width="20" height="20" fill="white"/>
                </clipPath>
            </defs>
        </svg>
    </button>

</template>

<script setup>
const emit = defineEmits(['update-filter', 'reset-filter']);
const props = defineProps({
    filter: [Array, Object],
    textReste: String
})
const reset =  async () => {
    emit('update-filter', '', '' ,'' );
    emit('reset-filter', true)
    let brandActive = document.querySelectorAll('.brand-filter-card.active')
        if(brandActive.length){
            brandActive[0].classList.remove('active')
        }

}
</script>
