<?php require_once "Ti.php";?>
<?php Ti::extend("p1.php")?>
    <?php Ti::startBlock("contens");?>
        Esto es el contenido de p2
    <?php Ti::endBlock(); ?>
    <?php Ti::startBlock("aside");?>
        <?php Ti::getExtendedBlock() ?>    
    Tengo el aside de p2
        
    <?php Ti::endBlock(); ?>
<?php  Ti::endExtend();?>
