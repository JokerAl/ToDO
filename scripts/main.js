$( document ).ready( function() {
    //rendering item
    function render(item) {
        var clone_item = $('li.template').clone();
        clone_item.removeClass('template').addClass('task');
        var clone_item_chkbox = clone_item.find('.checkbox');
        if (item.status == 'open') {
            clone_item.addClass('open');

        } else {
            clone_item.addClass('close');
            clone_item_chkbox.attr('checked', 'checked');
        }
        clone_item.attr('data-id', item.id);
        clone_item.find('.task-text').text(item.task);
        clone_item.hide().prependTo('#tasks').fadeIn('slow');
    }

    //get list
    $.getJSON("scripts/tasks.json", function (result) {
        result.sort(function (obj1, obj2) {
            return obj1.status > obj2.status;
        });
        $.each(result, function (index, item) {
            render(item);
        });
    });

    //add task
    $('#add_task').on('submit', function () {
        var task = $('#task_name').val();
        var data = {task: task};
        $.ajax({
                url: 'scripts/add.php',
                method: 'POST',
                data: data,
                dataType: 'json',
                cache: false
            })
            .success(function (item) {
                render(item);
                $('#task_name').val('');
            });
    });

    //close task
    var tasks = $('#tasks');
    tasks.on('click', '.checkbox', function(){
        var task = $(this).closest('.task');
        var status = '';

        if ($(this).is(':checked')) {
            status = 'close';
        } else {
            status = 'open';
        }

        var data = {id: task.data('id'), status: status};
        $.ajax({
            url: 'scripts/update.php',
            method: 'POST',
            data: data,
            cache: false
        })
        .success(function(item){
            var close_destination = $('.close:first');
            var open_destination = $('.open:first');
            if (item.status != 'open') {
                if (close_destination.length) {
                    task.hide().insertBefore(close_destination).fadeIn('slow').addClass('close').removeClass('open');
                } else {
                    task.addClass('close').removeClass('open').hide().appendTo('#tasks').fadeIn('slow');
                }
            } else {
                if (open_destination.length) {
                    task.hide().insertBefore(open_destination).fadeIn('slow').addClass('open').removeClass('close');
                } else {
                    task.addClass('open').removeClass('close').hide().prependTo('#tasks').fadeIn('slow');
                }
            }
        });
    });

    //delete task
    tasks.on('click', '.del', function() {
        var task = $(this).closest('.task');
        var data = {id: task.data('id')};
        $.ajax({
            url: 'scripts/del.php',
            method: 'POST',
            data: data,
            cache: false
        }).success(function(){
            task.remove();
        });
    });

});
