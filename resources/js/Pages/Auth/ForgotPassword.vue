<script setup>
import { Head, useForm } from "@inertiajs/inertia-vue3";
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";

defineProps({
  status: String
});

const form = useForm({
  email: ""
});

const submit = () => {
  form.post(route("password.email"));
};
</script>

<template>
<div>
  <Head title="Forgot Password" />

  <body>
    <div class="container">
      <!-- Outer Row -->
      <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
          <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
              <!-- Nested Row within Card Body -->
              <div class="row">
                <div class="col-lg-6 d-none d-lg-block">
                  <img
                    src="https://hips.hearstapps.com/toc.h-cdn.co/assets/16/34/768x768/square-1472138296-beverly-hills-hotel.JPG?resize=640:*"
                    alt="Responsive image"
                  />
                </div>
                <div class="col-lg-6">
                  <div class="p-5">
                    <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                      <p class="mb-4">
                        We get it, stuff happens. Just enter your email address below
                        and we'll send you a link to reset your password!
                      </p>
                    </div>
                    <form class="user" @submit.prevent="submit">
                      <div class="form-group">
                        <JetInput
                          id="email"
                          v-model="form.email"
                          type="email"
                          class="form-control form-control-user"
                          aria-describedby="emailHelp"
                          placeholder="Enter Email Address..."
                          required
                          autofocus
                        />
                      </div>

                      <button
                        class="btn btn-primary btn-user btn-block"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                      >Email Password Reset Link</button>
                    </form>
                    <hr />
                    <div class="text-center">
                      <Link :href="route('register')" class="small">Create an Account!</Link>
                    </div>
                    <div class="text-center">
                      <Link :href="route('login')" class="small">Already have an account? Login!</Link>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</div>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: {
    Link
  }
};
</script>
