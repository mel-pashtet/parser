<!--Navigation Background Part Starts -->
<div id="navigation-bg">
    <!--Navigation Part Starts -->
    <div id="navigation">
        <ul class="mainMenu">
            <li><?php echo $this->Html->link('Home', array('controller'=>'site', 'action' => 'index'));?></li>
            <li><?php echo $this->Html->link('Управление товарами', array('controller'=>'goods', 'action' => 'index'));?></li>
            <li><?php echo $this->Html->link('Управление контрагентами', array('controller'=>'partners', 'action' => 'index'));?></li>
        </ul>
        <!-- <a href="#" class="signup" title="signup now"></a> -->
        <?php echo $this->Html->link('', array('controller'=>'users', 'action' => 'login'), arraY('class' => 'signup'));?>

    </div>
    <!--Navigation Part Ends -->
</div>
<!--Navigation Background Part Ends -->