            <div class="be-content">
  <div class="main-content container-fluid">
    <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default">
                <div class="panel-heading">Student Details
                  
                </div>
                <div class="panel-body">
                  <table class="table table-condensed table-hover table-bordered table-striped">
                    <tbody>
                      <tr>
                        <td><b>Name</b></td>
                        <td><?=ucwords($model->name)?></td>
                        <td><b>Father Name</b></td>
                        <td><?=ucwords($model->father_name)?></td>
                        <td><b>Mother Name</b></td>
                        <td><?=ucwords($model->mother_name)?></td>
                      </tr>
                        
                        <td><b>Date of birth</b></td>
                        <td><?=$model->dob?></td>
                         <td><b>Date of admission</b></td>
                        <td><?=$model->doa?></td>
                        <td><b>Adress</b></td>
                        <td><?=$model->address?></td>
                      </tr>
                      <tr>
                         <td><b>Roll no</b></td>
                        <td><?=$model->roll?></td>
                        <td><b>Registration No</b></td>
                        <td><?=$model->reg?></td>
                        <td><b>Parent Occupation</b></td>
                        <td><?=$model->par_occupation?></td>
                      </tr>
                       <tr>  
                        <td><b>Branch</b></td>
                        <td><?=$branch->branch_name?></td>
                        <td><b>Email</b></td>
                        <td><?=$model->email?></td>
                        <td><b>Student Phone No</b></td>
                        <td><?=$model->stu_phone?></td>
                      </tr>
                       <tr>
                         <td><b>Parent Phone No</b></td>
                        <td><?=$model->par_phone?></td>
                        <td><b>Gender</b></td>
                        <td><?=strtoupper($model->gender)?></td>
                        <td><b>Course</b></td>
                        <td><?=ucwords($course->name)?></td>
                      </tr>
                       <tr>
                         <td><b>Blood Group</b></td>
                        <td><?=strtoupper($model->bgroup)?></td>
                        <td><b>Photo</b></td>
                        <td><img src="<?=base_url('studentimages/'.$model->pic)?>" height="42" width="42"></td>
                        <td><b>Caste</b></td>
                        <td><?=$model->cast?></td>  
                      </tr>
                      <tr>
                        <td><b>Academic Year</b></td>
                        <td><?=$academic->academic_name?></td>
                        <td><b>Section</b></td>
                        <td><?=ucwords($model->section)?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>