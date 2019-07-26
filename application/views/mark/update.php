<div class="be-content">
  <div class="main-content container-fluid">
    <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">Mark Filter<span class="panel-subtitle"></span></div>
          <div class="panel-body">
            <?=form_open(base_url('mark/update'))?>
              <div class="form-group col-md-4">
                <label>Academic Year <span style="color:red;">*</span></label>
                <?=form_dropdown('acid',$academicyear,(!empty($post['acid'])?$post['acid']:''),['class'=>'form-control','placeholder'=>'select any one','id'=>'aid'])?>
              </div>
              <div class="form-group col-md-4">
                <label>Course <span style="color:red;">*</span></label>
                <?=form_dropdown('course',$course,'',['class'=>'form-control','placeholder'=>'select any one','onchange'=>'findBranch()','id'=>'cid'])?>
              </div>
              <div class="form-group col-md-4">
                <label>Branch <span style="color:red;">*</span></label>
                <div class="brn">
                <?=form_dropdown('branch',['Choose Branch'],'',['class'=>'form-control','placeholder'=>'select any one','id'=>'bid'])?>
                </div>
              </div>
             <div class="form-group col-md-4">
                <label>Semester<span style="color:red;">*</span></label></label>
                 <div class="sem">
                <?=form_dropdown('semester',['Choose Semester'], '',['class'=>'form-control','placeholder'=>'Choose Semester','onchange'=>'findTeacher()','id'=>'sid'])?>
              </div>
               </div>
               <div class="form-group col-md-4">
                <label>Teacher Name<span style="color:red;">*</span></label></label>
                 <div class="tea">
                <?=form_dropdown('teacher',['Choose Teacher'], '',['class'=>'form-control','placeholder'=>'Choose Teacher Name','onchange'=>'findSubject()','id'=>'tid'])?>
              </div>
              </div>
                <div class="form-group col-md-4">
                <label>Subject Name<span style="color:red;">*</span></label></label>
                 <div class="sub">
                <?=form_dropdown('subject_id',['Choose Subject'], '',['class'=>'form-control','placeholder'=>'Choose Subject','id'=>'sbid'])?>
              </div>
               </div>
               <div class="form-group col-md-4">
                <label>Test Name<span style="color:red;">*</span></label></label>
                <?=form_dropdown('test',$test, '',['class'=>'form-control','placeholder'=>'Choose Test Name'])?>
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
          <div class="panel-heading">View Mark</div>
          <div class="panel-body">
            <table class="table">
              <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Student Name</th>
                  <th>Roll No</th>
                  <th>Test</th>
                  <th>Full Mark</th>
                  <th>Secured Mark</th>
                  <th>Graph</th>
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
                        <?php 
                          foreach ($tests_head as $val) {
                            echo $test[$val->test_id]."<br>";
                          }
                        ?>
                     </td>
                     <td>
                        <?php 
                          foreach ($tests_head as $val) {
                            echo $tests_mark[$val->test_id]."<br>";
                          }
                        ?>
                      </td>
                      <td>
                        <?php 
                          foreach ($tests_head as $val) {
                            echo $secured_mark[$value->id][$val->test_id]."<br>";
                          }
                        ?>
                      </td>
                  <td class="actions">
                    <a href="<?=base_url('branch/update/'.$value->id)?>" class="icon"><i class="mdi mdi-edit"></i></a>
                    <a href="#" class="icon"><i class="mdi mdi-delete"></i></a>
                  </td>
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