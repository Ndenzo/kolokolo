<?php include_once('help.php');?>
<?php show_notification();?>
<div class="row">
  <div class="col-md-12"> 
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet light bordered">
      <div class="portlet-title">
        <div class="caption font-dark"> <i class="icon-settings font-dark"></i> <span class="caption-subject bold uppercase">Historique de connection</span> </div>
        <div class="actions"> <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;"> <i class="fa fa-question"></i> </a> </div>
      </div>
      <div class="portlet-body">
        <table id="datagrid" class="datagrid table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th style="witdth:20%"> Adresse IP </th>
              <th style="witdth:60%"> Navigateur </th>
              <th style="witdth:20%"> Enregistrement </th>
            </tr>
          </thead>
          <tbody>
            <?php if(is_array(@$datagrid)):?>
            <?php foreach($datagrid as $rows):?>
            <tr>
              <td><?=$rows->ip_adress?></td>
              <td><?=$rows->user_agent?></td>
              <td><?=gmdate('d/m/Y h:i:s',$rows->timestamp)?></td>
            </tr>
            <?php endforeach;?>
            <?php endif;?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET--> 
  </div>
</div>
