<!-- Generic Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-dark">
            <div class="modal-header bg-dark text-white py-3">
                <h5 class="modal-title font-monospace text-uppercase fs-6 fw-bold mb-0" id="deleteConfirmModalLabel">
                    <i data-lucide="alert-triangle" class="me-2" style="width: 16px; height: 16px;"></i> <span data-i18n="confirm_delete_title">Confirm Deletion</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p class="mb-0 text-dark" data-i18n="confirm_delete_text">
                    Are you sure you want to delete <strong id="deleteItemName" class="text-danger">this item</strong>? This operation cannot be undone.
                </p>
            </div>
            <div class="modal-footer bg-light border-top">
                <button type="button" class="btn btn-sharp" data-bs-dismiss="modal" data-i18n="cancel">Cancel</button>
                <button type="button" id="confirmDeleteBtn" class="btn btn-sharp btn-danger text-white" data-i18n="yes_delete">Delete Item</button>
            </div>
        </div>
    </div>
</div>
