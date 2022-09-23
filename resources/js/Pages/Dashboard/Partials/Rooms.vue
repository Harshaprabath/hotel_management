<!-- Page level custom scripts -->

<template>
<AppLayoutVue title="Room">
  <template #header>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Rooms</h2>
  </template>

  <body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
          <!-- Begin Page Content -->
          <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Rooms</h6>
                <div class="col-md-12 bg-light text-right">
                  <button
                    type="button"
                    class="btn btn-success btn-circle"
                    style="margin-right:4px ;background-color: white;"
                    data-toggle="modal"
                    data-target="#exampleModalCenter"
                  >
                    <i class="fas fa-plus-circle" style="font-size:42px;color:#602281"></i>
                  </button>
                </div>
              </div>
              <!-- <h1 v-for="room in rooms" :key="room.id">Hello {{room.id}}</h1> -->
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Room Number</th>
                        <th>Price</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr v-for="room in rooms" :key="room.id">
                        <td>{{room.number}}</td>
                        <td>Rs {{room.price}}/=</td>
                        <td class="date">{{room.created_at}}</td>
                        <td>{{room.updated_at}}</td>
                        <td>
                          <button
                            type="button"
                            class="btn btn-success btn-circle"
                            data-toggle="modal"
                            data-target="#EditModalCenter"
                            style="margin-right:4px ;background-color: white;"
                            @click.prevent="getRoom(room)"
                          >
                            <i class="fas fa-pencil-alt" style="color: green"></i>
                          </button>
                          <button
                            type="button"
                            class="btn btn-danger btn-circle"
                            style="background-color: white"
                            @click.prevent="destroy(room.id)"
                          >
                            <i class="fas fa-trash" style="color: red"></i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <RoomModalVue />
        <!-- RoomEditModal -->

        <!-- Modal -->
        <div
          class="modal fade"
          id="EditModalCenter"
          tabindex="-1"
          role="dialog"
          aria-labelledby="exampleModalCenterTitle"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-dialog-centered" role="document" @close="closeModal">
            <div class="modal-content">
              <form @submit.prevent="submit">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Edit Room</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <JetInput
                        id="number"
                        v-model="form.id"
                        type="hidden"
                        class="form-control form-control-user"
                        placeholder="Room Number"
                        required
                      />
                      <JetInput
                        id="number"
                        v-model="form.number"
                        type="text"
                        class="form-control form-control-user"
                        placeholder="Room Number"
                        required
                      />
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
                  <!-- <p>{{rm}}</p> -->
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

        <!-- RoomEditModal/ -->
      </div>
      <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>
  </body>
</AppLayoutVue>
</template>

<script>
import AppLayoutVue from "../../../Layouts/AppLayout.vue";
import RoomModalVue from "./Modal/RoomModal.vue";
import { Inertia } from "@inertiajs/inertia";
import route from "../../../../../vendor/tightenco/ziggy/src/js";
import RoomEditModalVue from "./Modal/RoomEditModal.vue";
import JetInput from "@/Jetstream/Input.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import Swal from "sweetalert2/dist/sweetalert2.js";

export default {
  components: {
    AppLayoutVue,
    RoomModalVue,
    RoomEditModalVue,
    JetInput
  },
  props: {
    name: String,
    rooms: Object,
    rm: Object
  },

  data() {
    return {
      form: useForm({
        id: 0,
        number: "",
        price: ""
      })
    };
  },
  mounted() {
    let self = this;
  },

  methods: {
    submit() {
      const modalToggle = document.getElementById("toggleMyModal");
      console.log(this.form);
      this.form.put(route("rooms.update"), {
        onSuccess: () => {
          Swal.fire({
            position: "top-scroll-to-top",
            icon: "success",
            title: "Your room has been Edited",
            showConfirmButton: false,
            timer: 1500
          });
        },
        onError: () => {
          Swal.fire({
            position: "top-scroll-to-top",
            icon: "error",
            title: "error while editing",
            showConfirmButton: false,
            timer: 1500
          });
        },
        onFinish: () => {
          const modalToggle = document.getElementById("EditModalCenter");
          $("#EditModalCenter").modal("hide");
        }
      });
    },

    destroy(id) {
      try {
        Inertia.post(route("rooms.destroy", { id: id }));
        Swal.fire({
          position: "top-scroll-to-top",
          icon: "success",
          title: "Your room has been Removed",
          showConfirmButton: false,
          timer: 1500
        });
      } catch (err) {
        Swal.fire({
          position: "top-scroll-to-top",
          icon: "error",
          title: "error while editing",
          showConfirmButton: false,
          timer: 1500
        });
      }
    },

    getRoom(room) {
      console.log(room);
      this.form.id = room.id;
      this.form.number = room.number;
      this.form.price = room.price;
    }
  }
};
</script>

<style>
</style>