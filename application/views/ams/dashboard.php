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
        <div class="block-heading">
            <span class="block-icon pull-right">
                <a href="#" class="demo-cancel-click" rel="tooltip" title="Click to refresh"><i class="icon-refresh"></i></a>
            </span>

            <a href="#widget2container" data-toggle="collapse">History</a>
        </div>
        <div id="widget2container" class="block-body collapse in">
            <table class="table list">
              <tbody>
                  <tr>
                      <td>
                          <p><i class="icon-user"></i> Mark Otto</p>
                      </td>
                      <td>
                          <p>Amount: $1,247</p>
                      </td>
                      <td>
                          <p>Date: 7/19/2012</p>
                          <a href="#">View Transaction</a>
                      </td>
                  </tr>
                  <tr>
                      <td>
                          <p><i class="icon-user"></i> Audrey Ann</p>
                      </td>
                      <td>
                          <p>Amount: $2,793</p>
                      </td>
                      <td>
                          <p>Date: 7/12/2012</p>
                          <a href="#">View Transaction</a>
                      </td>
                  </tr>
                  <tr>
                      <td>
                          <p><i class="icon-user"></i> Mark Tompson</p>
                      </td>
                      <td>
                          <p>Amount: $2,349</p>
                      </td>
                      <td>
                          <p>Date: 3/10/2012</p>
                          <a href="#">View Transaction</a>
                      </td>
                  </tr>
                  <tr>
                      <td>
                          <p><i class="icon-user"></i> Ashley Jacobs</p>
                      </td>
                      <td>
                          <p>Amount: $1,192</p>
                      </td>
                      <td>
                          <p>Date: 1/19/2012</p>
                          <a href="#">View Transaction</a>
                      </td>
                  </tr>
                    
              </tbody>
            </table>
        </div>
    </div>
    <div class="block span6">
        <p class="block-heading">Not Collapsible</p>
        <div class="block-body">
            <h2>Tip of the Day</h2>
            <p>Fava bean jícama seakale beetroot courgette shallot amaranth pea garbanzo carrot radicchio peanut leek pea sprouts arugula brussels sprout green bean. Spring onion broccoli chicory shallot winter purslane pumpkin gumbo cabbage squash beet greens lettuce celery. Gram zucchini swiss chard mustard burdock radish brussels sprout groundnut. Asparagus horseradish beet greens broccoli brussels sprout bitterleaf groundnut cress sweet pepper leek bok choy shallot celtuce scallion chickpea radish pea sprouts.</p>
            <p><a class="btn btn-primary btn-large">Learn more &raquo;</a></p>
        </div>
    </div>
</div>

