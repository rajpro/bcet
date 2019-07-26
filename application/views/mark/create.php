<div class="be-content">
  <div class="main-content container-fluid">
    <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">Mark Filter<span class="panel-subtitle"></span></div>
          <div class="panel-body">
            <?=form_open(base_url('mark/create'))?>
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
               <div class="form-group col-md-3">
                <label>Test Name<span style="color:red;">*</span></label></label>
                <?=form_dropdown('test',$test,set_value('test'),['class'=>'form-control input-sm','placeholder'=>'Choose Test Name'])?>
              </div>
              <div class="form-group col-md-3">
                <label>Test Date<span style="color:red;">*</span></label></label>
                <?=form_input('test_date','',['class'=>'form-control input-sm datepicker_mark','placeholder'=>'Enter Test Date'])?>
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
              <div class="panel-heading">Enter Mark</div>
              <div class="panel-body">
              <?=form_open(base_url('mark/create'))?>
                <?=form_input(['type'=>'hidden','name'=>'semester','value'=>(!empty($post['semester'])?$post['semester']:'')])?>
                <?=form_input(['type'=>'hidden','name'=>'subject_id','value'=>(!empty($post['subject_id'])?$post['subject_id']:'')])?>
                 <?=form_input(['type'=>'hidden','name'=>'teacher','value'=>(!empty($post['teacher'])?$post['teacher']:'')])?>
                 <?=form_input(['type'=>'hidden','name'=>'test','value'=>(!empty($post['test'])?$post['test']:'')])?>
                 <?=form_input(['type'=>'hidden','name'=>'test_date','value'=>(!empty($post['test_date'])?$post['test_date']:'')])?>
                <table class="table">
                  <thead>
                    <tr>
                     <th>SL No</th>
                      <th>Student</th>
                      <th>Roll NO</th>
                              
                        <?php foreach($test as $ts): ?>
                            <th>  <?php echo $ts; ?> </th>
                        <?php endforeach; ?>
                        
                        <th>Total</th>           
               
                      <th class="actions"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1;if(!empty($model)):foreach($model as $value): ?>
                    <tr>
                      <td><?=$i++?></td>
                      <td><?=$value->name?></td>
                      <td><?=$value->roll?></td>
                      
                        <?=form_input(['type'=>'hidden','name'=>'stu[]','value'=>$value->id])?>
                        <?=form_input(['type'=>'hidden','name'=>'test_mark','id'=>'tsid','value'=>$full_mark->mark])?>
                        <?php foreach($test as $ts): ?>
                        <td>
                        <input type="text" name="mark[]" class="form-control input-xs" value="" id="mid<?=$value->id?>" onchange="markValid(<?=$value->id?>)">
                        </td>
                        <?php endforeach; ?>
                        <td>
                          <input type="text" name="total[]" class="form-control input-xs" value="" id="mid<?=$value->id?>" onchange="markValid(<?=$value->id?>)">
                         </td> 
                      
                      <td class="actions">
                      </td>
                    </tr>
                    <?php endforeach;endif; ?>
                  </tbody>
                </table>
                <div class="row xs-pt-15">
                <div class="col-xs-4">
                </div>
                <div class="col-xs-12">
                  <p class="text-right">
                    <button type="submit" class="btn btn-space btn-primary">Submit</button>
                    <button class="btn btn-space btn-default">Cancel</button>
                  </p>
                  </form>
                </div>
              </div>
              </div>
            </div>
          </div>
    </div>
  </div>
</div>