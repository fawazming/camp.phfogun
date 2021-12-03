<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/chota.css">
    <link rel="stylesheet" href="assets/style.css">
    <title>PMC Registration Portal</title>
</head>

<body>
    <div class="coner">
        <div class="text-center" style="margin-bottom:8px; display: flex; justify-content: center; align-items: center;">
            <img src="assets/logo.png" width="80px" alt="">
            <h4>PMC '21 <br> Registration Portal</h4>
        </div>
        <div class="progress-container">
            <div class="progress" id="progress"></div>
            <div class="circle active">1</div>
            <div class="circle">2</div>
            <div class="circle">3</div>
            <div class="circle">4</div>
        </div>
        <form action="<?=base_url('register')?>" method="POST">
        <div class="fieldset" id="one">

            <fieldset class="d-none d-block" style="margin-bottom: 1rem; border-width: 0px;">
                <h4>Personal Details</h4>
                <div class="mb-3">
                    <label for="fname" class="form-label">First Name</label>
                    <input type="text" name="fname" id="fname" class="form-control" placeholder="" required aria-describedby="first name">
                </div>
                <div class="mb-3">
                    <label for="lname" class="form-label">Last Name</label>
                    <input type="text" name="lname" id="lname" class="form-control" placeholder="" required aria-describedby="Last name">
                </div>
                <div class="mb-3">
                    <label for="lb" class="form-label">Local Branch</label>
                    <select name="lb" id="lb" required>
                        <option value="">Select a Local Branch</option>
                        <option value="Egba">Egba</option>
                        <option value="Remo">Remo</option>
                        <option value="Ijebu">Ijebu</option>
                        <option value="Adoodo">Ado-Odo</option>
                        <option value="others">Others</option>
                    </select>
                </div>
            </fieldset>
        </div>
        <div class="fieldset" id="two">
            <fieldset class="d-none" style="margin-bottom: 1rem; border-width: 0px;">
                <h4>Contact Details</h4>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="number" name="phone" id="phone" class="form-control" placeholder="" required aria-describedby="Phone Number">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="" required aria-describedby="Email">
                </div>
            </fieldset>
        </div>
        <div class="fieldset" id="three">
            <fieldset class="d-none" style="margin-bottom: 1rem; border-width: 0px;">
                <h4>Work/School Details</h4>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select name="category" id="category" required>
                        <option value="">Select a Category</option>
                        <option value="Primary School">Primary School</option>
                        <option value="Junior Secondary">Junior Secondary</option>
                        <option value="Senior Secondary">Senior Secondary</option>
                        <option value="Higher Institution">Higher Institution</option>
                        <option value="Workers">Workers</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="sch" class="form-label">School/Profession</label>
                    <input type="sch" name="school" required id="sch" class="form-control" placeholder="" aria-describedby="sch">
                </div>
            </fieldset>
        </div>
        <div class="fieldset" id="four">
            <fieldset class="d-none" style="margin-bottom: 1rem; border-width: 0px;">
                <h4>Bank Account Details</h4>
                <p style="line-height: 1.8rem;">When doing bank transfer to the account <br> provided, please narrate it using the code <br> provided
                    below</p>
                <div class="mb-3">
                    <label for="ref" class="form-label" >Reference Code</label>
                    <input type="text" disabled value=<?='pzx'.$ref?> id="ref" class="form-control" aria-describedby="Reference Code">
                    <input type="hidden"  name="ref" value=<?='pzx'.$ref?> >
                </div>
                <div class="mb-3">
                    <h4 class="text-center" id="bank" style="line-height: 1.5rem; margin-bottom:2px;">Sterling Bank</h4>
                    <h3 class="text-center" id="accname" style="line-height:1.5rem; margin-bottom:2px;">PHF Egba</h3>
                    <h5 class="text-center" id="accno" style="margin-top: .1rem; margin-bottom:2px;">0500883821</h5>
                </div>
                <div class="text-center form-check form-check-inline">
                      <input type="checkbox" class="form-check-input" id="transfer">
                      <label class="form-check-label" for="transfer">
                        I have done the transfer!
                      </label>
                </div>
            </fieldset>
        </div>
        <div class="text-center" id="btn1">
            <button class="btn" disabled id="prev">Prev</button>
            <button class="btn" id="next">Next</button>
        </div>
        <div class="text-center d-none" id="btn2">
            <button type="submit" class="btn btn-success" id="reg">Confirm Registeration</button>
        </div>
        </form>
    </div>
    <script src="assets/script.js"></script>
</body>

</html>