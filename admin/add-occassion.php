 <form role="form" action="addOccassion.php" method="POST" enctype="multipart/form-data" id="add-occassion-form">
              <div class="box-body">
				
				<div class="form-group">
                  <label for="occasion">Occasion</label>
                  <input type="text" class="form-control" id="occasion" name="occasion" placeholder="Enter occasion" value="" required >
                </div>					 
				<div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="status">
                    <option value="1" >Active</option>
                    <option value="0" >In Active</option>                   
                  </select>
                </div>
          </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>