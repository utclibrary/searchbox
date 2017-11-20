<?php
/*
v3.00
move search to Primo
v2.1
changed http to https on external calls
v2 changes
*moved ask button and quick links to OUCampus
*added override id to enclosing div to circumvent OUCampus css
*integrated code to narrow db selection by subjects
*removed articles and eBooks+ tabs
*added message to subjects tab with goal to remove this tab based on usage
*type-ahead feature
*text input fields synchronized and clearable
*added accordion multi-subject on db page
*/
// block error reporting for live code (0) off (-1) all
error_reporting(0);
date_default_timezone_set('America/New_York');
$today = time();
// set link for Search Help for first three tabs - need to set back after semester start (<a href="/library/help/tutorials/research-bascis.php">Search Help</a>)
$searchHelpLink='<a class="btn btn-mini search-xtra-left" href="/library/help/tutorials/reseach-basics.php">Search Help</a>';
// emergency message within the search box
/*$endTime = 1420315200;
$emergMessage = "<br/><br/><p><font color='red'>The UTC Library catalog will be down for vendor scheduled maintenance from Midnight to 3pm on Saturday, January 3rd.
		This outage will affect the Everything, Articles, Journals, and Reserves tabs of our search box along with select databases.
		We apologize for the inconvenience.</font></p>";
		*/
?>
<!-- dev v3.01 -->
<div id="libsearch-override" class="well well-raised">
	<section id='section-tabs'>
	<div id='searchboxcenter'>
<!-- BEGIN tabs default 'desktop' display-->
	<ul data-position='right' class='nav nav-tabs' id="tabs">

			<li class='active'><a href='#everything' data-toggle='tab'>Primo Search</a></li>
			<li><a href='#databases' data-toggle='tab'>Databases</a></li>
      <li><a href='#subjects' data-toggle='tab'>Subjects</a></li>
      <li><a href='#journals' data-toggle='tab'>Journals</a></li>
      <li><a href='#courses' data-toggle='tab'>Reserves</a></li>

			</ul>
<!-- END tabs -->
<!-- BEGIN select for responsive display on mobile
			<ul class='hide nav nav-tabs' id='tabs-select'>
				<li> <a href='#' class='dropdown-toggle' data-toggle='dropdown'></a>
			<ul class='dropdown-menu' role='menu'>
<?php //	echo $searchTabLiBlock;?>
			</ul>
				 	</li>
			</ul>
 END select -->
<div id='myTabContent' class='tab-content'>
	<div class='tab-pane active' id='everything'>
			<form aria-label="quick search form" class='form-search' name='everything' action="https://utc.primo.exlibrisgroup.com/discovery/search" enctype="application/x-www-form-urlencoded; charset=utf-8" onsubmit="searchPrimo()" method="get" target='_blank'>
				<label for="searchAll" class="hide">Search Books, Articles, Movies, and More...</label>
				<input type='text' id="searchAll" aria-label="search input for quick search" placeholder='Search Books, Articles, Movies, and More...' class='input-xxlarge clearable' style="font-size: 1.25em;min-height: 2em;margin: .5em 0 .5em 0;" required />
				<input type="hidden" name="query" id="primoQuery">
				<input type="hidden" name="vid" value="01UTC_INST:01UTC">
				<input type="hidden" name="tab" value="Everything">
				<button id="Everything" onclick="searchPrimo()"  type='submit' class='btn search-btn btn-primary' style="margin: 0 .5em 0 .5em;min-height: 3em;">Search</button>
				<div class="spacer"></div>
<!--
				<label for="everythingformat" aria-label="limit quick search results to">Limit results to:</label>
				<select id="everythingformat" class='input-medium' name='tab'>
					<option value='Everything' selected>Everything</option>
							<option value='Book'>Books</option>
							<option value='Book::book_digital'>eBooks</option>
							<option value='Video'>Videos</option>
							<option value='Video::video_digital'>eVideos</option>
							<option value='Music'>Music</option>
							<option value='Music::music_digital'>eMusic</option>
							<option value='Artchap'>Articles</option>
					</select>
						<label for="everythingscope" class="hide">search scope</label>
					<select id="everythingscope" aria-label="search scope for quick search" class='input-large' name='search_scope'>
						<option value='WorldCat'>Libraries Worldwide</option>
						<option value='MyInst_and_CI' selected>UTC</option>
					</select>
-->
	</form>
	<?php echo $searchHelpLink; ?>
				<a class="btn btn-mini search-xtra-right" href="https://utc.primo.exlibrisgroup.com/discovery/search?vid=01UTC_INST:01UTC&sortby=rank&mode=advanced" target="_blank">Advanced Search</a>
	<?php if ($today < $endTime) echo $emergMessage; ?>
	</div>

<div class='tab-pane' id='journals'>

	<form class='form-search' name='journals' action='https://utc.primo.exlibrisgroup.com/discovery/jsearch' enctype="application/x-www-form-urlencoded; charset=utf-8" method='get' target='_blank'>
	<label for="query-search-UTCL-home" class="hide" aria-label="journals search input">Search Journal</label>

	<input id="primoQueryJ" name="query" type="hidden" />
		<input name="tab" type="hidden" value="jsearch_slot" />
		<input name="vid" type="hidden" value="01UTC_INST:01UTC" />
		<input name="offset" type="hidden" value="0" />
	 <input id="primoQueryjournals" name="journals" type="hidden" />
	<input  id="query-search-UTCL-home" type='text' placeholder='Enter Journal Title or ISSN' class='input-xxlarge clearable' name='jtitle' style="font-size: 1.25em;min-height: 2em;margin: .5em 0 .5em 0;" required />
	<button id="Journals" type='submit' class='btn search-btn btn-primary' onclick="searchPrimoJ()" style="margin: 0 .5em 0 .5em;min-height: 3em;">Search</button>
	<div class="spacer"></div>
	<!--
		<label for="journalsscope" aria-label="limit journals results to">Search type:</label>
			<select id="journalsscope" class='input-medium' name='search_field'>
				<option value='title' selected>Title</option>
				<option value='issn'>ISSN</option>
		</select>

	<label class="hide" for="searchBy-UTCL-home" aria-label="what to match">what to match</label>
		<select id="searchBy-UTCL-home" class='input-medium' name='searchType'>
			<option value='startsWith' selected>Starts With</option>
			<option value='matchExact'>Match Exact</option>
			<option value='matchAll'>Match All</option>
			<option value='matchAny'>Match Any</option>
		</select>
			-->
	</form>
<small class="pull-left"><?php echo $searchHelpLink; ?></small>
<?php if ($today < $endTime) echo $emergMessage; ?>
</div>

<div class='tab-pane' id='databases'>
<?php $url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	// connect to database
	require_once ('mysqlconnect.php');
  //
	$query1 = "SELECT * FROM SubjectList INNER JOIN DBRanking ON SubjectList.Subject_ID = DBRanking.Subject_ID
						WHERE SubjectList.Format = 0 AND SubjectList.NotSubjectList = 0 AND TryTheseFirst = 1
            GROUP BY SubjectList.Subject_ID ORDER BY Subject";
//eliminate SubjectList.Format = 0 to pull in all groups (ex: multiusbject, ebooks, etc.)
	$result1 = mysql_query($query1);
	$count = 0;

	while($row = mysql_fetch_array($result1))
	{
    //don't show any with format 1
    //if ($row['Format']!=='1'){
    $count = $row['Subject_ID'];
		$dbFormat[$count] = $row['SubjectCode'];
		$dbFormatKey[$count] = $row['Subject_ID'];
		$dbFormatName[$count] = $row['Subject'];
    $dbLGpage[$count] = $row['LibGuidesPage'];
		//$count++;
  //}
}
echo "<label class='limitbysubject hide' style='display:none' aria-label='limit by subject' for='databaseformat'>Limit by Subject</label>
      <select name='databaseformat' id='databaseformat' class='input-xlarge jumptosubject'>
      ";
//remove for select2 type ahead
echo "<option></option>";
//for ($i=0; $i<$count; $i++) {
foreach ($dbFormatKey as $key => $i){
    echo "<option value='$dbFormatKey[$i]'>$dbFormatName[$i]</option>";
    ${"libGuideSub".$i}="
    <a class='btn btn-block lgbtn' href='https://guides.lib.utc.edu/".$dbLGpage[$i]."'
    target='_blank'>". $dbFormatName[$i]." Subject Guide</a>";
  }
echo "</select>";
		?>
    <button type="reset" value="reset" id="resetDb" title="reset all fields" aria-label="reset"><i class="icon-remove-circle icon-2x"><!-- reset icon --></i> reset all</button>

	<script type="text/javascript">
	window.onload = function()
	{
		var formatId = document.getElementById('databaseformat');
		var allDb = document.getElementById('allDb');
		var jumptodatabase = document.getElementById('jumptodatabase');
		<?php
foreach ($dbFormatKey as $key => $i){
      ?>
			var <?php echo $dbFormat[$i]; ?> = document.getElementById('<?php echo $dbFormat[$i]; ?>');
			var <?php echo $dbFormat[$i] . "List"; ?> = document.getElementById('<?php echo $dbFormat[$i] . "List"; ?>');
		<?php } ?>

		formatId.onchange = function()
		{
      console.log('135 onchange function called');
			$('#resetDb').show();
      $('#descriptions').empty();
      $('span.db-legend').hide();
			jumptodatabase.value = 0;
			<?php foreach ($dbFormatKey as $key => $i){ ?>
				<?php echo $dbFormat[$i] . "List"; ?>.value = 0;
			<?php } ?>
			var formatValue = formatId.value;
			if(formatValue == 0){ allDb.style.display = 'block';
      $("a#lgSubjBtn").replaceWith("<a id='lgSubjBtn' class='btn' href='https://guides.lib.utc.edu/' target='_blank'>Subject Guides</a>");
			$('#resetDb').hide();
      //$('a.search-xtra-left').replaceWith(""); // need to pull  from array
    }else{ allDb.style.display = 'none';
		/*
		$('#subjectSelect .search-btn').prop('disabled', true);
		$('#subjectSelect .search-btn').text('Select');
		*/
      <?php foreach ($dbFormatKey as $key => $i){ ?>
      }
        if(formatValue == <?php echo $dbFormatKey[$i]; ?>){
          $("a#lgSubjBtn").replaceWith("<a id='lgSubjBtn' class='lgSubjBtn btn-primary btn' href='https://guides.lib.utc.edu/<?php echo $dbLGpage[$i] ?>' target='_blank'><?php echo $dbFormatName[$i]; ?> Subject Guide</a>");
        <?php echo $dbFormat[$i]; ?>.style.display = 'block';
      }else{ <?php echo $dbFormat[$i]; ?>.style.display = 'none';
			<?php } ?>
    }
		};
	};
	</script>
	<?php
  // get all descriptions
  $query3 =  "SELECT Dbases.Title, Dbases.Key_ID, Dbases.OpenAccess, Dbases.ShortDescription, Dbases.ContentType, Dbases.HighlightedInfo, Dbases.SimUsers
              FROM Dbases
              WHERE Dbases.CANCELLED = 0 AND Dbases.MASKED = 0
              ORDER BY Dbases.Title";

  $result3 = mysql_query($query3);

  if (!$con || empty($result3))
    {
      echo "Database search is currently unavailable.";
    }
    else
    {
      $keyID = 1;
      while($row = mysql_fetch_array($result3))
    {
      $keyID = $row['Key_ID'];
      if (!empty($row['ContentType']))
      $dbDescrip[$keyID] = "<span class='ContentType'>" . $row['ContentType'] . ": </span>";
      $dbDescrip[$keyID] .= $row['ShortDescription'];
      if (($row['OpenAccess']) == '1')
      $dbDescrip[$keyID] .= "<a  id='oa_icon' title='open access resource' href='https://guides.lib.utc.edu/openaccess/overview' target='_blank'><img src='//www.utc.edu/library/_resources/icon-oa.svg' alt='open access icon: an open padlock'></img></a>";
      if (!empty($row['HighlightedInfo']))
      $dbDescrip[$keyID] .= "<span class='highlight'>  " . $row['HighlightedInfo'] . "</span>";
      if ($row['SimUsers'] == 1)
      $dbDescrip[$keyID] .= "<span class='highlight'>  Limited to " . $row['SimUsers'] . " simultaneous user.</span>";
      else if ($row['SimUsers'] > 1)
      $dbDescrip[$keyID] .= "<span class='highlight'>  Limited to " . $row['SimUsers'] . " simultaneous users.</span>";
      if (strlen($dbDescrip[$keyID])<107)
      $dbDescrip[$keyID] .= "";
      $dbDescrip[$keyID] = preg_replace('/"/','\'',$dbDescrip[$keyID]);
      //$count++;
    }
  }
	$query2 =  "SELECT Dbases.Title, Dbases.Key_ID, Dbases.OpenAccess, Dbases.ShortDescription, Dbases.ContentType, Dbases.HighlightedInfo, Dbases.SimUsers
              FROM Dbases
						  WHERE NotAtoZ = 0 AND Dbases.CANCELLED = 0 AND Dbases.MASKED = 0
              ORDER BY Dbases.Title";

	$result2 = mysql_query($query2);

	if (!$con || empty($result2))
		{
			echo "Database search is currently unavailable.";
		}
		else
		{
			$count = 1;
			while($row = mysql_fetch_array($result2))
		{
      $count = $row['Key_ID'];
			$dbTitle[$count] = $row['Title'];
			$dbID[$count] = $row['Key_ID'];
			//$count++;
		}
    ?>
<script type="text/javascript">
function changetext(elemid){
	if (elemid === 'jumptodatabase'){
	//$('.select2-container').hide();
}
  console.log('230 changetext function called');
	if ($('#jumptodatabase').val() === ''){$('#resetDb').hide();
	/*
$('#subjectSelect .search-btn').prop('disabled', true);
$('#subjectSelect .search-btn').text('Select');
*/
}
  else{$('#resetDb').show();
	/*
	$('#subjectSelect .search-btn').prop('disabled', false);
	$('#subjectSelect .search-btn').text('Go');
	*/
}
	$('span.db-legend').hide();
	var ind = document.getElementById(elemid).value;// change to selected
  if (ind == "") {ind = "0";}
	var description = new Array();
	description[0] = "";
<?php foreach ($dbDescrip as $key => $value){ ?>
description[<?php echo $key; ?>] = "<?php echo $value; ?>";
<?php } ?>
$("#databases span.db-legend").remove();
document.getElementById('descriptions') .innerHTML = description[ind];
$( "span:contains('Ebooks: ')" ).parent('p').before( "<span class='icon-book icon-large db-legend' title='Ebooks' onclick='showLegendModal();'></span>" );
$( "span:contains('Index: ')" ).parent('p').before( "<span class='icon-list-alt icon-large db-legend' title='Index' onclick='showLegendModal();'></span> " );
$("span").filter(function() {return $(this).text() == "Fulltext: ";}).parent('p').before( "<span class='icon-file-text icon-large db-legend' title='Fulltext' onclick='showLegendModal();'></span> " );
$( "span:contains('Partial Fulltext: ')" ).parent('p').before( "<span class='icon-file-alt icon-large db-legend' title='Partial Fulltext' onclick='showLegendModal();'></span> " );
$( "span:contains('Streaming Video: ')" ).parent('p').before( "<span class='icon-film icon-large db-legend' title='Streaming Video' onclick='showLegendModal();'></span> " );
$( "span:contains('Streaming Music: ')" ).parent('p').before( "<span class='icon-music icon-large db-legend' title='Streaming Music' onclick='showLegendModal();'></span> " );
$( "span:contains('Images: ')" ).parent('p').before( "<span class='icon-picture icon-large db-legend' title='Images' onclick='showLegendModal();'></span> " );
		}
  </script>
<form class='form-search' name='databases' action='https://www5.utc.edu/databases/LGForward.php' method='get' target='_blank'>
	<input type='hidden' name='url' value=$url></input>
	<div id='allDb' style='display: block;'>
	<label for="jumptodatabase" class="hide" aria-label="select databases from full list">Select Database</label>
			<select id="jumptodatabase" name='db0' class='selectdb input-xxlarge jumptodatabase' onChange="changetext('jumptodatabase');">
					<option></option>

          <?php foreach ($dbID as $key => $value){
						echo "<option value='" . $dbID[$value] ."'>" . $dbTitle[$value] . "</option>";
					} ?>
				</select>
		<button id="Databases" type='submit' class='btn search-btn btn-primary'>Go</button>
  </div><div id="subjectSelect">
<?php
foreach ($dbFormatKey as $key => $i){
	$query3 = "SELECT Dbases.Title, Dbases.Key_ID, Dbases.OpenAccess, Dbases.ShortDescription, Dbases.ContentType, Dbases.HighlightedInfo, Dbases.SimUsers
            FROM Dbases INNER JOIN DBRanking ON Dbases.Key_ID = DBRanking.Key_ID
		        WHERE Dbases.CANCELLED = 0 AND Dbases.MASKED = 0 AND DBRanking.Subject_ID = $dbFormatKey[$i]
            ORDER BY DBRanking.Ranking";
	$result3 = mysql_query($query3);
	echo "<div id='$dbFormat[$i]' style='display: none;'>
  <label for='" . $dbFormat[$i] . "List' class='hide' aria-label='select " . $dbFormatName[$i] . " databases'>Select from ".$dbFormatName[$i]." databases</label>
		<select name='db" . $dbFormatKey[$i] . "' class='input-xxlarge selectdb' id='" . $dbFormat[$i] . "List' onChange='changetext(\"" . $dbFormat[$i] . "List\");'>
			<option value='0' selected>Select from ".$dbFormatName[$i]." databases</option>";
			while($row = mysql_fetch_array($result3))
			{
				echo "<option value='" . $row['Key_ID'] ."'>" . $row['Title'] . "</option>";
			}
	echo "</select>";
	echo " <button type='submit' class='btn search-btn btn-primary'>Go</button>
  </div>";
}
?>
  	</div>
	<p class="muted" id="descriptions"></p>
  	</form>
	<?php } ?>
	<div id="dbLegendModal" class="modal hide fade">
	<div class="modal-header"><button class="close" type="button" data-dismiss="modal">×</button>
		<h3>Database Types</h3>
	</div>
	<div class="modal-body">
	<ul id="db-legend">
		<li><span class='icon-book icon-large'><span class='hidden'>ebooks</span></span>Ebooks</li>
		<li><span class='icon-file-text icon-large'><span class='hidden'>fulltext</span></span>Fulltext</li>
		<li><span class='icon-picture icon-large'><span class='hidden'>images</span></span>Images</li>
		<li><span class='icon-list-alt icon-large'><span class='hidden'>index</span></span>Index</li>
		<li><span class='icon-file-alt icon-large'><span class='hidden'>partial fulltext</span></span>Partial Fulltext</li>
		<li><span class='icon-music icon-large'><span class='hidden'>streaming music</span></span>Streaming Music</li>
		<li><span class='icon-film icon-large'><span class='hidden'>streaming videos</span></span>Streaming Video</li>
	</ul>
	</div>
	</div>
<!--
<a data-toggle="tooltip" title="Not sure where to start? Explore databases grouped by subject"class="btn btn-mini search-xtra-left" href="https://guides.lib.utc.edu/eresources" target="_blank">Databases By Subject</a>
-->

<a id="lgSubjBtn" class="btn" href="https://guides.lib.utc.edu/" target="_blank">Subject Guides</a>


<div class="accordion" id="multiSubDropDown">
  <div class="accordion-group">
    <div class="accordion-header">
      <a id="multiSubDropDownBtn" class="accordion-toggle btn" data-toggle="collapse" data-parent="multiSubDropDown" href="#collapseOne">
        <i class="icon-chevron-down multiSubDropDownIcon"><!-- cheron down icon --></i>&nbsp;Multi-subject Databases
      </a>
    </div>

    <div id="collapseOne" class="accordion-body collapse">
      <div class="accordion-inner">
        <ul class='multisubject'>
        <? // get multiusbject dbs
        $query4 = "SELECT * FROM Dbases INNER JOIN DBRanking ON Dbases.Key_ID = DBRanking.Key_ID
                    WHERE DBRanking.Subject_ID=23 ORDER BY DBRanking.Ranking";
        //eliminate SubjectList.Format = 0 to pull in all groups (ex: multiusbject, ebooks, etc.)
        $result4 = mysql_query($query4);
        while($row = mysql_fetch_array($result4))
        {
          echo "<li>
          <a href='https://www5.utc.edu/databases/LGForward.php?db=".$row['Key_ID']."' target='_blank'>";
          if (strpos($row['Title'], '*Trial*') !== false) {
            $newTitle = str_replace('*Trial*', '', $row['Title']);
            echo $newTitle."</a><span class='label'> Trial </span>";
          }else{echo $row['Title']."</a>";}
          echo "<p class='".$row['ContentType']."'>
          <bold>".$row['ContentType']."</bold> -
          <em>".$row['ShortDescription']."</em>";
          if (!empty($row['HighlightedInfo'])) {
          echo "<span class='highlight'>".$row['HighlightedInfo']."</span>";
        }
          echo "</p></li>";
        }
        ?>
      </ul>
      </div>
</div>
  </div>
</div>

<?php if ($today < $endTime) echo $emergMessage; ?>

</div>
<div class='tab-pane' id='subjects'>

<?php
$query = "SELECT Subject, LibGuidesPage FROM SubjectList WHERE NotSubjectList = 0 AND LibGuidesPage IS NOT NULL ORDER BY Subject";
$result = mysql_query($query);
if (!$con || empty($result))
	{
	echo "Subject search is currently unavailable.";
	}
 else
	{
	echo "<form class='form-search' name='databases'>
<label for='db' class='hide' aria-label='go to subject'>Select Subject</label>
	<select id='db' class='input-xxlarge' required>
		<option></option>";
				while($row = mysql_fetch_array($result))
				{
				echo "<option value='https://guides.lib.utc.edu/" . $row['LibGuidesPage'] ."'>" . $row['Subject'] . "</option>";
				}
				echo "</select>";
				echo " <button id='Subjects' type='submit' class='btn search-btn btn-primary' onClick='goSubjects(db.value)'>Go</button></form>";
				}
				mysql_close($con);
?>
<!--
<div class="alert alert-success span10 offset1" style="margin-right: auto;width: 100%;margin-left: auto;">

  <button class="close" data-dismiss="alert">×</button>

<em>Great News!</em><p>
You can now access Subject Guides from the Databases tab!</p>

  </div>
-->
<!-- hide these for now
<a  class="btn btn-mini search-xtra-left" href="https://guides.lib.utc.edu/eresources" target="_blank">Databases By Subject</a
<a  class="btn btn-mini search-xtra-right" href="https://guides.lib.utc.edu/" target="_blank">Subject Guides</a>
-->
<?php if ($today < $endTime) echo $emergMessage; ?>
</div>
<div class='tab-pane' id='courses'>
	<form class='form-search' name='courses' action='https://utc.worldcat.org/wcpa/courseReserves' method='get' target='_blank'>
	<label for="searchreserves" class="hide" aria-label="search course reserves">Search Course Reserves</label>
	<input id="searchreserves" type='text' placeholder='Search Course Reserves' class='input-xxlarge clearable' name='query' required />
	<button id="Reserves" type='submit' class='btn search-btn btn-primary'>Search</button>
	<div class="spacer"></div>
	<label for="reservessearchin" aria-label="search reserves for">Search for:</label>
		<select id="reservessearchin" class='input-large' name='searchIn'>
			<option value='Courses' selected>Course or Instructor</option>
			<option value='Items'>Reserve Items</option>
		</select>
		<label for="reservessearchwords" class="hide" aria-label="all/any words">All/Any Words</label>
			<select id="reservessearchwords" class='input-medium' name='searchWords'>
				<option value='allWords' selected>Match All Words</option>
				<option value='anyWords'>Match Any Words</option>
			</select>
		<input type='hidden' value='courseReserveManagerSearchCourses' name='action'/>
	</form>
<a  class="btn btn-mini search-xtra-left" href="/library/services/students/course-reserves.php">Reserves Help</a>
<?php if ($today < $endTime) echo $emergMessage; ?>
			</div>
	</div>
</div>
	</section>
	</div>
