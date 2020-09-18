let users
users = $.ajax('/scripts/show_users.php', {
    type: 'POST'
})
users.done(function (data) {
    data = JSON.parse(data)
    let n = 1;
    for (let i = 1; i <= data.length; i++) {
        $('.table-users__body').append(
            `<div class="table-users__row">
        <div class="table-users__cell">${n++}</div>
        <div class="table-users__cell">${data[i - 1]['username']}</div>
        <div class="table-users__cell">${data[i - 1]['email']}</div>
        <div class="table-users__cell">${data[i - 1]['address']}</div>
        <div class="table-users__cell change">Изменить</div>
        <div class="table-users__cell"><input type="checkbox" id="${data[i - 1]['user_id']}"></div>
    </div>`
        )
    }
})

