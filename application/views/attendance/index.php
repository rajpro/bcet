<div class="be-content">
  <div class="main-content container-fluid">
    <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">Attendance Filter<span class="panel-subtitle"></span></div>
          <div class="panel-body">
            <?=form_open(base_url('attendance/index'))?>
             <!--  <div class="form-group col-md-3">            
               <label>Academic Year <span style="color:red;">*</span></label>
                <?=form_dropdown('acid',$academicyear,(!empty($post['acid'])?$post['acid']:''),['class'=>'form-control input-sm','placeholder'=>'select any one','id'=>'aid'])?>
              </div>
              <div class="form-group col-md-3">
                <label>Course <span style="color:red;">*</span></label>
                <?=form_dropdown('course',$courses,'',['class'=>'form-control input-sm','placeholder'=>'select any one','onchange'=>'findBranch()','id'=>'cid'])?>
              </div>
                <div class="form-group col-md-3">
                <label>Branch <span style="color:red;">*</span></label>
                <div class="brn">
                <?=form_dropdown('branch',['Choose Branch'],'',['class'=>'form-control input-sm','placeholder'=>'select any one','id'=>'bid'])?>
                </div>
              </div>
             <div class="form-group col-md-3">
                <label>Semester<span style="color:red;">*</span></label></label>
                 <div class="sem">
                <?=form_dropdown('semester',['Choose Semester'], '',['class'=>'form-control input-sm','placeholder'=>'Choose Semester','onchange'=>'findTeacher()','id'=>'sid'])?>
              </div>
               </div> -->
               <!-- added by me -->
 <div class="form-group col-md-3">
                <label>Course <span style="color:red;">*</span></label>
                <?=form_dropdown('course',$courses,(!empty($post['course'])?$post['course']:''),['class'=>'form-control input-sm','placeholder'=>'select any one','onchange'=>'findBranchatend()','id'=>'cid'])?>
              </div>
              <div class="form-group col-md-3">
                <label>Branch <span style="color:red;">*</span></label>
                <div class="brn">
                <?=form_dropdown('branch',['Choose Branch'],(!empty($post['branch'])?$post['branch']:''),['class'=>'form-control input-sm','placeholder'=>'select any one','onchange'=>'findSemesterAtendance()','disabled'=>'disabled','id'=>'bid'])?>
                </div>
              </div>
             <div class="form-group col-md-3">
                <label>Semester<span style="color:red;">*</span></label></label>
                 <div class="sem">
                <?=form_dropdown('semester',['Choose Semester'], (!empty($post['semester'])?$post['semester']:''),['class'=>'form-control input-sm','placeholder'=>'Choose Semester','onchange'=>'findTeacher()','disabled'=>'disabled','id'=>'sid'])?>
              </div>
               </div>


               <!-- end here -->
               <div class="form-group col-md-3">
                <label>Teacher Name<span style="color:red;">*</span></label></label>
                 <div class="tea">
                <?=form_dropdown('teacher',['Choose Teacher'], '',['class'=>'form-control input-sm','placeholder'=>'Choose Teacher Name','onchange'=>'findSubject()','id'=>'tid'])?>
              </div>
              </div>
                <div class="form-group col-md-3">
                <label>Subject Name<span style="color:red;">*</span></label></label>
                 <div class="sub">
                <?=form_dropdown('subject_id',['Choose Subject'], '',['class'=>'form-control input-sm','placeholder'=>'Choose Subject','id'=>'sbid'])?>
              </div>
               </div>
              <div class="clearfix"></div>
              <div class="row xs-pt-15">
                
                <div class="col-xs-12">
                  <p class="text-right">
                    <button type="submit" class="btn btn-space btn-primary">Search</button>
                    <button class="btn btn-space btn-default">Cancel</button>
                  </p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
            <div class="panel panel-default panel-table">
              <div class="panel-heading">Attendance List</div>
              <div class="panel-body">
                <table class="table">
                  <thead>
                    <tr>
                     <th>SL No</th>
                      <th>Student</th>
                      <th>Roll No</th>
                      <th>Attendance Percentage</th>
                      <!-- <th>Graph</th> -->
                      <!-- <th class="actions"></th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1;if(!empty($model)):foreach($model as $value): ?>
                    <tr>
                      <td><?=$i?></td>
                      <td><?=$value->name?></td>
                      <td><?=$value->roll?></td>
                      <td><?=$percent[$value->id]?>%</td>
                      <!-- <td><span class="sparklinebasic<?=$i++?>">8,4,0,0,0,0,1,4,4,10,10,10,10,0,0,0,4,6,5,9,10</span></td> -->
                      <!-- <td class="actions">
                        <a href="<?=base_url('attendance/view/'.$value->id)?>" class="icon"><i class="mdi mdi-desktop-mac"></i></a>
                      </td> -->
                    </tr>
                    <?php endforeach;endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    </div>
  </div>
</div>