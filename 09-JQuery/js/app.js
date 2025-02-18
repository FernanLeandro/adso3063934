// Add Task
$(function(){
    $('footer').on('click', '#add', function(){
        if($('#input-task').val().length > 0) {

            $task ='<article> \
                    <input type="checkbox"> \
                    <p>'+$('#input-task').val()+'</p> \
                    <button>&times;</button> \
                    </article>'
            $('section.list').append($task)
            $('#input-task').val('')

        } else {
            alert('Please! Enter a Task')
        }
    })
    // Toggle Task (Remain/Done)
    $('article').on('click', 'input[type=checkbox]', function() {
        // if cheched
        if($(this).prop('checked')) {
        $(this).parent().addClass('checked') 
        } else {
        $(this).parent().removeClass('checked')
        }
    })
})