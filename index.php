<!DOCTYPE html>
<html>
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Booking management</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <link rel="stylesheet" href="src/css/style.css">
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
  <form-booking v-bind:my-model="myModel"></form-booking>
  </div>
 </body>
</html>

<script src="https://unpkg.com/vuejs-datepicker"></script>
<script src="src/js/components/FormBooking.js"></script>
<script src="src/js/vue.js"></script>
