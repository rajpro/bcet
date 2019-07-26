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
                  <th>Course</th>
                  <th>Branch</th>
                  <th>Requested Teacher</th>
                  <th>Semester</th>
                  <th>For Date</th>
                  <th>Status</th>
                  <th class="actions"></th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1;if(!empty($model)):foreach($model as $value): ?>
                <tr>
                  <td><?=$i++?></td>
                  <td><?=$course[$value->course]?></td>
                  <td><?=$branch[$value->branch]?></td>
                  <td><?=$teachers[$value->teacher]?></td>
                  <td><?=$value->semester?></td>
                  <td><?=$value->extend_date?></td>
                  <td>
                    <?php
                      switch ($value->status) {
                        case 'pending':
                          echo '<span class="badge badge-warning">Pending</span>';
                          break;
                        case 'approved':
                          echo '<span class="badge badge-success">Approved</span>';
                          break;
                        case 'canceled':
                          echo '<span class="badge badge-danger">Canceled</span>';
                          break;
                      }
                    ?>
                  </td>
                  <?php if($value->status=='pending'): ?>
                  <td class="actions">
                    <a href="<?=base_url('teacherleave/adjust_ok/'.$value->id)?>" class="badge badge-success">Accepted</a>
                    <!-- <a href="<?=base_url('teacherleave/adjust_not/'.$value->id)?>" class="badge badge-danger">Rejected</a> -->
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