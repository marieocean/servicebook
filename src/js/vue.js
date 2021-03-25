
var application = new Vue({
    el:'#vue-container',
    data:{
     allData:'',
     myModel:false,
     actionButton:'Insert',
     dynamicTitle:'Add Data',
    },
    methods:{
     fetchAllData:function(){
      axios.post('src/action.php', {
       action:'fetchall'
      }).then(function(response){
       application.allData = response.data;
      });
     },
     clearModal:function(){
      application.client = '';
      application.date_rdv = '';
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
         date_rdv:application.date_rdv,
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
         firstName : application.first_name,
         lastName : application.last_name,
         hiddenId : application.hiddenId
        }).then(function(response){
         application.myModel = false;
         application.fetchAllData();
         application.first_name = '';
         application.last_name = '';
         application.hiddenId = '';
         application.fetch10Data();
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
       application.first_name = response.data.first_name;
       application.last_name = response.data.last_name;
       application.hiddenId = response.data.id;
       application.myModel = true;
       application.actionButton = 'Update';
       application.dynamicTitle = 'Edit Data';
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
        application.fetch10Data();
       });
      }
     }
    },
    
    mounted:function(){
     this.fetchAllData();
    }
   });