<template>
  <div
    class="absolute right-1/2 bottom-1/2 transform translate-x-1/2 translate-y-1/2 loading dark:bg-slate-800"
  >
    <div
      class="ms-8 border-t-transparent border-solid animate-spin rounded-full border-indigo-400 border-6 h-14 w-14"
    ></div>
    <h1 class="text-indigo-400 mt-5 text-xl font-semibold">Loading ....</h1>
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