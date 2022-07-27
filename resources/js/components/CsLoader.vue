<template>
	<div :class="[{'o-loader--full': this.full}, 'o-loader']">
		<img v-if="white" class="o-loader__image"  src="/assets/main/images/loader-white.svg" width="100" height="100" alt=""/>
		<img v-else class="o-loader__image" src="/assets/main/images/loader.svg" width="100" height="100" alt=""/>
	</div>
</template>

<script lang="ts">

export default {
	name: 'CsLoader',
	props: {
		full: { type: Boolean, default: false },
		white: { type: Boolean, default: false },
	}
};
</script>

<style lang="scss">
.o-loader {
	margin: 0 auto;

	&__image {
		max-width: 50%;
	}

	&--full {
		height: 100%;
		width: 100%;
		display: flex;
		justify-content: center;
		align-content: center;
	}
}
</style>
