<?php 
  $time=array("8:00-9:00","9:00-10:00","10:00-11:00","11:00-12:00","12:00-13:00","13:00-14:00","14:00-15:00","15:00-16:00");
  $days=array("monday","tuesday","wednesday","thursday","friday","saturday");
?>
<div class="be-content">
  <div class="main-content container-fluid">
   <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">Create Timetable<span class="panel-subtitle"></span></div>
          <div class="panel-body">
             <?=form_open(base_url('timetable/create'))?>
              <div class="form-group col-md-3">
                <label>Academic Year <span style="color:red;">*</span></label>
                <?=form_dropdown('acid',$academicyear,(!empty($post['acid'])?$post['acid']:''),['class'=>'form-control input-sm','placeholder'=>'select any one','id'=>'acid'])?>
              </div>
              <div class="form-group col-md-3">
                <label>Course <span style="color:red;">*</span></label>
                <?=form_dropdown('course',$courses,(!empty($post['course'])?$post['course']:''),['class'=>'form-control input-sm','placeholder'=>'select any one','onchange'=>'findBranchtime()','id'=>'cid'])?>
              </div>
               <div class="form-group col-md-3">
                <label>Branch <span style="color:red;">*</span></label>
                <div class="brn">
                <?=form_dropdown('branch',$branch,(!empty($post['branch'])?$post['branch']:''),['class'=>'form-control input-sm','placeholder'=>'select any one','id'=>'bid'])?>
              </div>
            </div>
             <div class="form-group col-md-3">
                  <label>Semester <span style="color:red;">*</span></label>
                  <div class="sem">
                    <?=form_dropdown('semester',$semester,(!empty($post['semester'])?$post['semester']:''),['class'=>'form-control input-sm','placeholder'=>'Choose Semester','disabled'=>'disabled','id'=>'sid'])?>
                </div>
              </div>
              <div class="form-group col-md-3">
                  <label>Section<span style="color:red;">*</span></label>
                  <?=form_dropdown('sec',['1'=>"A",'2'=>"B"],set_value('sec'),['class'=>'form-control input-sm'])?>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-md-12 text-center">
              </div>
              <div class="clearfix"></div>
              <?php if(!empty($timetable)): ?>
              <div class='col-md-12'>
                <table class="table table-bordered">
                <tr>
                  <td></td>
                <?php foreach($time as $value): ?>
                <th><?=$value?></th>
                <?php endforeach; ?>
                </tr>
                <?php foreach ($days as $key => $value):?>
                 <tr>
                  <th>
                    <?=ucwords($value)?>
                  </th>
                  <?php for($i=0;$i<count($time);$i++): ?>
                  <?php
                    $ts = explode("-",$time[$i]);
                  ?>
                    <td>
                      <input type="hidden" value="<?=$value?>" name="days[]">
                      <input type="hidden" value="<?=$ts[0]?>" name="stime[]">
                      <input type="hidden" value="<?=$ts[1]?>" name="etime[]">
                      <div class="form-group">
                      <?=form_dropdown('teacher_id[]',$timetable['teachers'],'',['class'=>'form-control input-sm'])?>
                      </div>
                      <div class="form-group">
                      <?=form_dropdown('subject_id[]',$timetable['subjects'],'',['class'=>'form-control input-sm'])?>
                      </div>
                    </td>
                  <?php endfor; ?>
                </tr>
               <?php endforeach; ?>

                </table>
              </div>
              <div class="clearfix"></div>
              <div class="row xs-pt-15">
                <div class="col-xs-4"></div>
                <div class="col-xs-12">
                  <p class="text-right">
                    <button type="submit" class="btn btn-space btn-primary">Add Timetable</button>
                  </p>
                </div>
              </div>
              <?php else: ?>
              <div class="clearfix"></div>
              <div class="row xs-pt-15">
                <div class="col-xs-4"></div>
                <div class="col-xs-12">
                  <p class="text-right">
                    <button type="submit" class="btn btn-space btn-primary">Search</button>
                  </p>
                </div>
              </div>
              <?php endif; ?>
            </form>
          </div>
        </div>
      </div>
     </div>
    </div>
   </div>
 </div>