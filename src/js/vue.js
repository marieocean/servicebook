var application = new Vue({
    el:'#vue-container',
    data:{
     allData:'',
     myModel:false,
     actionButton:'Insert',
     dynamicTitle:'Add Data',
     date_rdv :new Date()
    },
    methods:{
     fetchAllData:function(){
      axios.post('src/action.php', {
       action:'fetchall'
      }).then(function(response){
       application.allData = response.data;
      });
     },
     tomysql(date) {var date;
      date = new Date();
      date = date.getUTCFullYear() + '-' +
          ('00' + (date.getUTCMonth()+1)).slice(-2) + '-' +
          ('00' + date.getUTCDate()).slice(-2) ;
          return date;
    },
     clearModal:function(){
      application.client = '';
      application.duration = '';
      application.location = '';
     },
     openModel:function(){
      this.clearModal();
      application.actionButton = "Insert";
      application.dynamicTitle = "Add a new appointment";
      application.myModel = true;
     },
     submitData:function(){
      if(application.client != '' && application.date_rdv != '')
      {
       if(application.actionButton == 'Insert')
       {
        axios.post('src/action.php', {
         action:'insert',
         client:application.client, 
         date_rdv:application.tomysql(application.date_rdv),
         duration:application.duration,
         other_location:application.other_location,
        }).then(function(response){
         application.myModel = false;         
         application.clearModal();
        }).then(function(response){
          application.fetchAllData();
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
     fetchData:function(id){
      axios.post('src/action.php', {
       action:'fetchSingle',
       id:id
      }).then(function(response){
       application.client = response.data.client;
       application.date_rdv = response.data.date_rdv;
       application.duration = response.data.duration;
       application.other_location = response.data.other_location;
       application.hiddenId = response.data.id;
       application.myModel = true;
       application.actionButton = 'Update';
       application.dynamicTitle = 'Edit the appointment';
      })
     },
     deleteData:function(id){
      if(confirm("Are you sure you want to remove this data?"))
      {
       axios.post('src/action.php', {
        action:'delete',
        id:id
       }).then(function(response){
        alert(response.data.message);
        application.fetchAllData();
       });
      }
     }
    },
    
    mounted:function(){
           this.fetchAllData();
    }
   });