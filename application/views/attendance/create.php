<div class="be-content">
  <div class="main-content container-fluid">
    <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">Attendance Filter<span class="panel-subtitle"></span></div>
          <div class="panel-body">
            <?=form_open(base_url('attendance/create'))?>
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
                <div class="form-group col-md-3">
                <label>Subject Name<span style="color:red;">*</span></label></label>
                 <div class="sub">
                <?=form_dropdown('subject_id',['Choose Subject'],(!empty($post['subject_id'])?$post['subject_id']:''),['class'=>'form-control input-sm','placeholder'=>'Choose Subject','disabled'=>'disabled','id'=>'sbid'])?>
              </div>
               </div>
               <div class="form-group col-md-3">
                  <label>Attendance Date<span style="color:red;">*</span></label>
                    <?=form_input('attendent_date',(!empty($post['attendent_date'])?$post['attendent_date']:''),['class'=>'form-control input-sm datepicker','placeholder'=>'Enter Attendance Date'])?>
                </div>
              <div class="clearfix"></div>
              <div class="row xs-pt-15">
                <div class="col-xs-4">
                </div>
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
              <div class="panel-heading">Attendance<br>
                <p class="text-danger">(Deselect the checkbox, for the student, who are absent, and then click Submit.)</p>
              </div>
              <div class="panel-body">
                <?=form_open(base_url('attendance/create'))?>
                <?=form_input(['type'=>'hidden','name'=>'semester','value'=>(!empty($post['semester'])?$post['semester']:'')])?>
                <?=form_input(['type'=>'hidden','name'=>'subject_id','value'=>(!empty($post['subject_id'])?$post['subject_id']:'')])?>
                 <?=form_input(['type'=>'hidden','name'=>'teacher','value'=>(!empty($post['teacher'])?$post['teacher']:'')])?>
                 <?=form_input(['type'=>'hidden','name'=>'attendent_date','value'=>(!empty($post['attendent_date'])?$post['attendent_date']:'')])?>
                <table class="table">
                  <thead>
                    <tr>
                     <th>SL No</th>
                      <th>Student</th>
                      <th>Roll NO</th>
                      <th>Attendance</th>
                      <th class="actions"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1;if(!empty($model)):foreach($model as $value): ?>
                    <tr>
                      <td><?=$i++?></td>
                      <td><?=$value->name?></td>
                      <td><?=$value->roll?></td>
                      <td> 
                        <?=form_input(['type'=>'hidden','name'=>'stu[]','value'=>$value->id])?>
                       <input type="checkbox" name="attendance[]" checked value="<?=$value->id?>" ></td>
                      <td></td>
                    </tr>
                    <?php endforeach;endif; ?>
                  </tbody>
                </table>
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
            </div>
          </div>
    </div>
  </div>
</div>