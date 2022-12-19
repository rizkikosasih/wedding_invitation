<!-- Main content -->
<section class="content">
     <div class="container-fluid">
          <div class="row">
               <div class="col-12">
                    <div class="card card-primary card-outline">
                         <div class="card-header border-bottom-0">
                              <ul class="nav nav-tabs list-event" id="list-tabs" role="tablist">
                                   <?php foreach ($list_tab as $k => $lt): $rname = str_replace(' ', '-', strtolower($lt->name)); ?>
                                        <li class="nav-item">
                                             <a 
                                                  class="nav-link <?= $k == 0 ? 'active' : '' ?>" 
                                                  id="custom-tabs-<?= $rname ?>" 
                                                  data-toggle="pill" 
                                                  href="#<?= $rname ?>" 
                                                  role="tab" 
                                                  aria-controls="<?= $rname ?>" 
                                                  aria-selected="true"
                                             >
                                                  <?= $lt->name ?>
                                             </a>
                                        </li>
                                   <?php endforeach; ?>
                              </ul>
                         </div>

                         <div class="tab-content" id="list-tabs">
                              <?php 
                                   foreach ($list_tab as $k => $lt): 
                                        $rname = str_replace(' ', '-', strtolower($lt->name)); 
                                        $saveData = [
                                             'receptionDate' => getDates('date', $e->reception_date),
                                             'weddingDate' => getDates('date', $e->wedding_date),
                                        ];
                                   ?>
                                   <div 
                                        class="tab-pane fade <?= $k == 0 ? 'active show p-3' : '' ?>" 
                                        id="<?= $rname ?>" 
                                        role="tabpanel" 
                                        aria-labelledby="custom-tabs-<?= $rname ?>"
                                   >
                                        <?php 
                                             if ($lt->id == 1)://setting event 
                                                  $this->load->view('admin/event/event_detail', $saveData);
                                             elseif ($lt->id == 2):
                                                  $this->load->view('admin/event/love_story');
                                             elseif ($lt->id == 3):
                                                  $this->load->view('admin/event/gallery');
                                             else: 
                                                  echo '
                                                  <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam odio magna, mollis auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper felis aliquam id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl, id tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit, condimentum ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur.</div>';
                                             endif;
                                        ?>
                                   </div>
                              <?php endforeach; ?>
                         </div>
                    </div>
               </div>
          </div>
          <!--/. row -->
     </div>
     <!--/. container-fluid -->
</section>
<!-- /.main content -->