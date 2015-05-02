<script language="javascript" type="text/javascript">
   function imgFlagError(image){
       image.onerror = "";
       image.src = "<?php echo plugins_url('/images/flags/noFlag.png', AHC_PLUGIN_MAIN_FILE) ?>";
       return true;
   }
</script>
<?php
   $myend_date = date('Y-m-d',time());
   $mystart_date = date('Y-m-d',strtotime($myend_date.' - '.(AHC_VISITORS_VISITS_LIMIT-1).' days'));
   ?>
<div class="ahc_main_container">
   <div class="hitsLogo"></div>
   <h1>&nbsp;&nbsp;Visitors Traffic Real Time Statistics <span style="font-size:15px; ">&nbsp;(<a title="Preview & Pricing" target="_blank" href="http://www.wp-buy.com/product/visitors-traffic-real-time-statistics-pro">Preview & Pricing</a>)</span></h1>
   <br />
   
   <!-- end languages links -->
   <div class="row">
      <div class="col-md-12">
         <div class="panel" >
            <h2 style="height:35px !important; font-size:13px !important" >Hits in last two weeks</h2>
            <div class="panelcontent" >
               <canvas id="visitorsVisitsChart" style="height: 400px;"></canvas>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-6">
         <!-- browsers chart panel -->
         <div class="panel">
            <h2 style="height:35px !important; font-size:13px !important"><?php echo ahc_browsers ?></h2>
            <?php
			$ahc_get_browsers_hits_counts = ahc_browsers_count();
			
               if($ahc_get_browsers_hits_counts > 0)
               {
               $tablestyes = ''; 
               }else{
               $tablestyes = 'style="display:none"';
               echo '<img src="'.plugins_url('/images/browsers_nodata.png', AHC_PLUGIN_MAIN_FILE).'" border="0" />';
               }
               ?>
            <table width="100%" border="0" cellspacing="0" <?php echo $tablestyes;?> cellpadding="2">
               <tr>
                  <td>
                     <div class="panelcontent">
                        <canvas id="brsBiechartContainer" height="400"></canvas>
                     </div>
                  </td>
                  <td>
                     <div class="legendsContainer col-md-4" id="browsersLegContainer">
                     </div>
                  </td>
               </tr>
            </table>
         </div>
      </div>
      <div class="col-md-6">
         <!-- search engines chart panel -->
         <div class="panel">
            <h2 style="height:35px !important; font-size:13px !important"><?= ahc_search_engines_in_last_20days ?></h2>
            <?php
			$ahc_get_serch_visits_by_date = ahc_search_engins_count();
			
               if($ahc_get_serch_visits_by_date > 0)
               {
               $tablestye = ''; 
               }else{
               $tablestye = 'style="display:none"';
               echo '<img src="'.plugins_url('/images/se_nodata.png', AHC_PLUGIN_MAIN_FILE).'" border="0" />';
               }
               ?>
            <table width="100%" border="0" cellspacing="0" <?php echo $tablestye;?> cellpadding="2">
               <tr>
                  <td>
                     <div class="panelcontent">
                        <canvas id="srhEngBieChartContainer" height="400"></canvas>
                     </div>
                  </td>
                  <td>
                     <div class="legendsContainer col-md-4" id="srchEngLegContainer">
                     </div>
                  </td>
               </tr>
            </table>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-6">
         <div class="panel">
            <h2 style="height:35px !important; font-size:13px !important"><?php echo ahc_refering_sites ?></h2>
            <div class="panelcontent" style="height:530px" >
               <?php
                  $referingSites = ahc_get_top_refering_sites();
                   if(sizeof($referingSites) > 0){
                     
                  if(is_array($referingSites) && !empty($referingSites)){
                  ?>
               <table width="95%" border="0" cellspacing="0">
                  <tr>
                     <th width="70%"><?php echo ahc_site_name ?></th>
                     <th width="30%"><?php echo ahc_total_times ?></th>
                  </tr>
                  <?php
                     if(is_array($referingSites)){
                         foreach($referingSites as $site){
                     ?>
                  <tr>
                     <td  class="values"><?php echo $site['site_name'] ?></td>
                     <td  class="values"><?php echo $site['total_hits'] ?></td>
                  </tr>
                  <?php
                     }
                     }
                     ?>
               </table>
               <?php }
                  }else{
                  echo '<img src="'.plugins_url('/images/topref_nodata.png', AHC_PLUGIN_MAIN_FILE).'" border="0" />'; 
                  }
                  ?>
            </div>
         </div>
      </div>
      <div class="col-md-6">
         <div class="panel">
            <h2 style="height:35px !important; font-size:13px !important"><?= ahc_latest_search_words ?></h2>
            <div class="panelcontent" style="padding-right: 50px; height:530px" >
               <?php
                  $lastSearchKeyWordsUsed = ahc_get_latest_search_key_words_used();
                  if(sizeof($lastSearchKeyWordsUsed) > 0)
                  {
                  if(is_array($lastSearchKeyWordsUsed)){
                  	foreach($lastSearchKeyWordsUsed as $searchWord){
                  	$visitDate = new DateTime($searchWord['hit_date']);
                  
                  ?>
               <div class="lastSearchKeyWords">
                  <span class="visitDateTime"><?= $searchWord['hit_ip_address'] ?>&nbsp;-&nbsp;<?= $visitDate->format('d/m/Y') ?></span>			
                  <div class="cleaner"></div>
                  <span>
                  <img src="<?= plugins_url('/images/search_engines/'.$searchWord['srh_icon'], AHC_PLUGIN_MAIN_FILE) ?>" border="0" width="22" height="22" 
                     title="<?= $searchWord['srh_name'] ?>" /></span>
                  <span>
                  <img src="<?= plugins_url('/images/browsers/'.$searchWord['bsr_icon'], AHC_PLUGIN_MAIN_FILE) ?>" border="0" width="20" height="20" 
                     title="<?= $searchWord['bsr_name'] ?>" /></span>
                  <span class="searchKeyWords"><a href="<?= $searchWord['hit_referer'] ?>" target="_blank"><?= $searchWord['hit_search_words'] ?></a></span>
               </div>
               <?php
                  }
                  }
                  
                  }else{
                  echo '<img src="'.plugins_url('/images/latestwords_nodata.png', AHC_PLUGIN_MAIN_FILE).'" border="0" />'; 
                  }
                  ?>
            </div>
         </div>
      </div>
   </div>
   <div>
      <a target="_blank" href="http://www.wp-buy.com/product/visitors-traffic-real-time-statistics-pro">
         <p style="color:#00F; font-size:15px;">if you need more statistics you can upgrade to professional version now, The premium version of visitors traffic real time statistics is completely different from the free version as there are a lot more features included.</p>
         <p><img style="border:#CCC solid 1px; margin-right:30px" height="151px" src="<?php echo plugins_url('/images/upgradenow-button.png', AHC_PLUGIN_MAIN_FILE) ?>" /><img style="border:#CCC solid 1px"  src="<?php echo plugins_url('/images/widget.png', AHC_PLUGIN_MAIN_FILE) ?>" /></p>
      </a>
   </div>
</div>
<script language="javascript" type="text/javascript">
  
   
   
   var visitsData = <?php echo json_encode(ahc_get_visitors_visits_by_date()); ?>;
   var browsersData = <?php echo json_encode(ahc_get_browsers_hits_counts()); ?>;
   var srhEngVisitsData = <?php echo json_encode(ahc_get_serch_visits_by_date()); ?>;
   jQuery(document).ready(function(){
   //------------------------------------------
   	if(visitsData.success && typeof visitsData.data != 'undefined'){
   		drawVisitsLineChart(visitsData);
   	}
   //------------------------------------------
   	if(browsersData.success && typeof browsersData.data != 'undefined'){
   		drawBrowsersBieChart(browsersData.data);
   	}
   //------------------------------------------
   	if(srhEngVisitsData.success && typeof srhEngVisitsData.data != 'undefined'){
   
   		drawSrhEngVstLineChart(srhEngVisitsData);
   	}
   //------------------------------------------
   });
</script>