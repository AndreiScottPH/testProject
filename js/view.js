$('.users__add-user-link').click(function () {
    $('.add-user').fadeIn(200)
})
$('.add-user__close').click(function () {
    $('.add-user').fadeOut(200)
})
$('.add-user').on('click', function (e) {
    if (e.target === $(this)[0]) {
        $('.add-user').fadeOut(200)
    }
})
