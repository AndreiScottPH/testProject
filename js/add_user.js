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
    request.done(function (data) {
        data = JSON.parse(data)
        console.log(data)
        if (data) {
            inputs.val('');
            $('.add-user').fadeOut(200)
            $('.index__error').show().html('Пользователь создан').delay(2000).fadeOut(200)
        } else {
            $('.index__error').show().html('Попробуйте еще раз').delay(2000).fadeOut(200)
        }
    })
})