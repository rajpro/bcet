<div class="be-content">
  <div class="main-content container-fluid">
    <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">Add Student<span class="panel-subtitle"></span></div>
          <div class="panel-body">
          <?=form_open_multipart(base_url('student/create'))?>
           <div class="form-group col-md-3">            
               <label>Academic Year <span style="color:red;">*</span></label>
                <?=form_dropdown('acid',$academicyear,(!empty($post['acid'])?$post['acid']:''),['class'=>'form-control input-sm','placeholder'=>'select any one','id'=>'aid'])?>
              </div>
              <div class="form-group col-md-3">
                <label>Course <span style="color:red;">*</span></label>
                <?=form_dropdown('course',$courses,(!empty($post['course'])?$post['course']:''),['class'=>'form-control input-sm','placeholder'=>'select any one','onchange'=>'findBranch()','id'=>'cid'])?>
              </div>
                <div class="form-group col-md-3">
                  <label>Branch <span style="color:red;">*</span></label>
                  <div class="brn">
                <?=form_dropdown('branch',['Choose Branch'],'',['class'=>'form-control input-sm','placeholder'=>'select any one','id'=>'bid'])?>
              </div>
               
                </div>
                <div class="form-group col-md-3">
                  <label>Name <span style="color:red;">*</span></label>
                  <?=form_input('name',set_value('name'),['class'=>'form-control input-sm','placeholder'=>'Enter Student name'])?>
                </div>
                <div class="form-group col-md-3">
                  <label>Father's Name <span style="color:red;">*</span></label>
                    <?=form_input('father_name',set_value('father_name'),['class'=>'form-control input-sm','placeholder'=>'Enter Father Name'])?>
                </div>
                <div class="form-group col-md-3">
                  <label>Mother's Name <span style="color:red;">*</span></label>
                    <?=form_input('mother_name',set_value('mother_name'),['class'=>'form-control input-sm','placeholder'=>'Enter Mother Name'])?>
                </div>
                <div class="form-group col-md-3">
                  <label>Date of birth <span style="color:red;">*</span></label>
                    <?=form_input('dob',set_value('dob'),['class'=>'form-control input-sm datepicker','placeholder'=>'Enter Date of birth'])?>
                </div>
                <div class="form-group col-md-3">
                  <label>Date of admission <span style="color:red;">*</span></label>
                    <?=form_input('doa',set_value('doa'),['class'=>'form-control input-sm datepicker','placeholder'=>'Enter Date of Admission'])?>
                </div>
                <div class="form-group col-md-3">
                  <label>Registration Number</label>
                  <div class="clearfix"></div>
                   <?=form_input('reg',set_value('reg'),['class'=>'form-control input-sm','placeholder'=>'Enter the Registration Number'])?>
                </div>
                
                <div class="form-group col-md-3">
                  <label>Roll Number <span style="color:red;">*</span></label>
                  <?=form_input('roll',set_value('roll'),['class'=>'form-control input-sm','placeholder'=>'Enter Roll Number'])?>
                </div>
                   
                <div class="form-group col-md-3">
                  <label>Email <span style="color:red;">*</span></label>
                 <?=form_input('email',set_value('email'),['class'=>'form-control input-sm','placeholder'=>'Enter the email'])?>
                </div>
                <div class="form-group col-md-3">
                  <label>Student Phone Number <span style="color:red;">*</span></label>
                    <?=form_input('stu_phone',set_value('stu_phone'),['class'=>'form-control input-sm','placeholder'=>'Enter the student phone number'])?>
                </div>
                <div class="form-group col-md-3">
                  <label>Parents Phone Number <span style="color:red;">*</span></label>
                    <?=form_input('par_phone',set_value('par_phone'),['class'=>'form-control input-sm','placeholder'=>'Enter the parents phone number'])?>
                </div>
                <div class="form-group col-md-3">
                  <label>Gender <span style="color:red;">*</span></label>
                  <div class="clearfix"></div>
                  <div class="be-radio inline">
                    <input type="radio" name="gender" value="male" id='male'>
                    <label for="male">Male</label>
                  </div>
                  <div class="be-radio inline">
                    <input type="radio" name="gender" value="female" id='female'>
                    <label for="female">Female</label>
                  </div>
                </div>
              
                <div class="form-group col-md-3">
                  <label>Blood Group</label>
                    <?=form_input('bgroup',set_value('bgroup'),['class'=>'form-control input-sm','placeholder'=>'Enter the blood Group'])?>
                </div>
                  <div class="form-group col-md-3">
                  <label>Caste  <span style="color:red;">*</span></label>
                     <?=form_dropdown('cast',['0'=>'Choose Caste','ST'=>'ST','SC'=>'SC','OBC'=>'OBC','GENERAL'=>'GENERAL','OTHERS'=>'OTHERS'],set_value('cast'),['class'=>'form-control input-sm'])?>
                </div> 
                <div class="form-group col-md-3">
                  <label>Parents Occupation</label>
                   <?=form_input('par_occupation',set_value('par_occupation'),['class'=>'form-control input-sm','placeholder'=>'Enter the parent Occupation'])?> 
                </div>
                
                <div class="form-group col-md-3">
                  <label>Address <span style="color:red;">*</span></label>
                  <?=form_textarea('address',set_value('address'),['class'=>'form-control input-sm','placeholder'=>'Enter the address'])?>
                </div>

                <div class="form-group col-md-3">
                 <label>Choose Pictures</label>
                <?=form_upload('userfile','')?>
                <span class="small">Photos must be less than 1mb</span>
              </div>
              <!-- section start -->
              <div class="form-group col-md-3">
                  <label>Section  <span style="color:red;">*</span></label>
                     <?=form_dropdown('section',['0'=>'Choose one','A'=>'A','B'=>'B'],'A',['class'=>'form-control input-sm'])?>
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
                