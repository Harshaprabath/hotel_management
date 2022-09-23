
<template>
  <AppLayout title="Profile">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Profile</h2>
    </template>

    <div class="container d-flex justify-content-center">
      <div class="cards p-3 py-4">
        <div class="text-center">
          <img
            src="https://www.man-shop.eu/media/image/19/07/c7/HerrenBz6datKT7kMmG.png"
            width="100"
            class="rounded-circle img_custom"
          />
          <h3 class="mt-2">{{ $page.props.user.name }}</h3>
          <span class="mt-1 clearfix">Maneger</span>

          <div class="row mt-3 mb-3 inf">
            <div class="col-md-12">
              <h5>Email</h5>
              <span class="num">{{ $page.props.user.email }}</span>
            </div>
          </div>

          <hr class="line" />

          <small class="mt-4">I am an android developer working at google Inc at california,USA</small>
          <div class="social-buttons mt-5">
            <button class="neo-button">
              <i class="fa fa-facebook fa-1x"></i>
            </button>
            <button class="neo-button">
              <i class="fa fa-linkedin fa-1x"></i>
            </button>
            <button class="neo-button">
              <i class="fa fa-google fa-1x"></i>
            </button>
            <button class="neo-button">
              <i class="fa fa-youtube fa-1x"></i>
            </button>
            <button class="neo-button">
              <i class="fa fa-twitter fa-1x"></i>
            </button>
          </div>

          <div class="profile mt-5">
            <button class="profile_button px-5" @click.prevent="route_setings()">Settings</button>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout.vue";
import { Inertia } from '@inertiajs/inertia';

export default {
  components: {
    AppLayout
  },
  methods: {
    route_setings() {
        Inertia.visit(route('profile.show'));
    }
  }
};
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Noto Sans", sans-serif;
}

html,
body {
  height: 100%;
}

.cards {
  color: rgb(8, 8, 8);
  width: 1200px;
  height: 600px;
  border-radius: 10px;
  background: linear-gradient(145deg, #f3ecf2, #0505054b);
  box-shadow: 20px 20px 60px #0000004d;
  border: none;
}

.neo-button {
  width: 50px;
  height: 50px;
  outline: 0 !important;
  cursor: pointer;
  color: #fff;
  font-size: 20px;
  border: none;
  margin-right: 10px;
  border-radius: 50%;
  background: linear-gradient(145deg, #f7f7f700, #f7f7f7);
  box-shadow: inset 20px 20px 60px #f5f5f500, inset -20px -20px 60px #efeef000;
}

.num {
  color: rgb(3, 3, 3) !important;
}

.line {
  color: #fff;
}

.neo-button:active {
  border-radius: 50%;
  background: #ffffff;
  box-shadow: 1px 1px 57px #ffffff80;
}

.fa-facebook {
  color: #3b5998;
}

.fa-linkedin {
  color: #0077b5;
}

.fa-google {
  color: #dc4e41;
}

.fa-youtube {
  color: #cd201f;
}

.fa-twitter {
  color: #55acee;
}

.profile_button {
  color: rgb(255, 255, 255);
  padding: 10px;
  border: none;
  outline: 0 !important;
  border-radius: 50px;
  background: #732d8d;
}

.profile_button:active {
  background: #521768;
  box-shadow: 1px 1px 57px #52176886;
}

/* img,
video {
  max-width: 100%;
  height: 95px;
} */

.img_custom {
  max-width: 100%;
  height: 95px;
  display: block;
  margin-left: auto;
  margin-right: auto;
}

.inf {
  color: rgb(0, 0, 0);
  padding: 10px;
  border: none;
  outline: 0 !important;
  border-radius: 50px;
  background: #03030331;
}
</style>