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
    }
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
         <input type="button" class="btn btn-success btn-xs" v-model="actionButton" />
        </div>
       </div>
      </div>
     </div>
     </div>
   </div>
  </transition>
 </div>`
})