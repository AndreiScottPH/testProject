let usersCheck = []
let delUsers
$('.user__delete-users').on('click', function () {
    $("input:checkbox:checked").each(function () {
        usersCheck.push($(this).attr('id'))
    });
    delUsers = $.ajax('/scripts/del_users.php', {
        type: 'POST',
        data: {usersCheck}
    })
    delUsers.done(function (data) {
        data = JSON.parse(data)
        if (data) {
            $('.index__error').show().html('Удаление произведено').delay(2000).fadeOut(200)
        } else {
            $('.index__error').show().html('Попробуйте еще раз').delay(2000).fadeOut(200)
        }
    })
})