
        <h5>Complete your registration as an official</h5>
        <div class="container">
            <form method="POST" action="<?=base_url('officialupdate')?>" style="display: flex; flex-direction: column; align-items: center; width: 100%;">
                <div class="mb-3 text-center" style="align-items: center;">
                    <p>
                        <b>Name:</b> <?=$data['fname']?> <?=$data['lname']?> <br>
                        <b>LB:</b> <?=$data['lb']?> <br>
                        <b>Gender:</b> <?=$data['gender']?> <br>
                        <b>Category:</b> <?=$data['category']?> <br>
                        <b>House:</b> <?=$data['house']?> <br>
                    </p>
                    <label for="inputName" class="col-sm-1-12 col-form-label">Department:</label>
                    <div class="col-sm-1-12">
                        <select name="department" id="" required>
                            <option value="">Choose a department</option>
                            <option value="Media">Media</option>
                            <option value="Registry">Registry</option>
                            <option value="Kitchen">Kitchen</option>
                            <option value="Teaching">Teaching</option>
                            <option value="Guards">Guards</option>
                            <option value="PM">PM</option>
                            <option value="Accomodation">Accomodation</option>
                            <option value="Food_Service">Food_Service</option>
                            <option value="Logistics">Logistics</option>
                            <option value="Cooperate_Affairs">Cooperate_Affairs</option>
                            <option value="TFL">TFL</option>
                            <option value="Clinic">Clinic</option>
                        </select>
                        <input type="hidden" name="category" required value="Camp_Official">
                        <input type="hidden" name="id" required value="<?=$data['id']?>">
                        <input type="hidden" name="school" required value="<?=$data['school']?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update my Info</button>
                    </div>
                </div>
            </form>
        </div>
