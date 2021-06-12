<template>
  <div id="Myapp">
      <div>
      <transition name="fade" mode="out-in">
          <router-view></router-view>
      </transition>
      </div>
  </div>
</template>
