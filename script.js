//переменные
let userID                      //id пользователя для редактирования информации
let createChange                //
let amountPages                 //количество страниц
let amountUsers                 //количество пользователей
let page                        //номер страницы
let perPage                     //количество пользователей на странице
perPage = 5
let sorting                     //сортировка

if (!page)
    page = 0;

$(document).ready(
    pageList()
)

//переход по страницам
$('.users__pages').on('click', '.users__numPage', function () {
    page = $('.users__numPage').index(this)
    pageList()
})

//сортировка
$('.users-content__sort>i:first-child').click(function () {
    sorting = ''
    $(this).addClass('active')
    $('.users-content__sort>i:last-child').removeClass('active')
    pageList()
})
$('.users-content__sort>i:last-child').click(function () {
    sorting = 'DESC'
    $(this).addClass('active')
    $('.users-content__sort>i:first-child').removeClass('active')
    pageList()
})

//количество пользователей на странице
$('.users__per-page>i:nth-child(1)').click(function () {
    perPage = 10
    $(this).addClass('active')
    $('.users__per-page>i:nth-child(3)').removeClass('active ')
    $('.users__per-page>i:nth-child(5)').removeClass('active ')
    pageList()
})
$('.users__per-page>i:nth-child(3)').click(function () {
    perPage = 20
    $(this).addClass('active')
    $('.users__per-page>i:nth-child(1)').removeClass('active ')
    $('.users__per-page>i:nth-child(5)').removeClass('active ')
    pageList()
})
$('.users__per-page>i:nth-child(5)').click(function () {
    perPage = 50
    $(this).addClass('active')
    $('.users__per-page>i:nth-child(3)').removeClass('active ')
    $('.users__per-page>i:nth-child(1)').removeClass('active ')
    pageList()
})

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

//отображение таблицы пользователей
function showUsers() {
    $('.table-users__body').empty()
    $.ajax('/scripts/show_users.php', {
        method: 'POST',
        data: {page: page, sorting: sorting, per_page: perPage}
    })
        .done(function (data) {
            data = JSON.parse(data)
            let n
            if (!sorting)
                n = (page * perPage)
            if (sorting === 'DESC')
                n = (amountUsers + 1) - (page * perPage)
            for (let i = 1; i <= data.length; i++) {
                let dataUsers = data[i - 1]
                if (!sorting)
                    n++
                if (sorting === 'DESC')
                    n--
                $('.table-users__body').append(
                    `<div class="table-users__row">
        <div class="table-users__cell">${n}</div>
        <div class="table-users__cell">${dataUsers['username']}</div>
        <div class="table-users__cell">${dataUsers['email']}</div>
        <div class="table-users__cell">${dataUsers['address']}</div>
        <div class="table-users__cell change" id="${dataUsers['user_id']}">Изменить</div>
        <div class="table-users__cell"><input type="checkbox" id="${dataUsers['user_id']}"></div>
    </div>`
                )
            }
        })
}


//отображения количества страниц
function pageList() {
    $('.users__pages').empty()
    $.ajax('/scripts/amount_pages.php', {
        method: 'POST',
        data: {per_page: perPage}
    })
        .done(function (data) {
            data = JSON.parse(data)
            amountPages = data['pages']
            amountUsers = data['users']
            showUsers()
            for (let i = 1; i <= amountPages; i++) {
                let active = (i === (page + 1)) ? 'active' : ''
                $('.users__pages').append(
                    `<li class="users__numPage ${active}">${i}</li>`
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