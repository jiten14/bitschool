<x-layout>
    <div class="row g-5">
        <div class="col-md-12 col-lg-12">
            <h4 class="mb-3">Fill the form below. All are required.</h4>
            <form class="needs-validation" novalidate method="POST">
                @csrf
                <hr class="my-4">
                <div class="row g-3">
                    <div class="col-sm-3">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input type="text" name="full_name" class="form-control" id="full_name" placeholder="Full Name" value="" required>
                        <div class="invalid-feedback">
                            Valid Full Name is required.
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label for="parents_name" class="form-label">Parent's/Guardian's Name</label>
                        <input type="text" name="parents_name" class="form-control" id="parents_name" placeholder="Parent's Name" value="" required>
                        <div class="invalid-feedback">
                            Valid Parent's/Guardian's Name is required.
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Your Email ID" required>
                        <div class="invalid-feedback">
                            Please enter a valid email address.
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone Number" value="" required>
                        <div class="invalid-feedback">
                            Valid Phone no. is required.
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="parmanent_address" class="form-label">Permanent Address</label>
                        <textarea class="form-control" name="parmanent_address" id="parmanent_address" rows="3" placeholder="Permanent Address" required></textarea>
                        <div class="invalid-feedback">
                            Please enter your Permanent address.
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="communication_address" class="form-label">Communication Address</label>
                        <textarea class="form-control" name="communication_address" id="communication_address" rows="3" placeholder="Postal Address" required></textarea>
                        <div class="invalid-feedback">
                            Please enter your Present address.
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="academic_year_id" class="form-label">Academic Year</label>
                        <select name="academic_year_id" class="form-select" id="academic_year_id" required>
                            <option value="">Choose...</option>
                            @foreach($AcademicYears as $AcademicYear)
                                <option value="{{$AcademicYear->id}}">{{$AcademicYear->academic_year}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid Academic Year.
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="admission_type_id" class="form-label">Admission Type</label>
                        <select name="admission_type_id" class="form-select" id="admission_type_id" required>
                            <option value="">Choose...</option>
                            @foreach($AdmissionTypes as $AdmissionType)
                                <option value="{{$AdmissionType->id}}">{{$AdmissionType->admission_type}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid Admission Type.
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="branch_id" class="form-label">Branch</label>
                        <select name="branch_id" class="form-select" id="branch_id" required>
                            <option value="">Choose...</option>
                            @foreach($Branches as $Branch)
                                <option value="{{$Branch->id}}">{{$Branch->branch}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid Branch.
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="col-md-6">
                        <button class="w-100 btn btn-secondary btn-lg" type="reset">Reset</button>
                    </div>
                    <div class="col-md-6">
                        <button class="w-100 btn btn-primary btn-lg" type="submit">Apply</button>
                    </div>
                    <hr class="my-4">
                </div>
            </form>
        </div>
    </div>
</x-layout>