<div class="be-content">
  <div class="main-content container-fluid">
    <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">Update Student<span class="panel-subtitle"></span></div>
          <div class="panel-body">
          <?=form_open_multipart(base_url('student/update/'.$model->id))?>
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
                  <label>Name</label>
                  <?=form_input('name',$model->name,['class'=>'form-control input-sm','placeholder'=>'Enter student  Name'])?>
                </div>
                
                <div class="form-group col-md-3">
                  <label>Father's Name</label>
                    <?=form_input('father_name',$model->father_name,['class'=>'form-control input-sm','placeholder'=>'Enter Fathers Name'])?>
                </div>
                <div class="form-group col-md-3">
                  <label>Mother's Name</label>
                    <?=form_input('mother_name',$model->mother_name,['class'=>'form-control input-sm','placeholder'=>'Enter Mothers Name'])?>
                </div>
                <div class="form-group col-md-3">
                  <label>Date of birth</label>
                    <?=form_input('dob',$model->dob,['class'=>'form-control input-sm datepicker','placeholder'=>'Enter  date of birth'])?>
                </div>
                <div class="form-group col-md-3">
                  <label>Date of Admission</label>
                    <?=form_input('doa',$model->doa,['class'=>'form-control input-sm datepicker','placeholder'=>'Enter  date of admission'])?>
                </div>  
                <div class="form-group col-md-3">
                  <label>Registration Number</label>
                   <?=form_input('reg',$model->reg,['class'=>'form-control input-sm','placeholder'=>'Enter  Registration number'])?>
                </div>
                
                <div class="form-group col-md-3">
                  <label>Roll Number</label>
                  <?=form_input('roll',$model->roll,['class'=>'form-control input-sm','placeholder'=>'Enter  Roll Number'])?>
                </div>
                   
                <div class="form-group col-md-3">
                  <label>Email</label>
                 <?=form_input('email',$model->email,['class'=>'form-control input-sm','placeholder'=>'Enter  Email Address'])?>
                </div>
                <div class="form-group col-md-3">
                  <label>Student Phone Number</label>
                    <?=form_input('stu_phone',$model->stu_phone,['class'=>'form-control input-sm','placeholder'=>'Enter  Student Phone Number'])?>
                </div>
                <div class="form-group col-md-3">
                  <label>Parents Phone Number</label>
                    <?=form_input('par_phone',$model->par_phone,['class'=>'form-control input-sm','placeholder'=>'Enter the parents phone number'])?>
                </div>
                <div class="form-group col-md-3">
                  <label>Gender</label>
                  <div class="clearfix"></div>
                  <div class="be-radio inline">
                    <input type="radio" name="gender" value="male" id='male' <?=($model->gender=='male')?"checked":""?>>
                    <label for="male">Male</label>
                  </div>
                  <div class="be-radio inline">
                    <input type="radio" name="gender" value="female" id='female' <?=($model->gender=='female')?"checked":""?>>
                    <label for="female">Female</label>
                  </div>
                </div>
                
                <div class="form-group col-md-3">
                  <label>Blood Group</label>
                     <?=form_input('bgroup',$model->bgroup,['class'=>'form-control input-sm','placeholder'=>'Enter  Blood group'])?>
                </div>
                <div class="form-group col-md-3">
                  <label>Caste</label>
                     <?=form_dropdown('cast',['0'=>'Choose Caste','ST'=>'ST','SC'=>'SC','OBC'=>'OBC','GENERAL'=>'GENERAL','OTHERS'=>'OTHERS'],$model->cast,['class'=>'form-control input-sm'])?>
                </div> 
                <div class="form-group col-md-3">
                  <label>Parents Occupation</label>
                    <?=form_input('par_occupation',$model->par_occupation,['class'=>'form-control input-sm','placeholder'=>'Enter Parent Occupation'])?>
                </div>
                
                <div class="form-group col-md-3">
                  <label>Address</label>
                   <?=form_textarea('address',$model->address,['class'=>'form-control input-sm','placeholder'=>'Enter Address'])?>
                </div>
                 <div class="form-group col-md-3">
                 <label>Choose Pictures</label>
                <?=form_upload('userfile','')?>
                <span class="small">Photos must be less than 1mb</span>
              </div>
              <div class="form-group col-md-3">
                <label>Status</label>
                <?=form_dropdown('status',['active'=>'Active','deactive'=>'Deactive'],$model->status,['class'=>'form-control input-sm'])?>
              </div>
<!-- section start -->
              <div class="form-group col-md-3">
                  <label>Section  <span style="color:red;">*</span></label>
                    <?=form_dropdown('section',['0'=>'Choose one','A'=>'A','B'=>'B'],$model->section,['class'=>'form-control input-sm'])?>             
                </div> 

               <!-- section edn -->

                <div class="clearfix"></div>
                </div>
              <div class="clearfix"></div>
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
            </form>
          </div>
        </div>
      </div>
     </div>
    </div>
   </div>
                