<template>
    <div>
      <!-- Modal -->
      <div
        class="modal fade"
        id="EditModalCenter"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true"
      >
     
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <form @submit.prevent="submit">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Room</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <JetInput
                      id="number"
                      v-model="form.number"
                      type="text"
                      class="form-control form-control-user"
                      placeholder="Room Number"
                      required
                    />
                    <!-- <p>{{room.id}}</p>  -->
                  </div>
                  <div class="col-sm-6">
                    <JetInput
                      id="price"
                      v-model="form.price"
                      type="text"
                      class="form-control form-control-user"
                      placeholder="Room Price"
                      required
                    />
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button
                  class="btn btn-primary"
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                >Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      
      <!-- /Modal -->
    </div>
  </template>
  
  <script>
  import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
  import JetInput from "@/Jetstream/Input.vue";

  
  
  export default {
    components: {
      Link,
      JetInput
    },
    props: {
      name: String,
      room: Object,
      rm: Object,
    },
    data() {
      return {
        form: useForm({
          number: "A120",
          price: 50000
        })
      };
    },
    mounted() {
      let self = this;
    },
    methods: {
      submit() {
       
        this.form.post(route("rooms.store"), {
  
        });
      }
    }
  };
  </script>
  
  <style>
  </style>