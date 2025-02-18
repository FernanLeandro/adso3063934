$(function(){
    // Count Task
    countTasks()
    // Conunt Remains
    countRemains()
    // Add Task
    $('footer').on('click', '#add', function(){
        if($('#input-task').val().length > 0) {

            $task ='<article> \
                    <input type="checkbox"> \
                    <p>'+$('#input-task').val()+'</p> \
                    <button>&times;</button> \
                    </article>'
            $('section.list').append($task)
            $('#input-task').val('')
            countTasks()
            countRemains()
        } else {
            alert('Please! Enter a Task')
        }
    })
    // Toggle Task (Remain/Done)
    $('body').on('click', 'input[type=checkbox]', function() {
        // if cheched
        if($(this).prop('checked')) {
        $(this).parent().addClass('checked') 
        } else {
        $(this).parent().removeClass('checked')
        }
        countRemains()
    })
})
function countTasks() {
    $('.number-tasks').text($('article').length)
    $('.title-tasks').text($('article').length > 1 ? 'Tasks' : 'Task')
}
// Count Remains
function countRemains() {
    $('.number-remains').text(Math.abs($('.checked').length - $('article').length))
    $('.title-remains').text($('.checked').length > 1 ? 'Remains' : 'Remain')
}