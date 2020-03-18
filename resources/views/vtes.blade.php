<link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
     <h3>Conected lists :  You can move items between any list</h3>     
     <style>
      .sortable_list {
border: 1px solid #eee;
width: 142px;
min-height: 20px;
list-style-type: none;
margin: 0;
padding: 5px 0 0 0;
float: left;
margin-right: 10px;
}

.sortable_list li {
margin: 0 5px 5px 5px;
padding: 5px;
font-size: 1.2em;
width: 120px;
}
</style>
<ul id="sortable1" class="sortable_list connectedSortable">
<li class="ui-state-default">List 1 - Item 1</li>
<li class="ui-state-default">List 1 - Item 2</li>
<li class="ui-state-default">List 1 - Item 3</li>
<li class="ui-state-default">List 1 - Item 4</li>
<li class="ui-state-default">List 1 - Item 5</li>
</ul>
     
<ul id="sortable2" class="sortable_list connectedSortable">
<li class="ui-state-highlight">List 2 - Item 1</li>
<li class="ui-state-highlight">List 2 - Item 2</li>
<li class="ui-state-highlight">List 2 - Item 3</li>
<li class="ui-state-highlight">List 2 - Item 4</li>
<li class="ui-state-highlight">List 2 - Item 5</li>
</ul>     
     
<ul id="sortable3" class="sortable_list connectedSortable">
<li class="ui-state-default">List 3 - Item 1</li>
<li class="ui-state-default">List 3 - Item 2</li>
<li class="ui-state-default">List 3 - Item 3</li>
<li class="ui-state-default">List 3 - Item 4</li>
<li class="ui-state-default">List 3 - Item 5</li>
</ul> 

<ul id="sortable4" class="sortable_list connectedSortable">
<li class="ui-state-highlight">List 4 - Item 1</li>
<li class="ui-state-highlight">List 4 - Item 2</li>
<li class="ui-state-highlight">List 4 - Item 3</li>
<li class="ui-state-highlight">List 4 - Item 4</li>
<li class="ui-state-highlight">List 4 - Item 5</li>
</ul> 
     
<script>
 $(function() {
$( ".sortable_list" ).sortable({
    connectWith: ".connectedSortable",
    /*stop: function(event, ui) {
        var item_sortable_list_id = $(this).attr('id');
        console.log(ui);
        //alert($(ui.sender).attr('id'))
    },*/
    receive: function(event, ui) {
        alert("dropped on = "+this.id); // Where the item is dropped
          alert("sender = "+ui.sender[0].id); // Where it came from
          alert("item = "+ui.item[0].innerHTML); //Which item (or ui.item[0].id)
    }         
}).disableSelection();
    

});
</script>