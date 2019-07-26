<div class="be-content">
  <div class="main-content container-fluid">
    <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">Add Branch<span class="panel-subtitle"></span></div>
          <div class="panel-body">
            <?=form_open_multipart(base_url('branch/create'))?>
            <div class="form-group col-md-3">
                <label>Course</label>
               <?=form_dropdown('course',$course,(!empty($post['course'])?$post['course']:''),['class'=>'form-control input-sm','placeholder'=>'select any one'])?>
              </div>
              <div class="form-group col-md-3">
                <label>Name</label>
                <?=form_input('branch_name',set_value('branch_name'),['class'=>'form-control input-sm','placeholder'=>'Enter Branch Name'])?>
              </div>
              <div class="form-group col-md-3">
                <label>Code</label>
                <?=form_input('code',set_value('code'),['class'=>'form-control input-sm','placeholder'=>'Enter Branch Code'])?>
              </div>
              <div class="form-group col-md-3">
                <label>Total No Of Seats</label>
                <?=form_input('seat',set_value('seat'),['class'=>'form-control input-sm','placeholder'=>'Enter Total No of Seats'])?>
              </div>
              <div class="form-group col-md-3">
                <label>Branch Description</label>
                <?=form_textarea('des',set_value('des'),['class'=>'form-control input-sm','placeholder'=>'Enter Branch Description'])?>
              </div>
               <div class="form-group col-md-3">
                 <label>Choose Pictures</label>
                <?=form_upload('pic','')?>
                <span class="small">Photos must be less than 1mb</span>
              </div>

              <div class="clearfix"></div>
              <div class="row xs-pt-15">
                
                <div class="col-xs-12">
                  <p class="text-right">
                    <button type="submit" class="btn btn-space btn-primary">Submit</button>
                    <button class="btn btn-space btn-default">Cancel</button>
                  </p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
                