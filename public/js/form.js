$(document).ready(function () {

    let count = 0;
    let element = $("#task_0");
    let innerElement = element;

    while (innerElement.length !== 0)
    {
        count++;
        let id = "#task_" + count;
        innerElement = $(id);
        console.log(innerElement);
        if (innerElement.length !== 0)
        {
            element = innerElement;
        }
    }

    element.after('<a id="add_task" class="btn btn-warning" style="float: right; margin-top: 5px;" role="button">+</a><a id="remove_task" class="btn btn-warning" style="float: right; margin-right: 10px; margin-top: 5px;" role="button">-</a>');

    $('#add_task').click(function () {
        element.after('<br><label for="task_' + count +'">task</label><br><input id="task_' + count + '" type="text" class="form-control" name="task_' + count + '">')
        let id = '#task_' + count;
        element = $(id);
        count++;
    });

});