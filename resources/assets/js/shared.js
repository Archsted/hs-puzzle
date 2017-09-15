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