<template>
  <div
    class="absolute right-1/2 bottom-1/2 transform translate-x-1/2 translate-y-1/2 loading dark:bg-slate-800"
  >
    <div
      class="ms-8 border-t-transparent border-solid animate-spin rounded-full border-blue-600 border-6 h-24 w-24"
    ></div>
</div>
</template>
<style scoped>
.loading {
  height: 100vh;
  width: 100vw;
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>