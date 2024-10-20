        <h5><a href="<?=base_url('/')?>">Home</a></h5>
        <h5>Input your Official Departmental pin to proceed</h5>
        <div class="container">
            <form method="POST" action="<?=base_url('officialreg')?>" style="display: flex; flex-direction: column; align-items: center; width: 100%;">
                <div class="mb-3 row" style="align-items: center;">
                    <label for="inputName" class="col-sm-1-12 col-form-label">Login Pass:</label>
                    <div class="col-sm-1-12">
                        <input type="text" class="form-control" style="width: 200px;" name="pin" id="pin" placeholder="e.g N097C" required value="<?=$pin?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Login as Camp Official</button>
                    </div>
                </div>
            </form>
        </div>
