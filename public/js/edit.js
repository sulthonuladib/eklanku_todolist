$(document).ready(function(){


    var host = '/task/create';    


   $("#uid").change(function() {

            $.getJSON(host + "/get_sub/" + $("#uid option:selected").val(), function(data) {
    
            //  console.log(a);            

                var temp = [];

                //CONVERT INTO ARRAY

                $.each(data, function(key, value) {

                    temp.push({v:value, k: key});

                });

                //SORT THE ARRAY

                temp.sort(function(a,b){

                   if(a.v > b.v){ return 1}

                    if(a.v < b.v){ return -1}

                      return 0;

                });

                //APPEND INTO SELECT BOX

                $('#sub_kategori').empty();

                // $('#sub_kategori').append('<option>Divisi</option>');

                $.each(temp, function(key, obj) {

                    $('#sub_kategori').append('<option value="' + obj.k +'">' + obj.v + '</option>');
                });
            });                
        }); 

});//end of document ready