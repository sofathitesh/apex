<?php
$bantorj = mysql_fetch_array(mysql_query("SELECT prjcolor, prjcolor2, prjcolor3, prjcolor4, prjcolor5 FROM setting"));
	$bantorjf = "#$bantorj[0]";
	$bantorjff = "#$bantorj[1]";
	$bantorjfff = "#$bantorj[2]";
	$bantorjffff = "#$bantorj[3]";
	$bantorjfffff = "#$bantorj[4]";
	
?>

<style>        	
.header.logo > img {
  width: 75px;
}

</style>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-student"></i> <?=$this->lang->line('panel_title')?></h3>


        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
			<li>
            <span style="color: <?php echo $bantorjf;?>;"><?=$this->lang->line('menu_student')?></span></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">

                <?php
                    $usertype = $this->session->userdata("usertype");
                    if($usertype == "Admin" || $usertype == "Super Admin") {
                ?>
                    <h5 class="page-header">
                        <a href="javascript:mAdd();">
                            <i class="fa fa-plus"></i>
                            <?=$this->lang->line('add_title')?>
                        </a>
                    </h5>
                <?php } ?>



                <div class="col-sm-6 col-sm-offset-3 list-group">
                    <div class="list-group-item list-group-item-warning" style="background-color: <?php echo $bantorjfff;?>;">
                        <form style="" class="form-horizontal" role="form" method="post" onsubmit="return false;">
                            <div class="form-group">
                                <label for="classesID" class="col-sm-2 col-sm-offset-2 control-label">
                                    <?=$this->lang->line("student_classes")?>
                                </label>
                                <div class="col-sm-6">
                                    <?php
                                        $array = array("0" => $this->lang->line("student_select_class"));
                                        foreach ($classes as $classa) {
                                            $array[$classa->classesID] = $classa->classes;
                                        }
                                        echo form_dropdown("classesID", $array, set_value("classesID", $set), "id='classesID' class='form-control'");
                                    ?>
                                </div>
                            </div>
                            <!-- <div class="form-group">              

                                <label for="pack_id" class="col-sm-2 col-sm-offset-2 control-label">

                                    Package

                                </label>

                                <div class="col-sm-6">

                                    <?php

                                        /*$array = array("0" => "Select Package");
                                        foreach ($packages as $pack) {
                                            $array[$pack->packageID] = $pack->package;
                                        }
                                        
                                        echo form_dropdown("pack_id", $array, set_value("pack_id",$pack_id), "id='pack_id' class='form-control'");*/

                                    ?>

                                </div>

                            </div> -->

                            <!-- <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <input type="submit" onclick="viewSed();" class="btn btn-success" style="margin-bottom:0px" value="View Student" >
                                </div>
                            </div> -->
                        </form>
                    </div>
                </div>

                <?php if(count($students) > 0 ) { ?>

                    <div class="col-sm-12">

                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#all" aria-expanded="true"><?=$this->lang->line("student_all_students")?></a></li>
                                <?php foreach ($packages as $key => $package) {
                                    if($package->category==1){
                                        echo '<li class=""><a data-toggle="tab" href="#'.$package->classID.$package->packageID .'" aria-expanded="false">'. /*$this->lang->line("student_package")." ".*/$package->package.'</a></li>';
                                    }
                                } ?>
                            </ul>



                            <div class="tab-content">
                                <div id="all" class="tab-pane active">
                                    <div id="hide-table">
                                        <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                                            <thead>
                                                <tr>
                                                    <th class="col-sm-1"><?=$this->lang->line('slno')?></th>
                                                    <th class="col-sm-1"><?=$this->lang->line('student_photo')?></th>
                                                    <th class="col-sm-1">Student <?=$this->lang->line('student_name')?></th>
                                                    <th class="col-sm-1">IC No</th>
                                                    <th class="col-sm-2">School Address</th>
                                                    <th class="col-sm-1"><?=$this->lang->line('student_roll')?></th>
                                                    <th class="col-sm-2">Subject Code</th>
                                                    <th class="col-sm-1"><?=$this->lang->line('student_phone')?></th>
                                                    <th class="col-sm-1"><?=$this->lang->line('student_status')?></th>
                                                    <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(count($students)) {$i = 1; foreach($students as $student) { ?>
                                                    <tr>
                                                        <td data-title="<?=$this->lang->line('slno')?>">
                                                            <?php echo $i; ?>
                                                        </td>

                                                        <td data-title="<?=$this->lang->line('student_photo')?>">
                                                            <?php $array = array(
                                                                    "src" => base_url('uploads/images/'.$student->photo),
                                                                    'width' => '35px',
                                                                    'height' => '35px',
                                                                    'class' => 'img-rounded'

                                                                );
                                                                echo img($array);
                                                            ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('student_name')?>">
                                                            <?php echo $student->name; ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('student_name')?>">
                                                            <?php echo $student->ic_no; ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('student_name')?>">
                                                            <?php echo $student->address; ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('student_roll')?>">
                                                            <?php echo $student->roll; ?>
                                                        </td>
                                                        <td data-title="Subject Code">
                                                            <?php 
                                                            echo $student->subject;
                                                             ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('student_phone')?>">
                                                            <?php echo $student->phone; ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('teacher_status')?>">
                                                            <div class="onoffswitch-small" id="<?=$student->studentID?>">
                                                                <input type="checkbox" id="myonoffswitch<?=$student->studentID?>" class="onoffswitch-small-checkbox" name="paypal_demo" <?php if($student->studentactive === '1') echo "checked='checked'"; ?>>
                                                                <label for="myonoffswitch<?=$student->studentID?>" class="onoffswitch-small-label">
                                                                    <span class="onoffswitch-small-inner"></span>
                                                                    <span class="onoffswitch-small-switch"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('action')?>">
                                                            <?php
                                                                if($usertype == "Admin" || $usertype == "Super Admin") {

                                                                    //echo btn_view('student/view/'.$student->studentID."/".$set, $this->lang->line('view'));
                                                                    ?>
                                                                    <a data-original-title="<?= $this->lang->line('view');?>" data-toggle="tooltip" data-placement="top" class="btn btn-success btn-xs mrg" href="javascript:viewD('<?= $student->studentID; ?>','<?= $set;?>');"><i class="fa fa-check-square-o"></i></a>
                                                                    <a data-original-title="<?= $this->lang->line('edit');?>" data-toggle="tooltip" data-placement="top" class="btn btn-warning btn-xs mrg" href="javascript:mEdit('<?= $student->studentID; ?>','<?= $set;?>');"><i class="fa fa-edit"></i></a>
                                                                    <?php
                                                                    
                                                                    // echo btn_edit('student/edit/'.$student->studentID."/".$set, $this->lang->line('edit'));
                                                                    echo btn_delete('student/delete/'.$student->studentID."/".$set, $this->lang->line('delete'));

                                                                } elseif ($usertype == "Teacher") {
                                                                    echo btn_view('student/view/'.$student->studentID."/".$set, $this->lang->line('view'));
                                                                }

                                                            ?>
                                                        </td>
                                                   </tr>
                                                <?php $i++; }} ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                                <?php foreach ($packages as $key => $package) { if($package->category==1){?>
                                        <div id="<?=$package->classID.$package->packageID?>" class="tab-pane">
                                            <div id="hide-table">
                                                <table class="table table-striped table-bordered table-hover dataTable no-footer">
                                                    <thead>
                                                        <tr>
                                                            <th class="col-sm-1"><?=$this->lang->line('slno')?></th>
                                                            <th class="col-sm-1"><?=$this->lang->line('student_photo')?></th>
                                                            <th class="col-sm-1">Student <?=$this->lang->line('student_name')?></th>
                                                            <th class="col-sm-1">IC No</th>
                                                            <th class="col-sm-2">School Address</th>
                                                            <th class="col-sm-1"><?=$this->lang->line('student_roll')?></th>
                                                            <th class="col-sm-2">Subject Code</th>
                                                            <th class="col-sm-1"><?=$this->lang->line('student_phone')?></th>
                                                            <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if(count($allpackage[$package->packageID])) { $i = 1; foreach($allpackage[$package->packageID] as $student) { if($package->packageID === $student->packageID) { ?>
                                                            <tr>
                                                                <td data-title="<?=$this->lang->line('slno')?>">
                                                                    <?php echo $i; ?>
                                                                </td>

                                                                <td data-title="<?=$this->lang->line('student_photo')?>">
                                                                    <?php $array = array(
                                                                            "src" => base_url('uploads/images/'.$student->photo),
                                                                            'width' => '35px',
                                                                            'height' => '35px',
                                                                            'class' => 'img-rounded'

                                                                        );
                                                                        echo img($array);
                                                                    ?>
                                                                </td>
                                                                <td data-title="<?=$this->lang->line('student_name')?>">
                                                                    <?php echo $student->name; ?>
                                                                </td>
                                                                <td data-title="<?=$this->lang->line('student_name')?>">
                                                                    <?php echo $student->ic_no; ?>
                                                                </td>
                                                                <td data-title="<?=$this->lang->line('student_name')?>">
                                                                    <?php echo $student->address; ?>
                                                                </td>
                                                                <td data-title="<?=$this->lang->line('student_roll')?>">
                                                                    <?php echo $student->roll; ?>
                                                                </td>
                                                                <td data-title="Subject Code">
                                                                    <?php 
                                                                    echo $student->subject;
                                                             ?>
                                                                </td>
                                                                <td data-title="<?=$this->lang->line('student_phone')?>">
                                                                    <?php echo $student->phone; ?>
                                                                </td>
                                                                <td data-title="<?=$this->lang->line('action')?>">
                                                                    <?php
                                                                        if($usertype == "Admin" || $usertype == "Super Admin") {
                                                                            // echo btn_view('student/view/'.$student->studentID."/".$set, $this->lang->line('view'));

                                                                            ?>
                                                                            <a data-original-title="<?= $this->lang->line('view');?>" data-toggle="tooltip" data-placement="top" class="btn btn-success btn-xs mrg" href="javascript:viewD('<?= $student->studentID; ?>','<?= $set;?>');"><i class="fa fa-check-square-o"></i></a>
                                                                            <a data-original-title="<?= $this->lang->line('edit');?>" data-toggle="tooltip" data-placement="top" class="btn btn-warning btn-xs mrg" href="javascript:mEdit('<?= $student->studentID; ?>','<?= $set;?>');"><i class="fa fa-edit"></i></a>
                                                                            <?php
                                                                            //echo btn_edit('student/edit/'.$student->studentID."/".$set, $this->lang->line('edit'));
                                                                            echo btn_delete('student/delete/'.$student->studentID."/".$set, $this->lang->line('delete'));
                                                                        } elseif ($usertype == "Teacher") {
                                                                            echo btn_view('student/view/'.$student->studentID."/".$set, $this->lang->line('view'));
                                                                        }

                                                                    ?>
                                                                </td>
                                                           </tr>
                                                        <?php $i++; }}} ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                <?php } }?>
                            </div>

                        </div> <!-- nav-tabs-custom -->
                    </div> <!-- col-sm-12 for tab -->

                <?php } else { ?>
                    <div class="col-sm-12">

                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#all" aria-expanded="true"><?=$this->lang->line("student_all_students")?></a></li>
                            </ul>


                            <div class="tab-content">
                                <div id="all" class="tab-pane active">
                                    <div id="hide-table">
                                        <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                                            <thead>
                                                <tr>
                                                    <th class="col-sm-1"><?=$this->lang->line('slno')?></th>
                                                    <th class="col-sm-1"><?=$this->lang->line('student_photo')?></th>
                                                    <th class="col-sm-1">Student <?=$this->lang->line('student_name')?></th>
                                                    <th class="col-sm-1">IC No</th>
                                                    <th class="col-sm-2">School Address</th>
                                                    <th class="col-sm-1"><?=$this->lang->line('student_roll')?></th>
                                                    <th class="col-sm-2">Subject Code</th>
                                                    <th class="col-sm-1"><?=$this->lang->line('student_phone')?></th>
                                                    <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(count($students)) {$i = 1; foreach($students as $student) { ?>
                                                    <tr>
                                                        <td data-title="<?=$this->lang->line('slno')?>">
                                                            <?php echo $i; ?>
                                                        </td>

                                                        <td data-title="<?=$this->lang->line('student_photo')?>">
                                                            <?php $array = array(
                                                                    "src" => base_url('uploads/images/'.$student->photo),
                                                                    'width' => '35px',
                                                                    'height' => '35px',
                                                                    'class' => 'img-rounded'

                                                                );
                                                                echo img($array);
                                                            ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('student_name')?>">
                                                            <?php echo $student->name; ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('student_name')?>">
                                                            <?php echo $student->ic_no; ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('student_name')?>">
                                                            <?php echo $student->address; ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('student_roll')?>">
                                                            <?php echo $student->roll; ?>
                                                        </td>
                                                        <td data-title="Subject Code">
                                                            <?php 
                                                                echo $student->subject;
                                                             ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('student_phone')?>">
                                                            <?php echo $student->phone; ?>
                                                        </td>
                                                        <td data-title="<?=$this->lang->line('action')?>">
                                                            <?php
                                                                if($usertype == "Admin" || $usertype == "Super Admin") {
                                                                    // echo btn_view('student/view/'.$student->studentID."/".$set, $this->lang->line('view'));

                                                                    ?>
                                                                    <a data-original-title="<?= $this->lang->line('view');?>" data-toggle="tooltip" data-placement="top" class="btn btn-success btn-xs mrg" href="javascript:viewD('<?= $student->studentID; ?>','<?= $set;?>');"><i class="fa fa-check-square-o"></i></a>
                                                                    <a data-original-title="<?= $this->lang->line('edit');?>" data-toggle="tooltip" data-placement="top" class="btn btn-warning btn-xs mrg" href="javascript:mEdit('<?= $student->studentID; ?>','<?= $set;?>');"><i class="fa fa-edit"></i></a>
                                                                    <?php
                                                                    //echo btn_edit('student/edit/'.$student->studentID."/".$set, $this->lang->line('edit'));
                                                                    echo btn_delete('student/delete/'.$student->studentID."/".$set, $this->lang->line('delete'));
                                                                } elseif ($usertype == "Teacher") {
                                                                    echo btn_view('student/view/'.$student->studentID."/".$set, $this->lang->line('view'));
                                                                }

                                                            ?>
                                                        </td>
                                                   </tr>
                                                <?php $i++; }} ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div> <!-- nav-tabs-custom -->
                    </div>
                <?php } ?>

            </div> <!-- col-sm-12 -->

        </div><!-- row -->
    </div><!-- Body -->
</div><!-- /.box -->

        <div class="modal fade" id="m_add">

          <div class="modal-dialog ml-modal">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>


                </div>

                <div class="modal-body" id="m_add_body">

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-default" style="margin-bottom:0px;" data-dismiss="modal"><?=$this->lang->line('close')?></button>
                   
                </div>

            </div>

          </div>

        </div>

        <div class="modal fade" id="m_edit">

          <div class="modal-dialog md-modal">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>


                </div>

                <div class="modal-body" id="m_edit_body">

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-default" style="margin-bottom:0px;" data-dismiss="modal"><?=$this->lang->line('close')?></button>
                   
                </div>

            </div>

          </div>

        </div>
        <div class="modal fade" id="profile_d">

          <div class="modal-dialog md-modal">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>


                </div>

                <div class="modal-body" id="profileview">

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-default" style="margin-bottom:0px;" data-dismiss="modal"><?=$this->lang->line('close')?></button>
                   
                </div>

            </div>

          </div>

        </div>        
        

<link href="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css"
    rel="stylesheet" type="text/css" />
<script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js"
    type="text/javascript"></script>


<script type="text/javascript">
    $('#classesID').change(function() {

        var classesID = $(this).val();

        if(classesID == 0) {

            $('#hide-table').hide();

            $('.nav-tabs-custom').hide();

        } else {

            /*$.ajax({
                type: 'POST',
                url: "<?=base_url('student/callPackage')?>",
                data: "id=" + classesID,
                dataType: "html",
                success: function(data) {
                   $('#pack_id').html(data);
                   
                }
            });*/
            $.ajax({

                type: 'POST',

                url: "<?=base_url('student/student_list')?>",

                data: "id=" + classesID,

                dataType: "html",

                success: function(data) {

                    window.location.href = data;

                }

            });
            
        }

    });


    /*function viewSed(){
        var err = 0;
        var classesID = $('#classesID').val();
        var pack_id = $('#pack_id').val();
        if(classesID==0){
            $('#classesID').css("border","1px solid #D03B4E");
            err++;
        }
        if(pack_id==0){
            $('#pack_id').css("border","1px solid #D03B4E");
            err++;
        }
        if(err==0){
            $.ajax({

                type: 'POST',

                url: "<?=base_url('student/student_list')?>",

                data: "id=" + classesID+"&pack_id="+pack_id,

                dataType: "html",

                success: function(data) {

                    window.location.href = data;

                }

            });
        }
    }*/


    var status = '';
    var id = 0;
    $('.onoffswitch-small-checkbox').click(function() {
        if($(this).prop('checked')) {
            status = 'chacked';
            id = $(this).parent().attr("id");
        } else {
            status = 'unchacked';
            id = $(this).parent().attr("id");
        }

        if((status != '' || status != null) && (id !='')) {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('student/active')?>",
                data: "id=" + id + "&status=" + status,
                dataType: "html",
                success: function(data) {
                    if(data == 'Success') {
                        toastr["success"]("Success")
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "500",
                            "hideDuration": "500",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    } else {
                        toastr["error"]("Error")
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "500",
                            "hideDuration": "500",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
                }
            });
        }
    });

    function viewD(pid,set){
    $("body").addClass("pl-wait");
    $.ajax({

        type: 'POST',

        url: "<?=base_url('student/view')?>/"+pid+"/"+set,

        dataType: "html",

        success: function(data) {
          $("#profileview").html(data);
          $('#profile_d').modal("show");
        },
        complete: function(){
          $("body").removeClass("pl-wait");
        }

    });
  }
    function mAdd(){
    $("body").addClass("pl-wait");
    $.ajax({

        type: 'POST',

        url: "<?=base_url('student/add')?>",

        dataType: "html",

        success: function(data) {
          $("#m_add_body").html(data);
          $('#m_add').modal("show");
        },
        complete: function(){
          $("body").removeClass("pl-wait");
        }

    });
  }
  function btn_add(){
    $("body").addClass("pl-wait");
    var formData = new FormData($("#add_frm")[0]);
    $.ajax({

        type: 'POST',

        url: "<?=base_url('student/add')?>",

        data: formData,

        dataType: "html",

        processData: false,
        contentType: false,

        success: function(data) {
          if(data=="ok"){
                location.reload();
          }else if(data=="ErrorSubject"){
               alert("Student increased limit under these subjects");
          }else{
            // alert("some error occured");
            $("#m_add_body").html(data);
          }
        },
        complete: function(){
          $("body").removeClass("pl-wait");
        }

    });
  }

  function mEdit(pid,set){
    $("body").addClass("pl-wait");
    $.ajax({

        type: 'POST',

        url: "<?=base_url('student/edit')?>/"+pid+"/"+set,

        dataType: "html",

        success: function(data) {
          $("#m_edit_body").html(data);
          $('#m_edit').modal("show");
        },
        complete: function(){
          $("body").removeClass("pl-wait");
        }

    });
  }

  function btn_edit(pid,set){
    $("body").addClass("pl-wait");
    var formData = new FormData($("#edit_frm")[0]);
    $.ajax({

        type: 'POST',

        url: "<?=base_url('student/edit')?>/"+pid+"/"+set,

        data: formData,

        dataType: "html",

        processData: false,
        contentType: false,

        success: function(data) {
          if(data=="ok"){
                location.reload();
          }else{
            // alert("some error occured");
            $("#m_edit_body").html(data);
          }
        },
        complete: function(){
          $("body").removeClass("pl-wait");
        }

    });
  }
</script>

