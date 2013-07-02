<div class="container-fluid">
            <div class="row-fluid">
                    

<div class="row-fluid">

    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Just a quick note:</strong> Hope you like the theme!
    </div>

    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">Latest Stats</a>
        <div id="page-stats" class="block-body collapse in">

            <div class="stat-widget-container">
                <div class="stat-widget">
                    <div class="stat-button">
                        <p class="title"><?php foreach($query_open as $stat):echo $stat->open;endforeach;?></p>
                        <p class="detail">Open</p>
                    </div>
                </div>

                <div class="stat-widget">
                    <div class="stat-button">
                        <p class="title"><?php foreach($query_progress as $stat):echo $stat->progress;endforeach;?></p>
                        <p class="detail">Progress</p>
                    </div>
                </div>

                <div class="stat-widget">
                    <div class="stat-button">
                        <p class="title"><?php foreach($query_completed as $stat):echo $stat->completed;endforeach;?></p>
                        <p class="detail">Completed</p>
                    </div>
                </div>

                <div class="stat-widget">
                    <div class="stat-button">
                        <p class="title"><?php foreach($query_closed as $stat):echo $stat->closed;endforeach;?></p>
                        <p class="detail">Closed</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="block span6">
        <a href="#widget1container" class="block-heading" data-toggle="collapse">OPEN </a>
        <div id="tablewidget" class="block-body collapse in">
            <table class="table">
              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>No Agenda</th>
                  <th>No Document</th>
                  <th>Judul</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($list_open as $open):{ ?>
                <tr>
                  <td><?php echo mdate("%d-%m-%Y %h:%i", strtotime($open->dp_update_on)) ;?></td>
                  <td><?php echo $open->docs_no ;?></td>
                  <td><?php echo $open->docs_no ;?></td>
                  <td><?php echo $open->docs_subject ;?></td>
                </tr>
                <?php } endforeach; ?> 
              </tbody>
            </table>
            <p><a href="users.html">More...</a></p>
        </div>
    </div>

    <div class="block span6">
        <a href="#widget1container" class="block-heading" data-toggle="collapse">PROGRESS </a>
        <div id="widget1container" class="block-body collapse in">
        	<table class="table">
              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>No Agenda</th>
                  <th>No Document</th>
                  <th>Judul</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($list_open as $open):{ ?>
                <tr>
                  <td><?php echo mdate("%d-%m-%Y %h:%i", strtotime($open->dp_update_on)) ;?></td>
                  <td><?php echo $open->docs_no ;?></td>
                  <td><?php echo $open->docs_no ;?></td>
                  <td><?php echo $open->docs_subject ;?></td>
                </tr>
                <?php } endforeach; ?> 
              </tbody>
            </table>
            <p><a href="users.html">More...</a></p>    
        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="block span6">
        <a href="#widget1container" class="block-heading" data-toggle="collapse">COMPLETED </a>
        <div id="tablewidget" class="block-body collapse in">
            <table class="table">
              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>No Agenda</th>
                  <th>No Document</th>
                  <th>Judul</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($list_open as $open):{ ?>
                <tr>
                  <td><?php echo mdate("%d-%m-%Y %h:%i", strtotime($open->dp_update_on)) ;?></td>
                  <td><?php echo $open->docs_no ;?></td>
                  <td><?php echo $open->docs_no ;?></td>
                  <td><?php echo $open->docs_subject ;?></td>
                </tr>
                <?php } endforeach; ?> 
              </tbody>
            </table>
            <p><a href="users.html">More...</a></p>
        </div>
    </div>
	
    
    <div class="block span6">
        <a href="#widget1container" class="block-heading" data-toggle="collapse">CLOSED </a>
        <div id="tablewidget" class="block-body collapse in">
            <table class="table">
              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>No Agenda</th>
                  <th>No Document</th>
                  <th>Judul</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($list_open as $open):{ ?>
                <tr>
                  <td><?php echo mdate("%d-%m-%Y %h:%i", strtotime($open->dp_update_on)) ;?></td>
                  <td><?php echo $open->docs_no ;?></td>
                  <td><?php echo $open->docs_no ;?></td>
                  <td><?php echo $open->docs_subject ;?></td>
                </tr>
                <?php } endforeach; ?> 
              </tbody>
            </table>
            <p><a href="users.html">More...</a></p>
        </div>
    </div>
</div>
	

