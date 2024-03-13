function goBack() {
    window.history.back();
}
$(document).ready(function () {
    new DataTable('#example1', {
        order: [[10, 'desc']]
    });
});

