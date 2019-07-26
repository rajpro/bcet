
<div class="be-left-sidebar">
  <div class="left-sidebar-wrapper custom-sidebar"><a class="left-sidebar-toggle">Dashboard</a>
    <div class="left-sidebar-spacer">
      <div class="left-sidebar-scroll">
        <div class="left-sidebar-content">
          <ul class="sidebar-elements">
            <li class="divider">Menu</li>
            <li class="<?=(!empty($menu)&&$menu=='dashboard')?'active':''?>"><a href="<?=base_url('dashboard')?>"><i class="icon mdi mdi-home"></i><span>Dashboard</span></a>
            </li>
            <?php if(in_array('student',$this->session->menu)): ?>
            <li class="parent <?=(!empty($menu)&&$menu=='student')?'active open':''?>"><a href="#"><i class=" icon mdi mdi-account-add"></i><span>Student</span></a>
              <ul class="sub-menu">
                <?php if(in_array('student_view',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='student_view')?'active':''?>"><a href="<?=base_url('student')?>">View Student</a>
                </li>
                <?php endif; ?>
                <?php if(in_array('student_create',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='student_create')?'active':''?>"><a href="<?=base_url('student/create')?>">Add Student</a>
                </li>
                <?php endif; ?>
                <?php if(in_array('student_create',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='student_addmultiplestudent')?'active':''?>"><a href="<?=base_url('student/addmultiplestudent')?>">Add Multiple Student</a>
                </li>
              <?php endif; ?>
              </ul>
            </li>
            <?php endif; ?>
            <?php if(in_array('teacher',$this->session->menu)): ?>
            <li class="parent <?=(!empty($menu)&&$menu=='teacher')?'active open':''?>"><a href="#"><i class="icon mdi mdi-account-add"></i><span>Teacher</span></a>
              <ul class="sub-menu">
                <?php if(in_array('teacher_view',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='teacher_view')?'active':''?>"><a href="<?=base_url('teacher')?>">View Teacher</a>
                </li>
                <?php endif; ?>
                <?php if(in_array('teacher_create',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='teacher_create')?'active':''?>"><a href="<?=base_url('teacher/create')?>">Add Teacher</a>
                </li>
                <?php endif; ?>
              </ul>
            </li>
            <?php endif; ?>
            <?php if(in_array('staff',$this->session->menu)): ?>
            <li class="parent <?=(!empty($menu)&&$menu=='staff')?'active open':''?>"><a href="#"><i class=" icon mdi mdi-account-add"></i><span>Staff</span></a>
              <ul class="sub-menu">
                <?php if(in_array('staff_view',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='staff_view')?'active':''?>"><a href="<?=base_url('staff')?>">View Staff</a>
                </li>
                <?php endif; ?>
                <?php if(in_array('staff_create',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='staff_create')?'active':''?>"><a href="<?=base_url('staff/create')?>">Add Staff</a>
                </li>
                <?php endif; ?>
              </ul>
            </li>
            <?php endif; ?>
            <?php if(in_array('branch',$this->session->menu)): ?>
            <li class="parent <?=(!empty($menu)&&$menu=='branch')?'active open':''?>"><a href="#"><i class="icon mdi mdi-chart-donut"></i><span>Branch</span></a>
              <ul class="sub-menu">
                <?php if(in_array('branch_view',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='branch_view')?'active':''?>"><a href="<?=base_url('branch')?>">View Branch</a>
                </li>
                <?php endif; ?>
                <?php if(in_array('branch_create',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='branch_create')?'active':''?>"><a href="<?=base_url('branch/create')?>">Add Branch</a>
                </li>
                <?php endif; ?>
              </ul>
            </li>
            <?php endif; ?>
            <?php if(in_array('subject',$this->session->menu)): ?>
            <li class="parent <?=(!empty($menu)&&$menu=='subject')?'active open':''?>"><a href="#"><i class="icon mdi mdi-face"></i><span>Subject</span></a>
              <ul class="sub-menu">
                <?php if(in_array('subject_view',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='subject_view')?'active':''?>"><a href="<?=base_url('subject')?>">View Subject</a>
                </li>
                <?php endif; ?>
                <?php if(in_array('subject_create',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='subject_create')?'active':''?>"><a href="<?=base_url('subject/create')?>">Add Subject</a>
                </li>
                <?php endif; ?>
              </ul>
            </li>
            <?php endif; ?>
            <?php if(in_array('academic',$this->session->menu)): ?>
            <li class="parent <?=(!empty($menu)&&$menu=='academic')?'active open':''?>"><a href="#"><i class="icon mdi mdi-face"></i><span>Academic</span></a>
              <ul class="sub-menu">
                <?php if(in_array('academic_view',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='academic_view')?'active':''?>"><a href="<?=base_url('academic')?>">View Academic Year</a>
                </li>
                <?php endif; ?>
                <?php if(in_array('academic_create',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='academic_create')?'active':''?>"><a href="<?=base_url('academic/create')?>">Add Academic Year </a>
                </li>
                <?php endif; ?>
              </ul>
            </li>
            <?php endif; ?>
            <?php if(in_array('course',$this->session->menu)): ?>
            <li class="parent <?=(!empty($menu)&&$menu=='course')?'active open':''?>"><a href="#"><i class="icon mdi mdi-face"></i><span>Course</span></a>
              <ul class="sub-menu">
                <?php if(in_array('course_view',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='course_view')?'active':''?>"><a href="<?=base_url('course')?>">View Course</a>
                </li>
                <?php endif; ?>
                <?php if(in_array('course_create',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='course_create')?'active':''?>"><a href="<?=base_url('course/create')?>">Add Course</a>
                </li>
                <?php endif; ?>
              </ul>
            </li>
            <?php endif; ?>
            <?php if(in_array('test',$this->session->menu)): ?>
            <li class="parent <?=(!empty($menu)&&$menu=='test')?'active open':''?>"><a href="#"><i class=" icon mdi mdi-face"></i><span>Test</span></a>
              <ul class="sub-menu">
                <?php if(in_array('test_view',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='test_view')?'active':''?>"><a href="<?=base_url('test')?>">View Test</a>
                </li>
                <?php endif; ?>
                <?php if(in_array('test_create',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='test_create')?'active':''?>"><a href="<?=base_url('Test/create')?>">Add Test</a>
                </li>
                <?php endif; ?>
              </ul>
            </li>
            <?php endif; ?>
            <?php if(in_array('mark',$this->session->menu)): ?>
            <li class="parent <?=(!empty($menu)&&$menu=='mark')?'active open':''?>"><a href="#"><i class=" icon mdi mdi-face"></i><span>Mark</span></a>
              <ul class="sub-menu">
                <?php if(in_array('mark_view',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='mark_view')?'active':''?>"><a href="<?=base_url('mark')?>">View Mark</a>
                </li>
                <?php endif; ?>
                <?php if(in_array('mark_create',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='mark_create')?'active':''?>"><a href="<?=base_url('mark/create')?>">Add Mark</a>
                </li>
                <?php endif; ?>
              </ul>
            </li>
            <?php endif; ?>
            <?php if(in_array('attendance',$this->session->menu)): ?>
            <li class="parent <?=(!empty($menu)&&$menu=='attendance')?'active open':''?>"><a href="#"><i class=" icon mdi mdi-face"></i><span>Attendance</span></a>
              <ul class="sub-menu">
                <?php if(in_array('attendance_view',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='attendance_view')?'active':''?>"><a href="<?=base_url('attendance')?>">View Attendence</a>
                </li>
                <?php endif; ?>
                <?php if(in_array('attendance_create',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='attendance_create')?'active':''?>"><a href="<?=base_url('attendance/create')?>">Add attendance</a>
                </li>
                <?php endif; ?>
                <?php if(in_array('attendance_update',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='attendance_update')?'active':''?>"><a href="<?=base_url('attendance/update')?>">Update attendance</a>
                </li>
                <?php endif; ?>
              </ul>
            </li>
            <?php endif; ?>
            <?php if(in_array('notice',$this->session->menu)): ?>
            <li class="parent <?=(!empty($menu)&&$menu=='notice')?'active open':''?>"><a href="#"><i class=" icon mdi mdi-face"></i><span>Notice</span></a>
              <ul class="sub-menu">
                <?php if(in_array('notice_view',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='notice_view')?'active':''?>"><a href="<?=base_url('notice')?>">View Notice</a>
                </li>
                <?php endif; ?>
                <?php if(in_array('notice_create',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='notice_create')?'active':''?>"><a href="<?=base_url('notice/create')?>">Add Notice</a>
                </li>
                <?php endif; ?>
              </ul>
            </li>
            <?php endif; ?>
            <?php if(in_array('timetable',$this->session->menu)): ?>
            <li class="parent <?=(!empty($menu)&&$menu=='timetable')?'active open':''?>"><a href="#"><i class="icon mdi mdi-border-all"></i><span>Timetable</span></a>
              <ul class="sub-menu">
                <?php if(in_array('timetable_view',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='timetable_view')?'active':''?>"><a href="<?=base_url('timetable')?>">View Timetable</a>
                </li>
                <?php endif; ?>
                <?php if(in_array('timetable_create',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='timetable_create')?'active':''?>"><a href="<?=base_url('timetable/create')?>">Create Timetable</a>
                </li>
                <?php endif; ?>
                <?php if(in_array('timetable_update',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='timetable_update')?'active':''?>"><a href="<?=base_url('timetable/update')?>">Update Timetable</a>
                </li>
                <?php endif; ?>
              </ul>
            </li>
            <?php endif; ?>
            <?php if(in_array('semester',$this->session->menu)): ?>
            <li class="parent <?=(!empty($menu)&&$menu=='semester')?'active open':''?>"><a href="#"><i class=" icon mdi mdi-face"></i><span>Semester</span></a>
              <ul class="sub-menu">
                <?php if(in_array('semester_view',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='semester_view')?'active':''?>"><a href="<?=base_url('semester')?>">View Semester</a>
                </li>
                <?php endif; ?>
                <?php if(in_array('semester_create',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='semester_create')?'active':''?>"><a href="<?=base_url('semester/create')?>">Add Semester</a>
                </li>
                <?php endif; ?>
              </ul>
            </li>
            <?php endif; ?>
            <?php if(in_array('section',$this->session->menu)): ?>
            <li class="parent <?=(!empty($menu)&&$menu=='section')?'active open':''?>"><a href="#"><i class=" icon mdi mdi-face"></i><span>Section</span></a>
              <ul class="sub-menu">
                <?php if(in_array('section_view',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='section_view')?'active':''?>"><a href="<?=base_url('section')?>">View Section</a>
                </li>
                <?php endif; ?>
                <?php if(in_array('section_create',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='section_create')?'active':''?>"><a href="<?=base_url('section/create')?>">Add Section</a>
                </li>
                <?php endif; ?>
              </ul>
            </li>
            <?php endif; ?>
            <?php if(in_array('role',$this->session->menu)): ?>
            <li class="parent <?=(!empty($menu)&&$menu=='role')?'active open':''?>"><a href="#"><i class=" icon mdi mdi-face"></i><span>Role</span></a>
              <ul class="sub-menu">
                <?php if(in_array('role_view',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='role_view')?'active':''?>"><a href="<?=base_url('role')?>">View Role</a>
                </li>
                <?php endif; ?>
                <?php if(in_array('role_create',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='role_create')?'active':''?>"><a href="<?=base_url('role/create')?>">Add Role</a>
                </li>
                <?php endif; ?>
              </ul>
            </li>
            <?php endif; ?>
            <?php if(in_array('extra',$this->session->menu)): ?>
            <li class="parent <?=(!empty($menu)&&$menu=='extra')?'active open':''?>"><a href="#"><i class=" icon mdi mdi-face"></i><span>Faculty Leave</span></a>
              <ul class="sub-menu">
               <!--  <li class="<?=(!empty($sub_menu)&&$sub_menu=='extra_view')?'active':''?>"><a href="<?=base_url('classextend/class_extend_index')?>">Class Extend</a>
                </li>  -->
                <?php if(in_array('extra_view',$this->session->role)): ?>  
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='extra_view')?'active':''?>"><a href="<?=base_url('teacherleave/teacher_leave_index')?>">Leave Applications</a>
                </li>
                <?php endif; ?>
                <?php if(in_array('extra_view',$this->session->role)): ?>  
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='extra_view')?'active':''?>"><a href="<?=base_url('teacherleave/class_adjust')?>">Class Adjust</a>
                </li>
                <?php endif; ?>
                <?php if(in_array('extra_view',$this->session->role) && ($this->session->profile['designation']=='hod_asstprof' || $this->session->profile['designation']=='principal' || $this->session->profile['designation']=='hod_prof')): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='extra_view')?'active':''?>"><a href="<?=base_url('teacherleave/hod_application')?>">HOD Approval</a>
                </li>
                <?php endif; ?>
                <?php if(in_array('extra_view',$this->session->role) && $this->session->profile['designation']=='principal'): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='extra_view')?'active':''?>"><a href="<?=base_url('teacherleave/principal_application')?>">Princial Approval</a>
                </li>
                <?php endif; ?>
              </ul>
            </li>
            <?php endif; ?>
             <?php if(in_array('web',$this->session->menu)): ?>
            <li class="parent <?=(!empty($menu)&&$menu=='web')?'active open':''?>"><a href="#"><i class=" icon mdi mdi-face"></i><span>Web Maintainence</span></a>
              <ul class="sub-menu">
                <?php if(in_array('web_view',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='web_view')?'active':''?>"><a href="<?=base_url('web')?>">Web Maintainence View</a>
                </li>
                <?php endif; ?>
                <?php if(in_array('web_create',$this->session->role)): ?>
                <li class="<?=(!empty($sub_menu)&&$sub_menu=='web_create')?'active':''?>"><a href="<?=base_url('web/create')?>">Web Maintainence Create</a>
                </li>
                <?php endif; ?>
              </ul>
            </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
