<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";

const form = useForm({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
  terms: false
});

const submit = () => {
  form.post(route("register"), {
    onFinish: () => form.reset("password", "password_confirmation")
  });
};
</script>

<template>
<div>
  <Head title="Register" />

  <body >
    <div class="container">
      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg-5 d-none d-lg-block ">
              <img src="https://galeriemagazine.com/wp-content/uploads/2021/02/RS_The-Colony-Hotel-017-e1612376516525.jpg" alt="Responsive image" />
            </div>
            <div class="col-lg-7">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                </div>
                <form class="user" @submit.prevent="submit">
                  <div class="form-group">
                    <JetInput
                      id="name"
                      v-model="form.name"
                      type="text"
                      class="form-control form-control-user"
                      placeholder="Name"
                      required
                      autofocus
                      autocomplete="name"
                    />
                  </div>
                  <div class="form-group">
                    <JetInput
                      placeholder="Email Address"
                      id="email"
                      v-model="form.email"
                      type="email"
                      class="form-control form-control-user"
                      required
                    />
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <JetInput
                        id="password"
                        v-model="form.password"
                        type="password"
                        class="form-control form-control-user"
                        required
                        autocomplete="new-password"
                        placeholder="Password"
                      />
                    </div>
                    <div class="col-sm-6">
                      <JetInput
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        type="password"
                        class="form-control form-control-user"
                        required
                        autocomplete="new-password"
                        placeholder="Repeat Password"
                      />
                    </div>
                  </div>
                  <button
                    class="btn btn-primary btn-user btn-block"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                  >Register Account</button>
                  <hr />
                  <a href="index.html" class="btn btn-google btn-user btn-block">
                    <i class="fab fa-google fa-fw"></i> Register with Google
                  </a>
                  <a href="index.html" class="btn btn-facebook btn-user btn-block">
                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                  </a>
                </form>
                <hr />
                <div class="text-center">
                  <Link
                    :href="route('password.request')"
                    class="text-sm text-gray-600 hover:text-gray-900 small"
                  >Forgot Password?</Link>
                </div>

                <div class="text-center">
                  <Link
                    :href="route('login')"
                    class="text-sm text-gray-600 hover:text-gray-900 small"
                  >Already have an account? Login!</Link>
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
