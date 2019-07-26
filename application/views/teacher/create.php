<?php 
  $ha=array('asstprof'=>"Assistant Professor",'hod_asstprof'=>"Assistant professor & Hod",'principal'=>"Principal",'hod_prof'=>"Professor and Hod",'prof'=>"Professor",'dydirector'=>"Deputy Director",'director'=>"Director",'chairman'=>"Chairman",'hod'=>"Hod",'labasst'=>"Lab Assistant");
?>

<div class="be-content">
  <div class="main-content container-fluid">
   <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">Add Teacher<span class="panel-subtitle"></span></div>
          <div class="panel-body">
             <?=form_open_multipart(base_url('teacher/create'))?>
              
              <div class="form-group col-md-3">
                <label>Course <span style="color:red;">*</span></label>
                <?=form_dropdown('course',$courses,set_value('course'),['class'=>'form-control input-sm','placeholder'=>'select any one','onchange'=>'findBranch()','id'=>'cid'])?>
              </div>
              <div class="form-group col-md-3">
                <label>Branch <span style="color:red;">*</span></label>
                <div class="brn">
                <?=form_dropdown('branch',$branches,set_value('branch'),['class'=>'form-control input-sm','placeholder'=>'select any one','id'=>'bid'])?>
                </div>
              </div>
              <div class="form-group col-md-3">
                  <label>Name<span style="color:red;">*</span></label>
                   <?=form_input('name',set_value('name'),['class'=>'form-control input-sm','placeholder'=>'Enter teacher Name'])?>
              </div>
             
              <div class="form-group col-md-3">
                  <label>Registration No.<span style="color:red;">*</span></label>
                   <?=form_input('reg_no',set_value('reg_no'),['class'=>'form-control input-sm','placeholder'=>'Enter registration no'])?>
              </div>
              <div class="form-group col-md-3">
                <label>Date Of Joining<span style="color:red;">*</span></label>
                 <?=form_input('d_o_joining',set_value('d_o_joining'),['class'=>'form-control input-sm datepicker','placeholder'=>'Enter Date Of Joining'])?>
              </div>
              <div class="form-group col-md-3">
                <label>Designation<span style="color:red;">*</span></label>
                 <?=form_dropdown('designation',$ha,set_value('designation'),['class'=>'form-control input-sm','placeholder'=>'Enter designation '])?>
              </div>
              
              <div class="form-group col-md-3">
                <label>Salary<span style="color:red;">*</span></label>
                <?=form_input('salary',set_value('salary'),['class'=>'form-control input-sm','placeholder'=>'Enter salary amount '])?>
              </div>
               <div class="form-group col-md-3">
                <label>Qualification<span style="color:red;">*</span></label>
                <?=form_input('qua',set_value('qua'),['class'=>'form-control input-sm','placeholder'=>'Enter Teacher Qualification '])?>
              </div>
               <div class="form-group col-md-3">
                <label>Email<span style="color:red;">*</span></label>
                <?=form_input('email',set_value('email'),['class'=>'form-control input-sm','placeholder'=>'Enter Email '])?>
              </div>
               <div class="form-group col-md-3">
                <label>Phone No<span style="color:red;">*</span></label>
                <?=form_input('ph_no',set_value('ph_no'),['class'=>'form-control input-sm','placeholder'=>'Enter Phone Number '])?>
              </div>
              <div class="form-group col-md-3">
                <label>Username<span style="color:red;">*</span></label>
                <?=form_input('username',set_value('username'),['class'=>'form-control input-sm','placeholder'=>'Enter Username '])?>
              </div>
              <div class="form-group col-md-3">
                <label>Password<span style="color:red;">*</span></label>
                <?=form_input('password','',['class'=>'form-control input-sm','placeholder'=>'Enter Password '])?>
              </div>
              <div class="form-group col-md-3">
             <label>Choose Pictures</label>
            <?=form_upload('userfile','')?>
            <span class="small">Photos must be less than 1mb</span>
              </div>
              <div class="form-group col-md-3">
                  <label>Teacher Experience</label>
                   <?=form_textarea('bio',set_value('bio'),['class'=>'form-control input-sm','placeholder'=>'Enter Teacher Experience'])?>
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
 </div>
                