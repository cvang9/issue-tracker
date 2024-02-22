<template>

  <div class="login-box">
    <div class="login-box-formbox">
      
      <div >
        <div class="alternate-text" style="color: black;">Login as</div>
        <div class="alternate-boxes">

          <div class="alternate-box" >
            <router-link to="/login?role=user"> <h3>User</h3> </router-link>
          </div>

          <div class="alternate-box" >
            <router-link to="/login?role=resolver"> <h3>Resolver</h3> </router-link>
          </div>

          <div class="alternate-box">
            <router-link to="/login?role=admin"> <h3>Admin</h3> </router-link>
          </div>
          
        </div>
      </div>
    </div>
  </div>
    
</template>

<style scoped>

a {
    text-decoration: none;
    color: #0f1396;
}
</style>