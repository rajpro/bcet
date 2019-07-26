<div class="be-content">
  <div class="main-content container-fluid">
    <?=$this->parser->parse('template/alert',[],TRUE);?>
    
    <div class="row">
      <div class="col-sm-12">
            <div class="panel panel-default panel-table">
          <div class="panel-heading">Check Uploaded Student
            <a class="btn btn-primary btn-xs pull-right" href="<?=base_url('student/insertmultiplestudent/true')?>" title="">Final Submit</a>
          </div>
          <div class="col-xs-12">
            <p class="text-right">
            </form>
            </p>
          </div>
          <div class="panel-body">
            <table class="table">
              <thead>
                <tr>
                  <th>Sl No</th>
                  <th>Name</th>
                  <th>Registration No.</th>
                  <th>Roll No.</th>
                  <th>Student Phone No</th>
                  <th>Parent Phone No</th>
                  <th>Branch</th>
                  <th>Address</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1;if(!empty($model)):foreach($model as $value): ?>
                <tr>
                  <td><?=$i++?></td>
                  <td><?=ucwords($value['name'])?></td>
                  <td><?=$value['reg']?></td>
                  <td><?=strtoupper($value['roll'])?></td>
                  <td><?=$value['stu_phone']?></td>
                  <td><?=$value['par_phone']?></td>
                  <td><?=$branches[$value['branch']]?></td>
                  <td><?=$value['address']?></td>
                </tr>
                <?php endforeach;endif; ?>
              </tbody>
            </table>
          </div>
          <hr>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div>