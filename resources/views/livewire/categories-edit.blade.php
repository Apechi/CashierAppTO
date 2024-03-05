<!-- Modal -->
<div class="modal fade" wire:ignore.self id="editCategories" tabindex="-1" aria-labelledby="editCategoriesLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editCategoriesLabel">Edit Kategori</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <x-form method="PUT" action="categories/{{ $categories_id }}" class="mt-4">
                <div class="modal-body">
                    @include('app.categories.form-inputs')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" data-bs-dismiss class="btn btn-primary">Simpan</button>
                </div>
            </x-form>
        </div>
    </div>
</div>
