let request;
let addForm = $('#add-user__content');
addForm.submit(function (e) {
    e.preventDefault();
    if (request) {
        request.abort()
    }
    let form = $(this);

    let inputs = form.find('input')

    let inputData = form.serialize()

    request = $.ajax('/scripts/add_user.php', {
        type: 'POST',
        data: inputData
    })
    request.fail(function (data) {
        console.log(fail)
        console.log(data)
        alert('fail')
        close();
    })
    request.done(function (data) {
        console.log(data)
        data = JSON.parse(data)
        console.log(data)
        // if (data['result']) {
        //     console.log(123)
        //     inputs.val('');
        // }
    })

})