$(document).ready(function(){
    var host = window.location.href;    
    $.getJSON(host + "/task/get_sub/" + $(".userid").val(), function(data) {
        var temp = [];
        $.each(data, function(key, value) {
            temp.push({v:value, k: key});
        });
        temp.sort(function(a,b){
           if(a.v > b.v){ return 1}
            if(a.v < b.v){ return -1}
                return 0;
        });
    $('.is').empty();
        $.each(temp, function(key, obj) {
           $('.is').append('<option value="' + obj.k +'">' + obj.v + '</option>');
        });
    });                
});