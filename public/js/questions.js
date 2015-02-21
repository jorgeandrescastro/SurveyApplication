$(function () {
  $('[data-toggle="tooltip"]').tooltip();
  $('[numeric]').numeric();
})

$(document).ready(function() {
  if($("#question_17").length ) {
    $("#question_17").change(function() {
      var val = $("#question_17").val();

      var values = ['Compañeros de la Universidad','Amigos (cercanos)',
                    'Personas conocidas (amigos de mis amigos)',
                    'Familiares', 'Vecinos'];

      if($.inArray(val, values) !== -1) {
        $(".dependent17").each(function (index){
          $(this).removeClass('hidden');
        });  
      } else {
        $(".dependent17").each(function (index){
          $(this).addClass('hidden');
          $('.dependent17 :radio').prop('checked', false);
        });
      }

    });
  }

  $('input:radio[name=question_20]').click(function() {
    var val = $('input:radio[name=question_20]:checked').val();
    
    if(val == 'Si') {
      $(".dependent20").each(function (index){
        $(this).removeClass('hidden');
      }); 
    }

    if(val == 'No') {
      $(".dependent20").each(function (index){
        $(".dependent20 :input").val('');
        $(this).addClass('hidden');
      }); 
    } 
  });

  $('input:radio[name=question_23]').click(function() {
    var val = $('input:radio[name=question_23]:checked').val();
    
    if(val == 'Si') {
      $(".dependent23").each(function (index){
        $(this).removeClass('hidden');
      }); 
    }

    if(val == 'No') {
      $(".dependent23").each(function (index){
        $(".dependent20 :input").val('');
        $(this).addClass('hidden');
      }); 
    } 
  });



  if($("#question_27").length ) {
    $("#question_27").change(function() {
      var val = $("#question_27").val();

      var values = ['Compañeros de la Universidad','Amigos (cercanos)',
                    'Personas conocidas (amigos de mis amigos)',
                    'Familiares', 'Vecinos'];

      if($.inArray(val, values) !== -1) {
        $(".dependent").each(function (index){
          $(this).removeClass('hidden');
        });  
      } else {
        $(".dependent").each(function (index){
          $(this).addClass('hidden');
          $('.dependent :radio').prop('checked', false);
        });
      }

    });
  }    
});