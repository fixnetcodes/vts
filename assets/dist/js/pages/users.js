$('#usersTable').DataTable({
    "processing": true
});

$('.delete-btn').on('click', function(){  
    var id = $(this).data('id');  
    $.ajax({  
          url:"../models/User.php?f=fetchUser",  
          method:"POST",  
          data:{id: id}, 
          dataType: 'json',  
          success:function(data){ 
             $('#user_id').val(data[0]['Id']);
             $('#deleteModal').modal('show');  
          }  
    });  
}); 

$('#deleteUser').on('submit', function(){
    var id = $('#user_id').val();
    $.ajax({
        url: '../models/User.php?f=deleteUser',
        method: 'POST',
        data: {id: id},
        success: function(data){
            if(data) {
                $('#deleteModal').modal('hide'); 
                location.reload();
                $('#message').html('<div class="alert alert-success>User deleted successfully...</div>"')
            }
        }
    });
});