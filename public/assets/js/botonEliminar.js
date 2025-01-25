function confirmDelete(id, entityType) {
    let message = `¿Estás seguro de que deseas eliminar este ${entityType}?`;
    let result = confirm(message);
    if (result) {
        document.getElementById('delete-form-' + entityType + '-' + id).submit();
    }
}

function confirmReject(id, entityType) {
    let message = `¿Estás seguro de que deseas rechazar este ${entityType}?`;
    let result = confirm(message);
    if (result) {
        document.getElementById('reject-form-' + entityType + '-' + id).submit();
    }
}