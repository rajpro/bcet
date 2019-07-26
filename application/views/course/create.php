<div class="be-content">
  <div class="main-content container-fluid">
  <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">Add Course<span class="panel-subtitle"></span></div>
          <div class="panel-body">
           <?=form_open(base_url('course/create'))?>
            <form>            
                <div class="form-group col-md-3">
                  <label>Course Name</label>
                 <?=form_input('name',set_value('name'),['class'=>'form-control input-sm','placeholder'=>'Enter Course Name'])?>
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
                