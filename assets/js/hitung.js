$(function () {
    //Date range picker
    $('#tgl_periode_absen').daterangepicker({
        format: 'YYYY/MM/DD'
    });
    $('#tgl_hitung').datepicker({
        format: 'yyyy/mm/dd'
    });

    $('#frm_hitung').submit(function(e){
      var data = $(this).serialize();
      $('#myModal').modal('show');

      $.post("<?php echo site_url('hitung/bolos')?>", data)
        .done(function(result_bolos){                      
          if(result_bolos = 'Success!'){
            $.post("<?php echo site_url('hitung/absen_telat_dan_pulang_cepat')?>", data)            
              .done(function(result_telat){
                if(result_telat = 'Success!'){
                  $.post("<?php echo site_url('hitung/lembur')?>", data)
                    .done(function(result_lembur){
                      if(result_lembur = 'Success!'){
                        $.post("<?php echo site_url('hitung/tunjangan_dan_gaji')?>", data)
                          .done(function(result_gaji){
                            if(result_gaji = 'Success!'){
                              $.post("<?php echo site_url('hitung/jamsostek')?>", data)
                                .done(function(result_jamsostek){
                                  if(result_jamsostek = 'Success!'){
                                    $.post("<?php echo site_url('hitung/pph21_gross')?>", data)
                                      .done(function(result_pphgross){
                                        if(result_pphgross = 'Success!'){
                                          $.post("<?php echo site_url('hitung/pph21_grossup')?>", data)
                                            .done(function(result_pphgrossup){
                                              if(result_pphgrossup = 'Success!'){
                                              	$('#myModal').modal('hide');
                                          	  }else{
                                          	  	alert(result_pphgrossup);
                                          	  }
                                          });
                                        }else{
                                        	alert(result_pphgross);
                                        }
                                    });
                                  }else{
                                  	alert(result_jamsostek);
                                  }
                              });
                            }else{
                            	alert(result_gaji);
                            }
                        });
                      }else{
                      	alert(result_lembur);
                      }
                  });
                }else{
                	alert(result_telat);
                }
            });
          }else{
          	alert(result_bolos);
          }
      });
      return false;
    });
});