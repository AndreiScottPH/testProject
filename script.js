$(document).ready(
    showUsers()
)

//удаление пользователей
$('.user__delete-users').click(function () {
    let usersCheck = []
    $("input:checkbox:checked").each(function () {
        usersCheck.push($(this).attr('id'))
    });
    $.ajax('/scripts/del_users.php', {
        method: 'POST',
        data: {usersCheck}
    })
        .done(function (data) {
            ajaxDone(data, 'Удаление произведено', false)
        })
})

//отображение информации редактируемого пользователя
let userID
let createChange
$('.table-users__body').on('click', '.change', function () {
    createChange = 'change'
    $('.add-user').fadeIn(200)
    userID = $(this).attr('id')
    $.ajax('/scripts/show_userdate.php', {
        method: 'POST',
        data: {id: userID}
    })
        .done(function (data) {
            data = JSON.parse(data)
            $('#username').val(data[0]['username'])
            $('#email').val(data[0]['email'])
            $('#address').val(data[0]['address'])
        })
})

//добавление/редактирование пользователя
$('.add-user__content').submit(function (e) {
    e.preventDefault()
    let formData = $(this).serializeArray()
    let script
    let message
    if (createChange === 'change') {
        script = 'update_user'
        message = 'Данные изменены'
        formData.push({name: 'id', value: `${userID}`})
    }
    if (createChange === 'create') {
        script = 'add_user'
        message = 'Пользователь добавлен'
    }
    $.ajax(`/scripts/${script}.php`, {
        method: 'POST',
        data: formData
    })
        .done(function (data) {
            ajaxDone(data, message, true)
        })
})

//функции
function ajaxDone(data, message, addUser) {
    data = JSON.parse(data)
    console.log(data)
    if (data) {
        createChange = ''
        if (addUser) {
            $('input').val('')
            $('.add-user').fadeOut(200)
        }
        showUsers()
        $('.index__error').show().html(message).delay(2000).fadeOut(200)
    } else {
        $('.index__error').show().html('Попробуйте еще раз').delay(2000).fadeOut(200)
    }
}

function showUsers() {
    $('.table-users__body').empty()
    $.ajax('/scripts/show_users.php', {
        method: 'POST'
    })
        .done(function (data) {
            data = JSON.parse(data)
            let n = 1;
            for (let i = 1; i <= data.length; i++) {
                $('.table-users__body').append(
                    `<div class="table-users__row">
        <div class="table-users__cell">${n++}</div>
        <div class="table-users__cell">${data[i - 1]['username']}</div>
        <div class="table-users__cell">${data[i - 1]['email']}</div>
        <div class="table-users__cell">${data[i - 1]['address']}</div>
        <div class="table-users__cell change" id="${data[i - 1]['user_id']}">Изменить</div>
        <div class="table-users__cell"><input type="checkbox" id="${data[i - 1]['user_id']}"></div>
    </div>`
                )
            }
        })
}

//открытие формы добавления пользователя
$('.users__add-user-link').click(function () {
    createChange = 'create'
    $('.add-user').fadeIn(200)
})

//закрытие формы добавления пользователя
$('.add-user__close').click(function () {
    createChange = ''
    $('.add-user').fadeOut(200)
})
$('.add-user').on('click', function (e) {
    if (e.target === $(this)[0]) {
        createChange = ''
        $('.add-user').fadeOut(200)
    }
})