$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$(document).ready(function() {
  if($("#question_17").length ) {
    $("#question_17").change(function() {
      var val = $("#question_17").val();

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