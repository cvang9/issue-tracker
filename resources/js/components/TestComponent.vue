<template>
    <header id="header-wrap" class="relative">
      <!-- Navbar Start -->      
      <div class="navigation fixed top-0 left-0 w-full z-30 duration-300">
          <div class="container">
              <nav class="navbar py-2 navbar-expand-lg flex justify-between items-center relative duration-300">
                  <a class="navbar-brand" href="index.html">
                    <img src="./assets/img/logo.svg" alt="Logo">
                  </a>
                  <button class="navbar-toggler focus:outline-none block lg:hidden" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="toggler-icon"></span>
                      <span class="toggler-icon"></span>
                      <span class="toggler-icon"></span>
                  </button>

                  <div class="collapse navbar-collapse hidden lg:block duration-300 shadow absolute top-100 left-0 mt-full bg-white z-20 px-5 py-3 w-full lg:static lg:bg-transparent lg:shadow-none" id="navbarSupportedContent">
                      <ul class="navbar-nav mr-auto justify-center items-center lg:flex">
                          <li class="nav-item">
                            <a class="page-scroll active" href="#hero-area">Home</a>
                          </li>
                          <li class="nav-item">
                            <a class="page-scroll" href="#services">Services</a>
                          </li>
                          <li class="nav-item">
                            <a class="page-scroll" href="#feature">feature</a>
                          </li>
                          <li class="nav-item">
                            <a class="page-scroll" href="#team">Team</a>
                          </li>
                          <li class="nav-item">
                            <a class="page-scroll" href="#testimonial">Testimonial</a>
                          </li>
                          <li class="nav-item">
                            <a class="page-scroll" href="#pricing">Pricing</a>
                          </li>
                          <li class="nav-item">
                            <a class="page-scroll" href="#contact">Contact</a>
                          </li>
                      </ul>
                  </div>
                  <div class="header-btn hidden sm:block sm:absolute sm:right-0 sm:mr-16 lg:static lg:mr-0">
                    <a class="text-blue-600 border border-blue-600 px-10 py-3 rounded-full duration-300 hover:bg-blue-600 hover:text-white" href="#feature">FAQ</a>
                  </div>
              </nav>
          </div>
      </div>
      <!-- Navbar End -->
    </header>
    <!-- Header Area wrapper End -->

    <!-- Hero Area Start -->
    <section id="hero-area" class="bg-blue-100 pt-48 pb-10">
      <div class="container">
        <div class="flex justify-between">
          <div class="w-full text-center">
            <h2 class="text-4xl font-bold leading-snug text-gray-700 mb-10 wow fadeInUp" data-wow-delay="1s">Startup and SaaS Landing Page
              <br class="hidden lg:block"> Built with TailwindCSS</h2>
            <div class="text-center mb-10 wow fadeInUp" data-wow-delay="1.2s">
              <a href="#"
                rel="nofollow"
                class="btn">Download Now</a>
            </div>
            <div class="text-center wow fadeInUp" data-wow-delay="1.6s">
              <img class="img-fluid mx-auto" src="./assets/img/hero.svg" alt="">
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Hero Area End -->
</template>

<style scoped>


</style>