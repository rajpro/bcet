<div class="be-content">
  <div class="main-content container-fluid">
   <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">Create Class Extend<span class="panel-subtitle"></span></div>
          <div class="panel-body">
             <?=form_open(base_url('classextend/class_extend_create'))?>
                           <div class="form-group col-md-3">
                <label>Academic Year <span style="color:red;">*</span></label>
                <?=form_dropdown('acid',$academicyear,(!empty($post['acid'])?$post['acid']:''),['class'=>'form-control input-sm','placeholder'=>'select any one','id'=>'aid'])?>
              </div>
              <div class="form-group col-md-3">
                <label>Course <span style="color:red;">*</span></label>
                <?=form_dropdown('course',$course,(!empty($post['course'])?$post['course']:''),['class'=>'form-control input-sm','placeholder'=>'select any one','onchange'=>'findBranch()','id'=>'cid'])?>
              </div>
              <div class="form-group col-md-3">
                <label>Branch <span style="color:red;">*</span></label>
                <div class="brn">
                <?=form_dropdown('branch',['Choose Branch'],(!empty($post['branch'])?$post['branch']:''),['class'=>'form-control input-sm','placeholder'=>'select any one','id'=>'bid'])?>
                </div>
              </div>
             <div class="form-group col-md-3">
                <label>Semester<span style="color:red;">*</span></label></label>
                 <div class="sem">
                <?=form_dropdown('semester',['Choose Semester'], '',['class'=>'form-control input-sm','placeholder'=>'Choose Semester','onchange'=>'findTeacher()','id'=>'sid'])?>
              </div>
               </div> 
              <div class="clearfix"></div>
              <div class="row xs-pt-15">
                <div class="col-xs-4"></div>
                <div class="col-xs-12">
                  <p class="text-right">
                    <button type="submit" class="btn btn-space btn-primary">Add Class Extend</button>
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
 </div>