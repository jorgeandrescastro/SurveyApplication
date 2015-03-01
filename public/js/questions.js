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
          $(".dependent17 :input").val('');
        });
        $(".dependent20").each(function (index){
          $(".dependent20 :input").val('');
          $(this).addClass('hidden');
        }); 
        $(".dependent23").each(function (index){
          $(".dependent23 :input").val('');
          $(this).addClass('hidden');
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
        $(".dependent23 :input").val('');
        $(this).addClass('hidden');
      }); 
    } 
  });

  $('input:radio[name=question_26]').click(function() {
    var val = $('input:radio[name=question_26]:checked').val();
    
    if(val == 'No') {
      $(".dependent26").each(function (index){
        $(this).removeClass('hidden');
      }); 
    }

    if(val == 'Si') {
      $(".dependent26").each(function (index){
        $(".dependent26 :input").val('');
        $(this).addClass('hidden');
        $('.dependent26 :radio').prop('checked', false);
        $('.dependent26 :checkbox').prop('checked', false);
      }); 
      $(".dependent33").each(function (index){
        $(this).addClass('hidden');
        $('.dependent33 :radio').prop('checked', false);
        $(".dependent33 :input").val('');
      });
      $(".dependent41").each(function (index){
        $(".dependent41 :input").val('');
        $(this).addClass('hidden');
      });
      $(".dependent44").each(function (index){
        $(".dependent44 :input").val('');
        $(this).addClass('hidden');
      });
    } 
  });


  if($("#question_33").length ) {
    $("#question_33").change(function() {
      var val = $("#question_33").val();

      var values = ['Compañeros de la Universidad','Amigos (cercanos)',
                    'Personas conocidas (amigos de mis amigos)',
                    'Familiares', 'Vecinos'];

      if($.inArray(val, values) !== -1) {
        $(".dependent33").each(function (index){
          $(this).removeClass('hidden');
        });  
      } else {
        $(".dependent33").each(function (index){
          $(this).addClass('hidden');
          $('.dependent33 :radio').prop('checked', false);
          $(".dependent33 :input").val('');
        });
        $(".dependent41").each(function (index){
          $(".dependent41 :input").val('');
          $(this).addClass('hidden');
        });
        $(".dependent44").each(function (index){
          $(".dependent44 :input").val('');
          $(this).addClass('hidden');
        });
      }

    });
  }

  $('input:radio[name=question_41]').click(function() {
    var val = $('input:radio[name=question_41]:checked').val();
    
    if(val == 'Si') {
      $(".dependent41").each(function (index){
        $(this).removeClass('hidden');
      }); 
    }

    if(val == 'No') {
      $(".dependent41").each(function (index){
        $(".dependent41 :input").val('');
        $(this).addClass('hidden');
      }); 
    } 
  });

  $('input:radio[name=question_44]').click(function() {
    var val = $('input:radio[name=question_44]:checked').val();
    
    if(val == 'Si') {
      $(".dependent44").each(function (index){
        $(this).removeClass('hidden');
      }); 
    }

    if(val == 'No') {
      $(".dependent44").each(function (index){
        $(".dependent44 :input").val('');
        $(this).addClass('hidden');
      }); 
    } 
  });



  if($("#question_11").length ) {
    $("#question_11").unbind('change');
    $("#question_11").change(function() {
      var val = $("#question_11").val();

      if($("#careers-table").length == 0) {
        $('#select-question11').after('<table id="careers-table" class="table table-bordered"><tr><th>Carrera</th><tr/></table>');
      }
      $('#careers-table tr:last').after('<tr><td>'+val+'</td></tr>');
      var careers = $('#question_57').val();
      $('#question_57').val(careers + ',' + val);
    });
  }

  $("#surveyBlock_1").submit(function( event ) {
    // var $input = $(this).find("select[name=question_11]");
    // $input.val("You can buy me love");
    // $('#question_57').val("VAmos A ver");
    // console.log("life is a song");
  });
      
});