<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";

defineProps({
  canResetPassword: Boolean,
  status: String
});

const form = useForm({
  email: "",
  password: "",
  remember: false
});

const submit = () => {
  form
    .transform(data => ({
      ...data,
      remember: form.remember ? "on" : ""
    }))
    .post(route("login"), {
      onFinish: () => form.reset("password")
    });
};
</script>



<template>
<div>
  <Head title="Log in" />

  <body class="bg-gradient-primary">
    <div class="container">
      <!-- Outer Row -->
      <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
          <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
              <!-- Nested Row within Card Body -->
              <div class="row">
                <div class="col-lg-6 d-none d-lg-block bg-login-image">
                  <img src="https://wallpapercave.com/wp/wp11009785.jpg" alt="Responsive image" />
                </div>
                <div class="col-lg-6">
                  <div class="p-5">
                    <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                    </div>
                    <form class="user" @submit.prevent="submit">
                      <div class="form-group">
                        <JetInput
                          id="email"
                          v-model="form.email"
                          type="email"
                          class="mt-1 block w-full form-control form-control-user"
                          placeholder="Enter Email Address..."
                          aria-describedby="emailHelp"
                          required
                          autofocus
                        />
                      </div>

                      <div class="form-group">
                        <JetInput
                          id="password"
                          v-model="form.password"
                          type="password"
                          placeholder="Password"
                          class="mt-1 block w-full form-control form-control-user"
                          required
                          autocomplete="current-password"
                        />
                      </div>
                      <div class="form-group">
                        <div class="custom-control custom-checkbox small">
                          <input type="checkbox" class="custom-control-input" id="customCheck" />
                          <label class="custom-control-label" for="customCheck">
                            Remember
                            Me
                          </label>
                        </div>
                      </div>

                      <button
                        class="btn btn-primary btn-user btn-block"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                      >Login</button>

                      <hr />
                      <a href="index.html" class="btn btn-google btn-user btn-block">
                        <i class="fab fa-google fa-fw"></i> Login with Google
                      </a>
                      <a href="index.html" class="btn btn-facebook btn-user btn-block">
                        <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                      </a>
                    </form>
                    <hr />
                    <div class="text-center">
                      <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="text-sm text-gray-600 hover:text-gray-900 small"
                      >Forgot Password?</Link>
                    </div>

                    <div class="text-center">
                      <Link
                        :href="route('register')"
                        class="text-sm text-gray-600 hover:text-gray-900 small"
                      >Create an Account!</Link>
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
