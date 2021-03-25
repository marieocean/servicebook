<!DOCTYPE html>
<html>
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Booking management</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <link rel="stylesheet" href="src//css/style.css">
 </head>
 <body>
  <div class="container" id="vue-container">
   <br />
   <h3 align="center">List of bookings</h3>
   <br />
   <div class="panel panel-default">
    <div class="panel-heading">
     <div class="row">
      <div class="col-md-6">
       <h3 class="panel-title">Your booking</h3>
      </div>
      <div class="col-md-6" align="right">
       <input type="button" class="btn btn-success btn-xs" @click="openModel" value="Add a new booking" />
      </div>
     </div>
    </div>
    <div class="panel-body">
     <div class="table-responsive">
      <table  class="table table-bordered table-striped">
       <tr>
        <th>Client</th>
        <th>Date</th>
        <th>Duration</th>
        <th>Location</th>
        <th>Edit</th>
        <th>Delete</th>
       </tr>
       <tr v-for="row in allData" v-bind:class="{ inactive: row.active == false}">
        <td>{{ row.client }}</td>
        <td>{{ row.date_rdv }}</td>
        <td>{{ row.duration }}</td>
        <td>{{ row.other_location }}</td>
        <td><button type="button" name="edit" class="btn btn-primary btn-xs edit" @click="fetchData(row.id)">Edit</button></td>
        <td><button type="button" name="delete" class="btn btn-danger btn-xs delete" @click="deleteData(row.id)">Delete</button></td>
       </tr>
      </table>
     </div>
    </div>
    </div>
   <div v-if="myModel">
    <transition name="model">
     <div class="modal-mask">
      <div class="modal-wrapper">
       <div class="modal-dialog">
        <div class="modal-content">
         <div class="modal-header">
          <button type="button" class="close" @click="myModel=false"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">{{ dynamicTitle }}</h4>
         </div>
         <div class="modal-body">
          <div class="form-group">
           <label>Enter Client Name</label>
           <input type="text" class="form-control" v-model="client" />
          </div>
          <div class="form-group">
           <label>Enter Date</label>
           <input type="text" class="form-control" v-model="date_rdv" />
          </div>
          <div class="form-group">
           <label>Enter Duration</label>
           <input type="text" class="form-control" v-model="duration" />
          </div>
          <div class="form-group">
           <label>Enter Location</label>
           <input type="text" class="form-control" v-model="other_location" />
          </div>
          <br />
          <div align="center">
           <input type="hidden" v-model="hiddenId" />
           <input type="button" class="btn btn-success btn-xs" v-model="actionButton" @click="submitData" />
          </div>
         </div>
        </div>
       </div>
       </div>
     </div>
    </transition>
   </div>
  </div>
 </body>
</html>


<script src="src/js/vue.js"></script>