<?php include_once('help.php');?>
<?php show_notification();?>
<!-- BEGIN  PORTLET-->
<div class="portlet light shadow has-decoration-bottom">
    <div class="portlet-title">
        <div class="caption font-dark"> <i class="icon-layer font-dark"></i> <span class="caption-subject bold uppercase">Liste des sauvegardes</span> </div>
        <div class="actions"> <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;"> <i class="fa fa-question"></i> </a> </div>
    </div>
    <div class="portlet-body">
        <div class="table-toolbar" style="border: 1px solid #d4d4d4; padding: 4px;background: #efefef;">
            <div class="pull-right">
                <div class="btn-group btn-group-solid btn-group-circle">
                <a href="<?php _url('security/database/backup/');?>" class="btn btn-default "> Sauvegarder <i class="fa fa-save"></i> </a>
                <a href="<?php _url('security/database/optimize/');?>" class="btn btn-default "> Optimiser <i class="fa fa-bolt"></i> </a>
                <a href="<?php _url('security/database/repair/');?>" class="btn btn-default "> Reparer <i class="fa fa-cog"></i> </a>
                </div>
            </div>
        </div>
        <table class="backup table table-striped table-bordered table-hover table-checkable">
            <thead>
            <tr>
                <th style="width:1%;">
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="group-checkable" data-set=".backup .checkboxes">
                        <span></span>
                    </label>
                </th>
                </th>
                <th> Sauvegarde </th>
                <th style="width: 1%" class="no-sort text-center"> Taille</th>
                <th style="width: 1%" class="no-sort text-center"> Statut </th>
                <th style="width: 1%;" class="no-sort text-center"> Actions </th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array(@$datagrid)):?>
                <?php foreach($datagrid as $rows):
                    $statut = ($rows->filesize-filesize($rows->filename));
                    ?>
                    <tr>
                        <td>
                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                <input name="selected[]" type="checkbox" class="checkboxes" value="<?=@$rows->backup_id?>" />
                                <span></span>
                            </label>
                        </td>
                        <td><?=@$rows->filename?></td>
                        <td><?=format_filesize(@$rows->filesize)?></td>
                        <td nowrap="">
                            <?php if($statut!=0):?>
                                <label class="label label-danger">mauvais</label>
                            <?php else:?>
                                <label class="label label-success">mauvais</label>
                            <?php endif;?>
                        </td>
                        <td class="text-center" nowrap>
                            <a href="<?php _url('security/database/backup_download/'.$rows->backup_id);?>" class="btn btn-icon-only btn-circle cranberry"><i class="fa fa-download"></i></a>
                            <a href="<?php _url('security/database/delete/'.$rows->backup_id);?>" class="btn btn-icon-only btn-circle red"><i class="fa fa-trash"></i></a></td>
                    </tr>
                <?php endforeach;?>
            <?php endif;?>
            </tbody>
        </table>
    </div>
</div>
<!-- END  PORTLET-->