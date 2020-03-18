        $(function () {
            $(".draggable").draggable({ revert: "invalid", snap: "true", snapMode: "inner" });
            $(".droppable").droppable({
                drop: function (event, ui) {
                    var task_id = $(ui.helper).attr("id");
                    var id_ket = $(this).attr("id");
                    ui.helper.css('top', '');
                    ui.helper.css('left', '');
                    $(this).find('.sort').prepend(ui.helper);
                    $.ajax({
                        url: "/leader/test/" + task_id,
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            task_id: task_id,
                            id_ket: id_ket,

                        },
                        success: function (data) {
                            // alert('your change successfully saved');
                            // alert(JSON.stringify(data));
                        }
                    })

                }
            });
        });
