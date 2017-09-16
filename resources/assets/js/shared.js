function openRenameModal() {
    $('#renameModal').modal();
}

$(function(){
    $('#userUpdateForm').submit(function(){
        var requestUri = '/api/v1/user/' + $('#userCode').val();
        var newName = $('#userName').val();

        axios.put(requestUri, {name:newName})
            .then(function (response) {
                data = response.data;

                $('#nameLabel').text(newName);
                $('#userName').text(newName);
                $('#renameModal').modal('hide');
            })
            .catch(function (error) {
                console.log(error);
            });

        return false;
    });
});

toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};