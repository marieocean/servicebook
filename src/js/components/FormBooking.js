Vue.component('form-booking', {
  props: {
    myModel : false
  },
  data: function () {
    return {      
      client: '',
      date_rdv: new Date(),
      duration: '',
      other_location:'',
      hiddenId: '',
      actionButton:'Insert',
      dynamicTitle:'Add Data',
    }
  },
  components: {
    vuejsDatepicker
  },
  methods: {
    hideModel: function(){
      return this.showModel = false;
    },
    tomysql(date) {var date;
     date = new Date();
     date = date.getUTCFullYear() + '-' +
         ('00' + (date.getUTCMonth()+1)).slice(-2) + '-' +
         ('00' + date.getUTCDate()).slice(-2) ;
         return date;
   },
   clearModal:function(){
    this.client = '';
    this.duration = '';
    this.location = '';
   },
    submitData:function(){
     if(this.client != '' && this.date_rdv != '')
     {
      if(application.actionButton == 'Insert')
      {
       axios.post('src/action.php', {
        action:'insert',
        client:this.client, 
        date_rdv:this.tomysql(this.date_rdv),
        duration:this.duration,
        other_location:this.other_location,
       }).then(function(response){
        this.myModel = false;         
       }).then(function(response){
         this.$parent.fetchAllData();
       });
      }
      if(application.actionButton == 'Update')
      {
       axios.post('src/action.php', {
        action:'update',
        client:application.client, 
        date_rdv:application.tomysql(application.date_rdv),
        duration:application.duration,
        other_location:application.other_location,
        id : application.hiddenId
       }).then(function(response){
        application.myModel = false;
        application.fetchAllData();
        application.clearModal();
       });
      }
     }
     else
     {
      alert("Fill All Field");
     }
    },
  },
  //TODO: make changes so that input can be opened two times, something to do with the binding of the props

  template:   `<div v-if="myModel">
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
         <vuejs-datepicker v-model="date_rdv"  ></vuejs-datepicker>
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
         <input type="button" class="btn btn-success btn-xs" v-on:click="submitData" v-model="actionButton" />
        </div>
       </div>
      </div>
     </div>
     </div>
   </div>
  </transition>
 </div>`
})