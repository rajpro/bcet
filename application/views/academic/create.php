<div class="be-content">
  <div class="main-content container-fluid">
   <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">Academic Add<span class="panel-subtitle"></span></div>
          <div class="panel-body">
           <?=form_open(base_url('academic/create'))?>
            <form>
                <div class="form-group col-md-3">
                  <label>Academic Name</label>
                  <?=form_input('academic_name',set_value('academic_name'),['class'=>'form-control input-sm','placeholder'=>'Enter Academic Name'])?>
                </div>             
                <div class="form-group col-md-3">
                  <label>Start Year</label>
                  <?=form_input('start_year',set_value('start_year'),['class'=>'form-control input-sm datepicker','placeholder'=>'Enter Start Year'])?>
                </div>
                <div class="form-group col-md-3">
                  <label>End Year</label>
                  <?=form_input('end_year',set_value('end_year'),['class'=>'form-control input-sm datepicker_mark','placeholder'=>'Enter End Year'])?>
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
                