<template>
  <AppLayoutVue>
    <div class="cards p-3 py-4 cards_custom">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Booking Rooms</h2>
      <br />

      <ul class="nav nav-tabs">
        <!-- <li class="active nav-item"><a data-toggle="tab" href="#home">Home</a></li> -->
        <li>
          <a data-toggle="tab" class="nav-link active" href="#menu1">Available Rooms</a>
        </li>
        <li>
          <a data-toggle="tab" class="nav-link" href="#menu2">Reserved Rooms</a>
        </li>
      </ul>
      <br />
      <div class="tab-content">

        <!--menu1-->
        <div id="menu1" class="tab-pane fade active show in">
          <br />
          <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Room Number</th>
                <th>Price</th>
                <th>Assign Customers Booking</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="room in availablerooms" :key="room.id">
                <td>{{room.number}}</td>
                <td>Rs {{room.price}}/=</td>
                <td>
                  <button
                    type="button"
                    class="btn btn-success "
                    data-toggle="modal"
                    data-target="#BookingModal"
                    style="margin-right:4px ;background-color: white;"
                    @click.prevent="getRoom(room)"
                  >
                    <i  style="color: green;">Add Customer</i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>

          <!-- Modal add booking -->
          <div
            class="modal fade"
            id="BookingModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true"
          >
            <div class="modal-dialog modal-dialog-centered" role="document" @close="closeModal">
              <div class="modal-content">
                <form @submit.prevent="submit">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Assign Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <JetInput
                          id="name"
                          v-model="addBookingform.name"
                          type="text"
                          class="form-control form-control-user"
                          placeholder="Customer Name"
                          required
                        />
                      </div>
                      <div class="col-sm-6">
                        <JetInput
                          id="noOfMembers"
                          v-model="addBookingform.noOfMembers"
                          type="number"
                          class="form-control form-control-user"
                          placeholder="Number Of Member"
                          required
                        /> 
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <JetInput
                          id="mobile"
                          v-model="addBookingform.mobile"
                          type="text"
                          class="form-control form-control-user"
                          placeholder="Mobile"
                          required
                        />
                      </div>
                      <div class="col-sm-6">
                        <JetInput
                          id="nic"
                          v-model="addBookingform.nic"
                          type="text"
                          class="form-control form-control-user"
                          placeholder="NIC"
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
                      :class="{ 'opacity-25': addBookingform.processing }"
                      :disabled="addBookingform.processing"
                    >Save</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- /Modal add booking -->
        </div>
        <!--menu1 end-->

        <!--menu2-->
        <div id="menu2" class="tab-pane fade">
          <br />
          <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Room Number</th>
                <th>Price</th>
                <th>Customer Name</th>
                <th>Booking Date</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>
              <tr v-for="room in bookedrooms" :key="room.id">
                <td>{{room.number}}</td>
                <td>Rs {{room.price}}/=</td>
                <td>{{room.customer}}</td>
                <td>{{room.createddate}}</td>
                <td>
                  <button
                    type="button"
                    class="btn btn-success"
                    style="margin-right:4px ;background-color: white;"
                    @click.prevent="moveToUse(room.id)"
                  >
                    <i  style="color: green">Start Using </i>
                  </button>
                  <button
                    type="button"
                    class="btn btn-danger "
                    style="background-color: white"
                    @click.prevent="removeBooking(room.id)"
                  >
                    <i  style="color: red">Release</i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!--menu2 end-->
      </div>
    </div>
  </AppLayoutVue>
</template>

<script>
import AppLayoutVue from "../../../Layouts/AppLayout.vue";
import { Inertia } from "@inertiajs/inertia";
import route from "../../../../../vendor/tightenco/ziggy/src/js";
import JetInput from "@/Jetstream/Input.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import Swal from "sweetalert2/dist/sweetalert2.js";

AppLayoutVue;
export default {
  components: {
    AppLayoutVue,
    JetInput
  },
  props: {
    name: String,
    rooms: Object,
    availablerooms: Object,
    bookedrooms: Object
  },
  data() {
    return {
      addBookingform: useForm({
        roomid: "",
        name: "",
        noOfMembers: "",
        mobile: "",
        nic : "",

      })
    };
  },
  mounted() {
    let self = this;

    $(document).ready(function() {
      var table = $("#dataTable1").DataTable({});
      table.ajax.reload();
    });

    $(document).ready(function() {
      var table = $("#dataTable2").DataTable({});
      table.ajax.reload();
    });
  },

  methods: {
    getRoom(room) {
      console.log(room);
      this.addBookingform.roomid = room.id;
    },
    submit() {
      const modalToggle = document.getElementById("toggleMyModal");
      console.log(this.addBookingform);
      this.addBookingform.post(route("bokking.store"), {
        onSuccess: () => {
          this.addBookingform.reset();
          Swal.fire({
            position: "top-scroll-to-top",
            icon: "success",
            title: "Room has been Booked ",
            showConfirmButton: false,
            timer: 1500
          });
        },
        onError: () => {
          Swal.fire({
            position: "top-scroll-to-top",
            icon: "error",
            title: "error while booking",
            showConfirmButton: false,
            timer: 1500
          });
        },
        onFinish: () => {
          const modalToggle = document.getElementById("BookingModal");
          $("#BookingModal").modal("hide");
        }
      });
    },

    moveToUse(id) {
      try {
        
        Inertia.post(route("bokking.movetouse", { id: id }));
        Swal.fire({
          position: "top-scroll-to-top",
          icon: "success",
          title: "Room has been moved to Used",
          showConfirmButton: false,
          timer: 1500
        });
      } catch (err) {
        Swal.fire({
          position: "top-scroll-to-top",
          icon: "error",
          title: "error while moved",
          showConfirmButton: false,
          timer: 1500
        });
      }
    },
    removeBooking(id) {
      try {
        
        Inertia.post(route("bokking.destroy", { id: id }));
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
          title: "error while removing",
          showConfirmButton: false,
          timer: 1500
        });
      }
    },
  }
};
</script>

<style>
.cards_custom {
  color: rgb(8, 8, 8);
  max-width: 1250px;
  min-height: 530px;
  border-radius: 10px;
  background: linear-gradient(145deg, #ffffff, #ececec);
  box-shadow: 20px 20px 60px #ffffff00;
  margin: 0px 10px 0px 20px;
}
</style>