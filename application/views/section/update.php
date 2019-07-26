<div class="be-content">
  <div class="main-content container-fluid">
    <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">Update Section<span class="panel-subtitle"></span></div>
          <div class="panel-body">
          <?=form_open(base_url('section/update'))?>
          <div class="form-group col-md-3">
                <label>Academic Year</label>
                <?=form_dropdown('acid',$academicyear,$model->acid,['class'=>'form-control input-sm','placeholder'=>'select any one'])?>  
              </div>
                <div class="form-group col-md-3">
                <label>Course</label>
                 <?=form_dropdown('course',$courses,$model->course,['class'=>'form-control input-sm','placeholder'=>'select any one','onchange'=>'findBranch()','id'=>'cid'])?>
                </div>
                <div class="form-group col-md-3">
                  <label>Branch</label>
                  <div class="brn">
                 <?=form_dropdown('branch',$branch,$model->branch,['class'=>'form-control input-sm','placeholder'=>'select any one','id'=>'bid'])?>
              </div>
                </div>                
                <div class="form-group col-md-3">
                  <label>Section</label>
                   <?=form_input('sec',$model->sec,['class'=>'form-control input-sm','placeholder'=>'Enter section'])?>
                </div>
                <div class="form-group col-md-3">
                  <label>Section From</label>
                   <?=form_input('stu_from',$model->stu_from,['class'=>'form-control input-sm','placeholder'=>'Enter Student from'])?>
                </div>
                <div class="form-group col-md-3">
                  <label>Section To</label>
                   <?=form_input('stu_to',$model->stu_to,['class'=>'form-control input-sm','placeholder'=>'Enter Student to'])?>
                </div>
                <div class="clearfix"></div>
                </div>              
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
          