<div class="modal fade" id="editdescription" tabindex="-1" aria-labelledby="editdescription" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perditeso Pershkrimin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form id="update-job-description-form"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Pershkrimi i punes</label>
                                <textarea name="description" class="form-control" placeholder="Ju lutem pershkruani me pak fjale poziten e punes">{{ $announcement->job_description }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <x-button type="submit" class="btn btn-submit me-2 btn-danger" label="Ruaj"></x-button>
                        <x-button type="button" class="btn btn-cancel" data-bs-dismiss="modal" label="Anulo" />
                    </div>
                </form>
            </div>
        </div>
    </div>



