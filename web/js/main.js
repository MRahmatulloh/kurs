$(document).on('collapsed.lte.pushmenu', '[data-widget="pushmenu"]', function () {
    $('.brand-image-large').addClass('d-none');
    $('.brand-image').removeClass('d-none');

});
$(document).on('shown.lte.pushmenu', '[data-widget="pushmenu"]', function () {
    $('.brand-image-large').removeClass('d-none');
    $('.brand-image').addClass('d-none');
});