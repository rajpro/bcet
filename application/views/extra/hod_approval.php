<div class="be-content">
  <div class="main-content container-fluid">
    <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">List of Class Adjustment Requests
          </div>
          <div class="panel-body">
            <table class="table">
              <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Teacher</th>
                  <th>Leave Subject</th>
                  <th>Date From</th>
                  <th>Date To</th>
                  <th>Status</th>
                  <th class="actions"></th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1;if(!empty($model)):foreach($model as $value): ?>
                <tr>
                  <td><?=$i++?></td>
                  <td><?=$teachers[$value->emp_id]?></td>
                  <td><?=$value->leave_sub?></td>
                  <td><?=$value->date_from?></td>
                  <td><?=$value->date_to?></td>
                  <td>
                    <?php
                      switch ($value->status) {
                        case 'teacher_pending':
                          echo '<span class="badge badge-warning">Teacher Pending</span>';
                          break;
                        case 'hod_pending':
                          echo '<span class="badge badge-warning">Approval Pending</span>';
                          break;
                        case 'principal_pending':
                          echo '<span class="badge badge-success">Principal Pending</span>';
                          break;
                        case 'active':
                          echo '<span class="badge badge-success">Approved</span>';
                          break;
                      }
                    ?>
                  </td>
                  <?php if($value->status=='hod_pending'): ?>
                  <td class="actions">
                    <a href="<?=base_url('teacherleave/hod_approve_ok/'.$value->id)?>" class="badge badge-success">Accepted</a>
                  </td>
                  <?php endif; ?>
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