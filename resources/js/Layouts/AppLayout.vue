<script setup>
defineProps({
  title: String
});

const showingNavigationDropdown = ref(false);

const switchToTeam = team => {
  Inertia.put(
    route("current-team.update"),
    {
      team_id: team.id
    },
    {
      preserveState: false
    }
  );
};

const logout = () => {
  Inertia.post(route("logout"));
};
</script>

<template>
  <div>
    <Head :title="title" />
    <div id="wrapper">
      <SidebarVue />
      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <TopbarVue />
        <!-- Main Content -->
        <div id="content">
          

          <slot />
          <!--<content/>-->
          
        </div>

        <FooterVue/> 
      </div>
     
    </div>
  </div>
</template>

<script>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import SidebarVue from "./Partials/Sidebar.vue";
import TopbarVue from "./Partials/Topbar.vue";
import FooterVue from "./Partials/Footer.vue";

export default {
  components: {
    SidebarVue,
    TopbarVue,
    FooterVue
  }
};
</script>