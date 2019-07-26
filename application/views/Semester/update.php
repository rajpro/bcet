<div class="be-content">
  <div class="main-content container-fluid">
    <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">Update Semester<span class="panel-subtitle"></span></div>
          <div class="panel-body">
            <?=form_open(base_url('semester/update/'.$model->id))?>
              <div class="form-group col-md-3">
                <label>Semester Name</label>
                <?=form_input('name', $model->name,['class'=>'form-control input-sm','placeholder'=>'Enter semester Name'])?>
              </div>
              <div class="form-group col-md-3">
                <label>Course</label>
                <?=form_dropdown('course_id',$courses,$model->course_id,['class'=>'form-control input-sm','placeholder'=>'select any one'])?>
              </div>
              <div class="clearfix"></div> 
              <div class="row xs-pt-15">
                <div class="col-xs-4">
                </div>
                <div class="col-xs-4">
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