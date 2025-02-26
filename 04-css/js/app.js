$(function () {

   // check localStorage
   if (localStorage.getItem('todolist') != null) {
      $('.list').html(localStorage.getItem('todolist'))
      countTasks()
      countRemains()
   } else {
      //count Tasks//
      countTasks()
      countRemains()
   }


   //add Task//
   $('footer').on('click', '#add', function () {
      if ($('#input-task').val().length > 0) {

         $task = '<article> \
      <input type="checkbox"> \
      <p>'+ $('#input-task').val() + '<\p> \
      <button>&times;</button>  \
      </article>'
         $('section.list').append($task)
         $('#input-task').val('')
         countTasks()
         countRemains()
      }
      else {
         alert('please! Enter a Task')
      }
   })
   $('body').on('click', 'input[type=checkbox]', function () {
      // if checked
      if ($(this).prop('checked')) {
         $(this).attr('checked', true)
         $(this).parent().addClass('checked')
      } else {
         $(this).attr('checked', false)
         $(this).parent().removeClass('checked')
      }
      countRemains()
   })
   //remove task
   $('body').on('click', 'article button', function () {
      $(this).closest('article').remove()
      countTasks()
      countRemains()
   })
})

function countTasks() {
   $('.num-tasks').text($('article').length)
   $('.title-tasks').text(('article').length > 1 ? 'Tasks' : 'Task')
}
//Count remains
function countRemains() {
   $remain = Math.abs($('.checked').length - $('article').length)
   $('.num-remains').text($remain)
   $('.title-remains').text($remain > 1 ? 'Remains' : 'Remain')
   // set localStorage
   localStorage.setItem('todolist', $('.list').html())
}
function reset() {
   $('.list').html('')
   localStorage.removeItem('Todo list')
   countTasks()
   countRemains()
}

$('main').on('click', "#reset", function (){
   reset()
})