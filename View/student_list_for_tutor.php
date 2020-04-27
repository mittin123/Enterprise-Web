<!-- MAIN CONTENT-->
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">                     
                       
<!--   Coppy doan nay, -->

<!--   Coppy doan nay, -->
<!--   Coppy doan nay, -->
<!--   Coppy doan nay, -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                    <h1>Tutor's Student List</h1>
                                    </div>
                                    <div class="table-data__tool-right">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">A-Z</button>
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">Last Interaction</button>
                                    </div>
                                </div>
                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>

                                            <!--   Dat lenh foreach o day, -->
                                            <tr>
                                                <th>Student name</th>
                                                <th>Up Comming Arrangement</th>
                                                <th>Last Interaction</th>
                                                <th>New Arrangement</th>
                                                <th>New Folder</th>
                                                <th>Chat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                    foreach($data as $item){
                                                        
                                                    
                                                ?>
                                                <td><?=$item['name']?></td>
                                                <td>1</td>
                                                <td>20/04/2020</td>
                                                <td>
                                                    <a href="">
                                                      <button type="button" class="btn btn-info" value="<?=$c['packageID']?>">New Arrangement</button>
                                                     </a>
                                                </td>
                                                <td>
                                                    <a href="">
                                                      <button type="button" class="btn btn-info" value="<?=$c['packageID']?>">New Folder</button>
                                                     </a>
                                                </td>
                                                <td>
                                                    <a href="">
                                                      <button type="button" class="btn btn-info" value="<?=$c['packageID']?>">Chat</button>
                                                     </a>
                                                </td>
                                                <?php
                                                    }
                                                ?>
                                            </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>
    </div>