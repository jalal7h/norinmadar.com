<?

# jalal7h@gmail.com
# 2015/09/21
# Version 2.1

@session_start();

##########################
# license check
if(!in_array( substr(str_replace("www.","",$_SERVER['SERVER_NAME']),0,8), array("127.0.0.","192.168."))){
    echo "<br /><b>Parse error</b>:  syntax error, unexpected '!' in <b>".dirname(dirname(__FILE__))."/index.php</b> on line <b>0</b><br />";
    die();
}
##########################

include_once('config.php');

#
# set defines
$URLFOTDEFINE = "http://".str_replace("/","",$_SERVER['HTTP_HOST']);
$SUBFOLDER = substr( dirname($_SERVER['SCRIPT_NAME']),1,strlen(dirname($_SERVER['SCRIPT_NAME'])) );
if(strlen($SUBFOLDER)!=0) $URLFOTDEFINE .= "/".$SUBFOLDER;
define('_URL',$URLFOTDEFINE);

if(in_array(substr($_SERVER['SERVER_NAME'],0,4),array("127.")) and (!strstr($_SERVER['REQUEST_URI'],'!'))){
	$its_in_upgradable_path = true;
} else {
	$its_in_upgradable_path = false;
}

#
# sync inc and index
$its_in_upgradable_path = false;
if($its_in_upgradable_path){
	if(file_exists("/Users/jalal")){
		define('dropbox_dir','/Users/jalal/Dropbox/scripts/php/content_machine');
	} else {
		define('dropbox_dir','/home/jalal/Dropbox/scripts/php/content_machine');
	}
	#
	# inc
	$dropbox_path = dropbox_dir.'/components/inc.inc';
	$project_path = "components/inc.inc";
	if(md5_file($dropbox_path)==md5_file($project_path)){
		// inc is sync
	} else {
		// inc needs to sync
		if(!file_exists('allow.inc')){
			echo ("the file $project_path needs to be upgraded. (no allow.inc found)");
		} else if(!copy($dropbox_path, $project_path)){
			echo "could not update $project_path";
			die();
		} else {
			echo "inc.inc updated.<br>please reload the page.";
			die();
		}
	}
	#
	# index
	$dropbox_path = dropbox_dir.'/index.php';
	$project_path = "index.php";
	if(md5_file($dropbox_path)==md5_file($project_path)){
		// index is sync
	} else {
		// index needs to sync
		if(!file_exists('allow.inc')){
			echo ("the file $project_path needs to be upgraded. (no allow.inc found)");
		} else if(!copy($dropbox_path, $project_path)){
			echo "could not update $project_path";
			die();
		} else {
			echo "index.php updated.<br>please reload the page.";
			die();
		}
	}
}

#
# sync and include
$dir_name = "components";
if(!$dp=opendir($dir_name)){
	die("Error in opening directory");
} else while($component = readdir($dp)){ // :: component
	if(!is_dir($dir_name."/".$component)){
		// it its not a directory
		continue;
	} else if(substr($component,0,1)=='.'){
		// its disabled
		continue;
	} else if(!$dp0 = opendir($dir_name."/".$component)){
		die("Error in opening directory");
	} else while($file = readdir($dp0)){ // :: component / file
		if(substr($file,0,1)=='.'){
			continue;
		} else {
			
			#
			# sync (name of directory is effective, but the name of file is not)
			if(!file_exists(dropbox_dir.'/components/'.$component)){
				// this component is an special component - only for this project - not a shared one.
			// } else if(strstr($component,'-spi')){
			//	// no need to sync component
			} else if($its_in_upgradable_path){
				$dropbox_path = dropbox_dir.'/components/'.$component.'/'.$file;
				$project_path = $dir_name."/".$component.'/'.$file;
				
				#
				# sync current files
				if(@md5_file($dropbox_path)==@md5_file($project_path)){ // sync check
					// its sync
				} else if(strstr(implode('',file($project_path)),'-spi-')){ // no need to sync check
					// no need to sync check
				} else if(!file_exists($dropbox_path)){
					// file is deprecated, you need to remove it
					rename($project_path, dirname($project_path)."/".date(".dMY-").basename($project_path));
					continue; // also no need to include it
				} else {
					// needs to sync
					if(!file_exists('allow.inc')){
						// the file $project_path needs to be upgraded. (no allow.inc found)
					} else if(!copy($dropbox_path, $project_path)){
						echo "could not update $project_path";
						die();
					} else {
						// sync was needed, and its sync now
					}
				}

				#
				# coping new files to project
				if(!$dp1 = opendir(dropbox_dir.'/components/'.$component)){
					echo "err - ".__LINE__;
				} else while($d1 = readdir($dp1)){
					$dropb_file = dropbox_dir.'/components/'.$component."/".$d1;
					$local_file = $dir_name."/".$component.'/'.$d1;
					if(is_dir($dropb_file)){
						// directories in components will be viawed
						continue;
					} else if(file_exists($local_file)){
						// it exists, its not a new file
					} else if(!file_exists('allow.inc')){
						echo "the file $local_file does not exists on project.";
						die();
					} else if(!copy($dropb_file , $local_file)){
						echo "could not copy $local_file";
						die();
					}
				}
			}


			#
			# include
			if(substr($file,0,1)=='.'){
				continue;
			} else if(in_array(strtolower(strrchr($file,".")),array(".jpg",".jpeg",".png",".gif"))){
				$GLOBALS['include_all_image'][$file] = $dir_name."/".$component."/".$file;
			} else if(substr($file,-13)=='.template.htm'){
				$GLOBALS['include_all_template'][$file] = $dir_name."/".$component."/".$file;
			} else if(strrchr($file,'.')=='.css'){
				$GLOBALS['include_all_css'][] = $dir_name."/".$component."/".$file;
			} else if(strrchr($file,'.')=='.js'){
				$GLOBALS['include_all_js'][] = $dir_name."/".$component."/".$file;
			} else if(strrchr($file,'.')=='.sql'){
				$GLOBALS['include_all_sql'][] = $dir_name."/".$component."/".$file;
			} else if($file=='htaccess.txt'){
				$GLOBALS['include_all_htaccess'][] = $dir_name."/".$component."/".$file;
			} else if( (strrchr($file,'.')!='.php') and (strrchr($file,'.')!='.inc') ){
				continue;
			} else {
				$files_to_include[] = $dir_name."/".$component."/".$file;
			}
		}
	}
	closedir($dp0);
}
closedir($dp);
sort($files_to_include);
foreach($files_to_include as $k => $file_to_include){
	include_once($file_to_include);
}

#
# set _THEME
define('_THEME', (tab__temp('template')?tab__temp('template'):"Default") );

#
# template .php include
$theme_dir = "templates/"._THEME."/php";
$files_to_include = null;
if(!$dp = opendir($theme_dir)){
	echo "could not open the directory '".$theme_dir."'";
} else while($file = readdir($dp)){
	if(substr($file,0,1)=="."){
		continue;
	} else {
		$files_to_include[] = $theme_dir."/".$file;
	}
}
closedir($dp);
if(sizeof($files_to_include)){
	sort($files_to_include);
	foreach($files_to_include as $k => $file_to_include){
		include_once($file_to_include);
	}
}

#
# template .templ include
$theme_dir = "templates/"._THEME."/template";
$files_to_include = null;
if(!$dp = opendir($theme_dir)){
	echo "could not open the directory '".$theme_dir."'";
} else while($file = readdir($dp)){
	if(substr($file,0,1)=="."){
		continue;
	} else {
		$GLOBALS['include_all_template'][$file] = $theme_dir."/".$file;
	}
}
closedir($dp);

#
# template .js include
$theme_dir = "templates/"._THEME."/js";
$files_to_include = null;
if(!$dp = opendir($theme_dir)){
	echo "could not open the directory '".$theme_dir."'";
} else while($file = readdir($dp)){
	if(substr($file,0,1)=="."){
		continue;
	} else {
		$GLOBALS['include_all_js'][$file] = $theme_dir."/".$file;
	}
}
closedir($dp);

#
# template images include
$theme_dir = "templates/"._THEME."/images";
$files_to_include = null;
if(!$dp = opendir($theme_dir)){
	echo "could not open the directory '".$theme_dir."'";
} else while($file = readdir($dp)){
	if(substr($file,0,1)=="."){
		continue;
	} else {
		$GLOBALS['include_all_image'][$file] = $theme_dir."/".$file;
	}
}
closedir($dp);

#
# etc
cm_install();
checkPublicSecuity();
browserVersionCheck();




