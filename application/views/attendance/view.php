<div class="be-content">
<div class="main-content container-fluid">
<?=$this->parser->parse('template/alert',[],TRUE);?>
<div class="row">
  <?php for($i=1;$i<=8;$i++): ?>
  <div class="col-sm-6">
    <div class="panel panel-default">
      <div class="panel-heading"><?=$i?> Semester</div>
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-7">
            <canvas id="pie-chart<?=$i?>" height="180" width="150"></canvas>
          </div>
          <div class="col-sm-5">
            <table class="table ">
              <tbody>
                <tr>
                  <th>No. of Days</th>
                  <td>30</td>
                </tr>
                <tr>
                  <th>No. of Attendence Days</th>
                  <td>25</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endfor; ?>
</div>
</div>
