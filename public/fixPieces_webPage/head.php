
<div id="window">		
    <ul id="slideshow">
        <li class="box1"><img src="<?php echo $this->baseURL(); ?>/images/diaImage1.gif" alt="Tiger"/></li>
        <li class="box2"><img src="<?php echo $this->baseURL(); ?>/images/diaImage2.gif" alt="Macaw"/></li>
        <li class="box3"><img src="<?php echo $this->baseURL(); ?>/images/diaImage3.gif" alt="Bald Eagle"/></li>
        <li class="box4"><img src="<?php echo $this->baseURL(); ?>/images/diaImage4.gif" alt="Panda"/></li>
    </ul>
</div>

<div id="departureUpdateTime">   
    The departure database was last updated:
     <?php
    $departureflihgtupdatetime = new Application_Model_DbTable_Arrivalupdatetime();
    $departureresult = $departureflihgtupdatetime->updatedeparturetimeobtain();
    //$date = new Zend_Date($result[updatedtime], 'MM-DD-YYYY HH:mm');
    
    echo $departureresult[updatedtime];        
    ?>
</div>

<div id="arrivalUpdateTime">
    The arrival database was last updated:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <?php
    $arrivalflihgtupdatetime = new Application_Model_DbTable_Arrivalupdatetime();
    $arrivalresult = $arrivalflihgtupdatetime->updatearrivaltimeobtain();
    //$date = new Zend_Date($result[updatedtime], 'MM-DD-YYYY HH:mm');
    
    echo  $arrivalresult[updatedtime];       
    ?> 
</div>






