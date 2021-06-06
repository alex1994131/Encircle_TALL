<script>
const modalClose = (modal) => {
    const modalToClose = document.querySelector('.' + modal);
    modalToClose.classList.remove('fadeIn');
    modalToClose.classList.add('fadeOut');
    $(`.${modal}`).css('display', 'none');
}

const openModal = (modal) => {
    const modalToOpen = document.querySelector('.' + modal);
    modalToOpen.classList.remove('fadeOut');
    modalToOpen.classList.add('fadeIn');
    modalToOpen.style.display = 'flex';
}
$('.keydate_modal').on('click', function() {
    var this_id_str = $(this).attr('id');
    var this_id_array = this_id_str.split('_');
    var campaign_id = this_id_array[2];
    $('#campaign_id').val(campaign_id);
    openModal("main-modal");
})

$('.duplicate_btn').on('click', function() {
    var campaign_id = $('#campaign_id').val()
    var archive_order_num = $('#archive_order_num').val()
    var archive_date = $('#archive_date').val()

    $.ajax({
        type: 'POST',
        url: base_url + '/patients/duplicateArchive',
        dataType: 'json',
        data: {
            _token: $("[name='_token']").val(),
            campaign_id: campaign_id,
            archive_order_num: archive_order_num,
            archive_date: archive_date,
        },
        success: function(response) {
            if (response.success == 'success') {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Successfully Duplicated!',
                    showConfirmButton: false,
                    timer: 1500
                })
                modalClose('main-modal');
            }
        }
    })
})
</script>