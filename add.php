<div class="box">

    <div class="box-header">

        <h3 class="box-title"><i class="fa icon-student"></i> <?=$this->lang->line('panel_title')?></h3>



        <!-- <ol class="breadcrumb">

            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>

            <li><a href="<?=base_url("student/index")?>"><?=$this->lang->line('menu_student')?></a></li>

            <li class="active"><?=$this->lang->line('menu_add')?> <?=$this->lang->line('panel_title')?></li>

        </ol> -->

    </div><!-- /.box-header -->

    <!-- form start -->

    <div class="box-body">

        <div class="row">

            <div class="col-sm-12">

                <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" onsubmit="return false;" id="add_frm">

                       

                    <?php 

                        if(form_error('name')) 

                            echo "<div class='form-group has-error' >";

                        else     

                            echo "<div class='form-group' >";

                    ?>

                        <label for="name_id" class="col-sm-4 control-label">

                            <span class="text-red">*</span><?=$this->lang->line("student_name")?>

                        </label>

                        <div class="col-sm-6">

                            <input type="text" class="form-control" id="name_id" name="name" value="<?=set_value('name')?>" >

                        </div>

                        <span class="col-sm-4 control-label">

                            <?php echo form_error('name'); ?>

                        </span>

                    </div>


                    <?php 

                        if(form_error('ic_no')) 

                            echo "<div class='form-group has-error' >";

                        else     

                            echo "<div class='form-group' >";

                    ?>

                        <label for="ic_no" class="col-sm-4 control-label">

                            <?=$this->lang->line("student_ic_no")?>

                        </label>

                        <div class="col-sm-6">

                            <input type="text" class="form-control" id="ic_no" name="ic_no" value="<?=set_value('ic_no')?>" >

                        </div>

                        <span class="col-sm-4 control-label">

                            <?php echo form_error('ic_no'); ?>

                        </span>

                    </div>



                    <?php 

                        if(form_error('guargianID')) 

                            echo "<div class='form-group has-error' >";

                        else     

                            echo "<div class='form-group' >";

                    ?>

                        <label for="guargianID" class="col-sm-4 control-label">

                            <span class="text-red">*</span><?=$this->lang->line("student_guargian")?>

                        </label>

                        <div class="col-sm-6">

                            <div class="select2-wrapper">

                                <?php

                                    $array = array('' => '');

                                    foreach ($parents as $parent) {

                                        $array[$parent->parentID] = $parent->name." (" . $parent->email ." )";

                                    }

                                    echo form_dropdown("guargianID", $array, set_value("guargianID"), "id='guargianID' class='form-control guargianID'");

                                ?>

                            </div>

                        </div>

                        <span class="col-sm-4 control-label">

                            <?php echo form_error('guargianID'); ?>

                        </span>

                    </div>







                    <?php 

                        if(form_error('dob')) 

                            echo "<div class='form-group has-error' >";

                        else     

                            echo "<div class='form-group' >";

                    ?>

                        <label for="dob" class="col-sm-4 control-label">

                            <span class="text-red">*</span><?=$this->lang->line("student_dob")?>

                        </label>

                        <div class="col-sm-6">

                            <input type="text" class="form-control" id="dob" name="dob" value="<?=set_value('dob')?>" >

                        </div>

                        <span class="col-sm-4 control-label">

                            <?php echo form_error('dob'); ?>

                        </span>

                    </div>



                    <?php 

                        if(form_error('sex')) 

                            echo "<div class='form-group has-error' >";

                        else     

                            echo "<div class='form-group' >";

                    ?>

                        <label for="sex" class="col-sm-4 control-label">

                            <?=$this->lang->line("student_sex")?>

                        </label>

                        <div class="col-sm-6">

                            <?php 

                                echo form_dropdown("sex", array($this->lang->line('student_sex_male') => $this->lang->line('student_sex_male'), $this->lang->line('student_sex_female') => $this->lang->line('student_sex_female')), set_value("sex"), "id='sex' class='form-control'"); 

                            ?>

                        </div>

                        <span class="col-sm-4 control-label">

                            <?php echo form_error('sex'); ?>

                        </span>

                    </div>

                    <?php 

                        if(form_error('address')) 

                            echo "<div class='form-group has-error' >";

                        else     

                            echo "<div class='form-group' >";

                    ?>

                        <label for="address" class="col-sm-4 control-label">

                            School <?=$this->lang->line("student_address")?>

                        </label>

                        <div class="col-sm-6">

                            <input type="text" class="form-control" id="address" name="address" value="<?=set_value('address')?>" >

                        </div>

                        <span class="col-sm-4 control-label">

                            <?php echo form_error('address'); ?>

                        </span>

                    </div>



                    <!-- <?php 

                        if(form_error('email')) 

                            echo "<div class='form-group has-error' >";

                        else     

                            echo "<div class='form-group' >";

                    ?>

                        <label for="email" class="col-sm-4 control-label">

                            <span class="text-red">*</span><?=$this->lang->line("student_email")?>

                        </label>

                        <div class="col-sm-6">

                            <input type="text" class="form-control" id="email" name="email" value="<?=set_value('email')?>" >

                        </div>

                        <span class="col-sm-4 control-label">

                            <?php echo form_error('email'); ?>

                        </span>

                    </div> -->



                    <?php 

                        if(form_error('phone')) 

                            echo "<div class='form-group has-error' >";

                        else     

                            echo "<div class='form-group' >";

                    ?>

                        <label for="phone" class="col-sm-4 control-label">

                            <?=$this->lang->line("student_phone")?>

                        </label>

                        <div class="col-sm-6">

                            <input type="text" class="form-control" id="phone" name="phone" value="<?=set_value('phone')?>" >

                        </div>

                        <span class="col-sm-4 control-label">

                            <?php echo form_error('phone'); ?>

                        </span>

                    </div>



                    

                    <?php 

                        if(form_error('classesID')) 

                            echo "<div class='form-group has-error' >";

                        else     

                            echo "<div class='form-group' >";

                    ?>

                        <label for="classesID" class="col-sm-4 control-label">

                            <span class="text-red">*</span><?=$this->lang->line("student_classes")?>

                        </label>

                        <div class="col-sm-6">

                           <?php

                                $array = array(0 => $this->lang->line("student_select_class"));

                                foreach ($classes as $classa) {

                                    $array[$classa->classesID] = $classa->classes;

                                }

                                echo form_dropdown("classesID", $array, set_value("classesID"), "id='classesID1' class='form-control'");

                            ?>

                        </div>

                        <span class="col-sm-4 control-label">

                            <?php echo form_error('classesID'); ?>

                        </span>

                    </div>

                    <?php 

                        if(form_error('package')) 

                            echo "<div class='form-group has-error' >";

                        else     

                            echo "<div class='form-group' >";

                    ?>

                        <label for="sectionID" class="col-sm-4 control-label">

                            <span class="text-red">*</span>Package

                        </label>

                        <div class="col-sm-6">

                            <?php

                                $array = array(0 => "Select Package");

                                
                                

                                echo form_dropdown("package", $array, set_value("sectionID"), "id='packages' class='form-control'");



                            ?>

                        </div>

                        <span class="col-sm-4 control-label">

                            <?php echo form_error('package'); ?>

                        </span>

                    </div>

                    <div id="section_ID"></div>

                    <!-- <?php 

                        /*if(form_error('sectionID')) 

                            echo "<div class='form-group has-error' >";

                        else     

                            echo "<div class='form-group' >";

                    ?>

                        <label for="sectionID" class="col-sm-4 control-label">

                            <span class="text-red">*</span><?= $this->lang->line("student_section");?>

                        </label>

                        <div class="col-sm-6">

                            <?php

                                $array = array(0 => $this->lang->line("student_select_section"));

                                if($sections != "empty") {

                                    foreach ($sections as $section) {

                                        $array[$section->sectionID] = $section->section;

                                    }

                                }
                                
                                echo form_dropdown("sectionID", $array, set_value("sectionID"), "id='sectionID' class='form-control'");*/



                            ?>

                        </div>

                        <span class="col-sm-4 control-label">

                            <?php //echo form_error('sectionID'); ?>

                        </span>

                    </div> -->

                    <div id="sub_section">
                        
                    </div>


                    <?php 

                        if(form_error('additional_pack')) 

                            echo "<div class='form-group has-error' >";

                        else     

                            echo "<div class='form-group' >";

                    ?>

                        <label for="additional_pack" class="col-sm-4 control-label">

                            <!-- <span class="text-red">*</span> -->Additional Subject

                        </label>

                        <div class="col-sm-6" id="add_p">

                            <?php
                                //$additional_pack_ar = array("Select Package","ADD F5 G2","PHY F5 G2","ADD F5 G");

                            $additional_pack_ar = array(
                                                         'select'  => 'Select Package',
                                                         'add'    => 'ADD F5 G2',
                                                         'phy'   => 'PHY F5 G2',
                                                         'addg' => 'ADD F5 G',
                                                         );

                                echo form_multiselect("additional_pack[]", $additional_pack_ar, set_value("additional_pack"), "id='additional_pack' class='form-control'");
                            ?>

                        </div>

                        

                        <span class="col-sm-4 control-label">

                            <?php echo form_error('additional_pack'); ?>

                        </span>

                    </div>

                    <?php 

                        if(form_error('transportID')) 

                            echo "<div class='form-group has-error' >";

                        else     

                            echo "<div class='form-group' >";

                    ?>

                        <label for="transportID" class="col-sm-4 control-label">

                            <!-- <span class="text-red">*</span> -->Transportation

                        </label>

                        <div class="col-sm-6">

                            <?php

                                $array = array(0 => "Select Root");

                                if($transports != "empty") {

                                    foreach ($transports as $transport) {

                                        $array[$transport->transportID] = $transport->route;

                                    }

                                }
                                echo form_dropdown("transportID", $array, set_value("transportID"), "id='transportID' class='form-control'");

                            ?>

                        </div>

                        <span class="col-sm-4 control-label">

                            <?php echo form_error('transportID'); ?>

                        </span>

                    </div>

                    <!-- <?php 

                        /*if(form_error('subject')) 

                            echo "<div class='form-group has-error' >";

                        else     

                            echo "<div class='form-group' >";

                    ?>

                        <label for="subject" class="col-sm-4 control-label">

                            <span class="text-red">*</span><?=$this->lang->line("student_subject_choose")?>

                        </label>

                        <div class="col-sm-6" id="sub_j">

                            <?php
                                $subarray = array();


                                foreach ($classes as $classa) {

                                    $subarray[$classa->classesID] = $classa->classes;

                                }

                                echo form_multiselect("subject[]", $subarray, set_value("subject"), "id='subject' class='form-control'");*/
                            ?>

                        </div>

                        <span class="col-sm-4 control-label">

                            <?php //echo form_error('subject'); ?>

                        </span>

                    </div> -->
                    <!-- <div style="display:none;" id="subject"></div> -->

                    <?php 

                        if(form_error('roll')) 

                            echo "<div class='form-group has-error' >";

                        else     

                            echo "<div class='form-group' >";

                    ?>

                        <label for="roll" class="col-sm-4 control-label">

                            <span class="text-red">*</span><?=$this->lang->line("student_roll")?>

                        </label>

                        <div class="col-sm-6">

                            <input type="text" class="form-control" id="roll" name="roll" value="<?=set_value('roll')?>" >

                        </div>

                        <span class="col-sm-4 control-label">

                            <?php echo form_error('roll'); ?>

                        </span>

                    </div>



                    <!-- <?php 

                        if(isset($image)) 

                            echo "<div class='form-group has-error' >";

                        else     

                            echo "<div class='form-group' >";

                    ?>

                        <label for="photo" class="col-sm-4 control-label col-xs-8 col-md-4">

                            <?=$this->lang->line("student_photo")?>

                        </label>

                        <div class="col-sm-4 col-xs-6 col-md-4">

                            <input class="form-control"  id="uploadFile" placeholder="Choose File" disabled />  

                        </div>



                        <div class="col-sm-2 col-xs-6 col-md-2">

                            <div class="fileUpload btn btn-success form-control">

                                <span class="fa fa-repeat"></span>

                                <span><?=$this->lang->line("upload")?></span>

                                <input id="uploadBtn" type="file" class="upload" name="image" />

                            </div>

                        </div>

                         <span class="col-sm-4 control-label col-xs-6 col-md-4">

                           

                            <?php //if(isset($image)) echo $image; ?>

                        </span>

                    </div> -->



                    <!-- <?php 

                        if(form_error('username')) 

                            echo "<div class='form-group has-error' >";

                        else     

                            echo "<div class='form-group' >";

                    ?>

                        <label for="username" class="col-sm-4 control-label">

                            <span class="text-red">*</span><?=$this->lang->line("student_username")?>

                        </label>

                        <div class="col-sm-6">

                            <input type="text" class="form-control" id="username" name="username" value="<?=set_value('username')?>" >

                        </div>

                         <span class="col-sm-4 control-label">

                            <?php echo form_error('username'); ?>

                        </span>

                    </div>



                    <?php 

                        if(form_error('password')) 

                            echo "<div class='form-group has-error' >";

                        else     

                            echo "<div class='form-group' >";

                    ?>

                        <label for="password" class="col-sm-4 control-label">

                            <span class="text-red">*</span><?=$this->lang->line("student_password")?>

                        </label>

                        <div class="col-sm-6">

                            <input type="password" class="form-control" id="password" name="password" value="<?=set_value('password')?>" >

                        </div>

                         <span class="col-sm-4 control-label">

                            <?php echo form_error('password'); ?>

                        </span>

                    </div> -->



                    <div class="form-group">

                        <div class="col-sm-offset-2 col-sm-8">

                            <input type="submit" onclick="btn_add();" class="btn btn-success" value="<?=$this->lang->line("add_student")?>" >

                        </div>

                    </div>

                </form>

            </div> <!-- col-sm-8 -->

            

        </div><!-- row -->

    </div><!-- Body -->

</div><!-- /.box -->



<script type="text/javascript">





function getPackSection(e){$.ajax({type:"POST",url:'<?=base_url("index.php/student/getPackSection")?>',data:"id="+e,dataType:"html",success:function(e){sectionID=e,$("#sectionID").html('<input type="hidden" name="sectionID" id="sectionID" value="'+e+'">'),$(".sel_sub").each(function(){$(this).val(e).trigger("change")})},async:!1})}function chkSubject(e,a){var s=$("#classesID1").val();0!==a&&0!==s&&$.ajax({type:"POST",url:'<?=base_url("index.php/student/checkSubjectAvailable")?>',data:"subID="+e+"&classesID="+s+"&secID="+a,dataType:"html",success:function(a){"err"===a?($("#section"+e).parent().parent().addClass("has-error"),$("#error"+e).html("Subject full")):($("#section"+e).parent().parent().removeClass("has-error"),$("#error"+e).html(""))},async:!1})}$("#dob").datepicker({startView:2,dateFormat:"dd-mm-yy"});var sections="",sectionID;$("#classesID1").change(function(e){var a=$(this).val();"0"===a?$("#classesID").val(0):($.ajax({type:"POST",url:'<?=base_url("index.php/student/sectioncall")?>',data:"id="+a,dataType:"html",success:function(e){sections=e}}),$.ajax({type:"POST",url:'<?=base_url("index.php/student/callPackage")?>',data:"id="+a,dataType:"html",success:function(e){$("#packages").html(e)}}),$("#add_p").html(""),$.ajax({type:"POST",url:'<?=base_url("student/callAdditionalPackage")?>',data:"id="+a,dataType:"html",success:function(e){var a='<select id="additional_pack" class="form-control" name="additional_pack[]" multiple="multiple">'+e+"</select>";$("#add_p").html(a),setTimeout(function(){$("#additional_pack").multiselect({includeSelectAllOption:!0})},300)}}))}),$("#packages").change(function(){var e=$(this).val();"0"===e?$("#sub_section").html(""):$.ajax({type:"POST",url:'<?=base_url("index.php/student/packagesubjectcall")?>',data:"packageID="+e,dataType:"html",success:function(a){$("#sub_section").html("");var s=JSON.parse(a),t=s.subs,c=s.overs;for(var l in t)c.includes(l)?$("#sub_section").append('<div class="form-group has-error"> <label for="sub'+l+'" class="col-sm-4 control-label"> '+t[l]+' </label> <input type="hidden" name="subject[]" value="'+l+'"> <div class="col-sm-6"> <select name="section[]" id="section'+l+'" class="form-control sel_sub" onchange="chkSubject('+l+',this.value);">'+sections+'</select> </div><span class="control-label" id="error'+l+'"> Subject full</span> </div>'):$("#sub_section").append('<div class="form-group"> <label for="sub'+l+'" class="col-sm-4 control-label"> '+t[l]+' </label> <input type="hidden" name="subject[]" value="'+l+'"> <div class="col-sm-6"> <select name="section[]" id="section'+l+'" class="form-control sel_sub" onchange="chkSubject('+l+',this.value);">'+sections+'</select> </div><span class="control-label" id="error'+l+'"> </span> </div>');getPackSection(e)}})});

</script>
<!--
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
$('#').multiselect({
    columns: 1,
    placeholder: 'Select Languages',
    search: true
});
</script>
-->