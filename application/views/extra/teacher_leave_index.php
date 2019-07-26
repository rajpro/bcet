<div class="be-content">
  <div class="main-content container-fluid">
    <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">Leave Applications
          <?php if($this->session->user_type!=1): ?> 
            <a href="<?=base_url('teacherleave/teacher_leave_create')?>" class="btn btn-sm btn-space btn-primary pull-right">Request for a leave</a>
            <?php endif; ?>
          </div>
          <div class="panel-body">
            <table class="table">
              <thead>
                <tr>
                  <th>Sl No.</th>
                  <?php if($this->session->user_type==1): ?>
                  <th>Teacher Name</th>
                  <?php endif; ?>
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
                  <?php if($this->session->user_type==1): ?>
                  <td><?=$value->emp_id?></td>
                  <?php endif; ?>
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
                          echo '<span class="badge badge-warning">HOD Pending</span>';
                          break;
                        case 'principal_pending':
                          echo '<span class="badge badge-warning">Principal Pending</span>';
                          break;
                        case 'active':
                          echo '<span class="badge badge-success">Leave Approved</span>';
                          break;
                      }
                    ?>
                  </td>
                  <?php if($this->session->user_type==1&&$value->status=='pending'): ?>
                  <td class="actions">
                    <a href="<?=base_url('teacherleave/leaveApproval/'.$value->id)?>" class="badge badge-success">Accepted</a>
<!--                     <a href="<?=base_url('teacherleave/leaveRejected/'.$value->id)?>" class="badge badge-danger">Rejected</a> -->
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