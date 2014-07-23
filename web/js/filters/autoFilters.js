
$("#awa_aplication_filer_name").on('change paste', function() {
    
    destination = $("#Aaplication_filter_form").attr('action');
    $.post(destination, $("#Aaplication_filter_form").serialize(), 
                function(data){
                    var prices = [];
                    var elements = $.parseJSON(data.entities); //hacer parse por que no lo tomó como array
          
          //sacar los precios
         for (index = 0; index < elements.length; ++index) {
                          prices[index] = elements[index].price;
                      }
         //borrar los precios repetidos
                  uniqueArray = prices.filter(function(elem, pos) {
                                  return prices.indexOf(elem) == pos;
                                    });
                  //limpiar el select de precios
                  $("#awa_aplication_filer_price").empty();

                  //cargar los precios descargados al select
                  for (index = 0; index < uniqueArray.length; ++index) {
                        $("#awa_aplication_filer_price").append("<option value='"+uniqueArray[index]+"'>"+uniqueArray[index]+"</option>");
                      }
                 },"json");


});

