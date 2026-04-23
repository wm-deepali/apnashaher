
<div class="modal fade" id="profileModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form id="profileForm">
                @csrf
                <input type="hidden" name="id" value="{{$institute->id ?? ''}}">

                <!-- Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Institute Profile</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    <div class="row">

                        <!-- Owner -->
                        <div class="col-md-6">
                            <label>Owner Name *</label>
                            <input type="text" name="owner_name" class="form-control"
                                value="{{$institute->owner_name ?? ''}}">
                            <span class="text-danger error owner_name_error"></span>
                        </div>

                        <!-- Designation -->
                        <div class="col-md-6">
                            <label>Designation *</label>
                            <select name="designation" class="form-control">
                                <option value="">Select</option>
                                <option value="Director" {{$institute->designation == "Director" ? 'selected' : ""}}>Director</option>
                                <option value="Manager" {{$institute->designation == "Manager" ? 'selected' : ""}}>Manager</option>
                                <option value="Founder" {{$institute->designation == "Founder" ? 'selected' : ""}}>Founder</option>
                                <option value="Principal" {{$institute->designation == "Principal" ? 'selected' : ""}}>Principal</option>
                            </select>
                            <span class="text-danger error designation_error"></span>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label>Email *</label>
                            <input type="email" name="email" class="form-control"
                                value="{{$institute->owner_email ?? ''}}">
                            <span class="text-danger error email_error"></span>
                        </div>

                        <!-- Year -->
                        <div class="col-md-6">
                            <label>Established Year *</label>
                            <input type="number" name="established_year" class="form-control"
                                value="{{$institute->established_year ?? ''}}">
                            <span class="text-danger error established_year_error"></span>
                        </div>

                        <!-- Description -->
                        <div class="col-md-12">
                            <label>Description *</label>
                            <textarea name="institute_desc" class="form-control">{{$institute->detailed_information ?? ''}}</textarea>
                            <span class="text-danger error institute_desc_error"></span>
                        </div>

                        <!-- Website -->
                        <div class="col-md-6">
                            <label>Website</label>
                            <input type="text" name="website" class="form-control"
                                value="{{$institute->website ?? ''}}">
                            <span class="text-danger error website_error"></span>
                        </div>
                        <!-- Facebook -->
                        <div class="col-md-6">
                            <label>Facebook</label>
                            <input type="url" name="facebook_url" class="form-control"
                                value="{{$institute->facebook_url ?? ''}}"
                                placeholder="https://facebook.com/username">
                            <span class="text-danger error facebook_url_error"></span>
                        </div>

                        <!-- Instagram -->
                        <div class="col-md-6">
                            <label>Instagram</label>
                            <input type="url" name="instagram_url" class="form-control"
                                value="{{$institute->instagram_url ?? ''}}"
                                placeholder="https://instagram.com/username">
                            <span class="text-danger error instagram_url_error"></span>
                        </div>

                        <!-- YouTube -->
                        <div class="col-md-6">
                            <label>YouTube</label>
                            <input type="url" name="youtube_url" class="form-control"
                                value="{{$institute->youtube_url ?? ''}}"
                                placeholder="https://youtube.com/@channel">
                            <span class="text-danger error youtube_url_error"></span>
                        </div>

                        <!-- Twitter / X -->
                        <div class="col-md-6">
                            <label>Twitter / X</label>
                            <input type="url" name="twitter_url" class="form-control"
                                value="{{$institute->twitter_url ?? ''}}"
                                placeholder="https://twitter.com/username">
                            <span class="text-danger error twitter_url_error"></span>
                        </div>

                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="saveProfileBtn" class="btn btn-success">Save</button>
                </div>

            </form>

        </div>
    </div>
</div>