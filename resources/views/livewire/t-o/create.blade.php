<div class="modal fade" id="tambah_titipan" tabindex="-1" aria-labelledby="tambah_titipanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambah_titipanLabel">@lang('crud.titipan.create_title')</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </form>
    </div>
</div>
