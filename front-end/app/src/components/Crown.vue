<template>
<svg :class='`crown child${num}`' version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="512px" height="512px" viewBox="0 0 512 512" xml:space="preserve">
  <g>
    <path class="st0" d="M479.422,438.355c19.516,0,32.578-13.859,32.578-30.969V160.184c0-12.531-6.594-23.828-16.688-28.609
      c-10.109-4.813-21.719-2.156-29.453,6.703l-52.016,59.625c-10.563,12.094-27.672,12.094-38.219,0L275.109,82.715
      c-10.547-12.094-27.672-12.094-38.219,0L136.375,197.902c-10.547,12.094-27.656,12.094-38.219,0l-52.016-59.625
      c-7.734-8.859-19.359-11.516-29.453-6.703C6.594,136.355,0,147.652,0,160.184v247.203c0,17.109,13.109,30.969,32.625,30.969
      H479.422z" ></path>
  </g>
</svg>
</template>
<style scoped>
  svg {
    margin-bottom: 2px;
  }
</style>
<script>
export default {
  name: 'Crown',
  props: ['num'],
}
</script>