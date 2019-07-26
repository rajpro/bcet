<div class="be-content">
  <div class="main-content container-fluid">
    <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">Add Section<span class="panel-subtitle"></span></div>
          <div class="panel-body">
          <?=form_open(base_url('section/create'))?>
          <div class="form-group col-md-3">
            <label>Academic Year <span style="color:red;">*</span></label>
                <?=form_dropdown('acid',$academicyear,set_value('acid'),['class'=>'form-control input-sm','placeholder'=>'select any one'])?>
              </div>
            
                <div class="form-group col-md-3">
                  <label>Course <span style="color:red;">*</span></label>
                <?=form_dropdown('course',$courses,set_value('course'),['class'=>'form-control input-sm','placeholder'=>'select any one','onchange'=>'findBranch()','id'=>'cid'])?>
                </div>
                <div class="form-group col-md-3">
                  <label>Branch <span style="color:red;">*</span></label>
                  <div class="brn">
                <?=form_dropdown('branch',['Choose Branch'],'',['class'=>'form-control input-sm','placeholder'=>'select any one','id'=>'bid'])?>
              </div>
            </div>
             
                <div class="form-group col-md-3">
                  <label>Section<span style="color:red;">*</span></label>
                  <?=form_dropdown('sec',['1'=>"A",'2'=>"B"],set_value('section'),['class'=>'form-control input-sm'])?>
                </div>
                
                
                <div class="form-group col-md-3">
                  <label>Student From<span style="color:red;">*</span></label>
                  <?=form_input('stu_from',set_value('stu_from'),['class'=>'form-control input-sm','placeholder'=>'Enter Student Starting no'])?>
                </div>
                <div class="form-group col-md-3">
                  <label>Student To<span style="color:red;">*</span></label>
                  <?=form_input('stu_to',set_value('stu_to'),['class'=>'form-control input-sm','placeholder'=>'Enter Student Ending no'])?>
                </div>
                
                <div class="row xs-pt-15">
                <div class="col-xs-4">
                </div>
                <div class="col-xs-12">
                  <p class="text-right">
                    <button type="submit" class="btn btn-space btn-primary">Submit</button>
                    <button class="btn btn-space btn-default">Cancel</button>
                  </p>
                </div>
              </div>