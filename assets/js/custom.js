// Fetch Branch from Course ID
function findBranch(){
	$('.ajax-loader').css('display','block');
	var id = $('#cid').val();
	$.post(base_url+"ajax/findbranch",{id:id},function(data, status){
		$('.brn').html(data);
		$('.ajax-loader').css('display','none');
	});
	$.post(base_url+"ajax/findsemester",{id:id},function(data, status){
		$('.sem').html(data);
	});
}

function findSemTime(){ // Find Semester In Timetable
	$('.ajax-loader').css('display','block');
	var aid = $('#acid').val();
	var cid = $('#cid').val();
	var bid = $('#bid').val();
	$.post(base_url+"ajax/findsemestertime",{aid:aid,bid:bid,cid:cid},function(data, status){
		console.log(data);
		$('.sem').html(data);
		$('.ajax-loader').css('display','none');
	});
}

function findSubjectAtten(){ // Find Subject for Attendance
	$('.ajax-loader').css('display','block');
	var cid = $('#cid').val();
	var bid = $('#bid').val();
	var sem = $('#semester').val();
	$.post(base_url+"ajax/findsubjectatten",{bid:bid,cid:cid,sem:sem},function(data, status){
		$('.sub').html(data);
		$('.ajax-loader').css('display','none');
	});
}

function findBranchatend(){
	$('.ajax-loader').css('display','block');
	var id = $('#cid').val();
	$.post(base_url+"ajax/findbranchatend",{id:id},function(data, status){
		$('.brn').html(data);
		$('.ajax-loader').css('display','none');
	});
}

function findBranchtime(){
	$('.ajax-loader').css('display','block');
	var id = $('#cid').val();
	$.post(base_url+"ajax/findbranchtime",{id:id},function(data, status){
		$('.brn').html(data);
		$('.ajax-loader').css('display','none');
	});
}

function findSemesterAtendance(){
	$('.ajax-loader').css('display','block');
	var cid = $('#cid').val();
	var bid = $('#bid').val();
	$.post(base_url+"ajax/find_semester_atendance",{cid:cid,bid:bid},function(data, status){
		$('.sem').html(data);
		$('.ajax-loader').css('display','none');
	});
}

// Fetch Branch from Course ID
function findTeacher(){
	var smid = $('#sid').val();
	var acid = $('#aid').val();
	var crid = $('#cid').val();
	var brid = $('#bid').val();
	$.post(base_url+"ajax/findteacher",{smid:smid,acid:acid,crid:crid,brid:brid},function(data, status){
		$('.tea').html(data);
	});

}

function findSubject(){
	var smid = $('#sid').val();
	var acid = $('#aid').val();
	var crid = $('#cid').val();
	var brid = $('#bid').val();
	var teid = $('#tid').val();
	$.post(base_url+"ajax/findsubject",{smid:smid,acid:acid,crid:crid,brid:brid,teid:teid},function(data, status){
		$('.sub').html(data);
	});
}

function setMark(id){
	$.post(base_url+"ajax/setmark",{id:id},function(data, status){
		$('#mkid').val(data.mark);
		$('#mk').val(id);

	});
}

function updateMark(){
	var mrk = $('#mkid').val();
	var mrkid = $('#mk').val();
	$.post(base_url+"ajax/updatemark",{mrk:mrk,mrkid:mrkid},function(data, status){
		alert("Mark Update Successfully.");
	});
}

setInterval(function(){
	var obj = document.createElement("audio");
    obj.src=base_url+"assets/arpeggio.mp3";
    obj.volume=0.20;
    obj.autoPlay=false;
    obj.preLoad=true;
    // obj.play();
},30000);
setInterval(shake,2000);
function shake(){
	$('.mdi-notifications').css('animation','shake 0.3s');
	setTimeout(function(){
		$('.mdi-notifications').css('animation','');
	},1000);
}

function markValid(id){
	var mrkid = $('#mid'+id).val();
	var  tsid= $('#tsid').val();
	if(parseInt(mrkid)>parseInt(tsid)){
		alert("Makjadlkf");
	}
	
}

function readnotification(){
	$.post(base_url+"notification/readed",function(data, status){
		console.log(data);
	});
}


