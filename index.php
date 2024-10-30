<?php

    /*  
    Plugin Name: csMusicCharts UK
    Description: Provides shortcodes to display UK single and album charts
    Author: Stephan Gerlach
    Version: 1.0.1 
    Author URI: www.computersniffer.com 
    */  
    
    add_action('admin_menu', 'csmusiccharts_uk_admin_menu');
    function csmusiccharts_uk_admin_menu() {
        add_menu_page('csMusicCharts UK', 'csMusicCharts UK', 'administrator', 'csmusiccharts_uk_code', 'csmusiccharts_uk_code');
    }
    
    function csmusiccharts_uk_code() {
        
        if (isset($_POST['opt'])) {
            
            $opt = get_option('csmusiccharts_uk_options');
        
            if (!(!$opt) || $opt=='') {
                update_option('csmusiccharts_uk_options',$_POST['opt']);
            }
            else {
                add_option('csmusiccharts_uk_options',$_POST['opt']);
            }
            
        }
        
        $opt = get_option('csmusiccharts_uk_options');
        
        if (!$opt) {
            $opt['display']['position']=1;
            $opt['display']['artist']=1;
            $opt['display']['track']=1;
            $opt['display']['label']=1;
            $opt['display']['change']=1;
            $opt['display']['incharts']=1;
            
            $opt['option']['cache'] = 1;
            $opt['option']['last-cached']['single']='0000-00-00 00:00:00';
            $opt['option']['last-cached']['album']='0000-00-00 00:00:00';
            
            $opt['option']['single']['position'] = 'Position';
            $opt['option']['single']['artist'] = 'Artist';
            $opt['option']['single']['track'] = 'Track';
            $opt['option']['single']['label'] = 'Label';
            $opt['option']['single']['change'] = 'Change';
            $opt['option']['single']['incharts'] = 'Weeks in Chart';
            
            $opt['option']['album']['position'] = 'Position';
            $opt['option']['album']['artist'] = 'Artist';
            $opt['option']['album']['track'] = 'Album';
            $opt['option']['album']['label'] = 'Label';
            $opt['option']['album']['change'] = 'Change';
            $opt['option']['album']['incharts'] = 'Weeks in Chart';
            
            
        }
        
   	    echo '<div class="wrap">';
        echo '<h2>csMusicCharts UK - Settings</h2>';
        
        echo '<h3>Shorcodes for pages and posts</h3>';
        echo '<p>Top 40 Single Chart: [csmusiccharts_uk_charts chart="single"]</p>';
        echo '<p>Top 40 Album Chart: [csmusiccharts_uk_charts chart="album"]</p>';
        
        echo '<style> .radios { float: left; margin-left: 10px;}
            fieldset p label { float: left; display: block; width: 150px;}</style>';                
        echo '<form action="" method="post">';
        echo '<fieldset>';
        echo '<h3>Display Fields</h3>';
            echo '<p><label>Position:</label>  <span class="radios"><input type="radio" name="opt[display][position]" value="1" ';
                    if ($opt['display']['position']==1){ echo ' checked ';}
                    echo '> Show &nbsp;<input type="radio" name="opt[display]display[position]" value="0" ';
                    if ($opt['display']['position']==0){ echo ' checked ';}
                    echo '> Hide</span></p><br style="clear: both;" />';
            echo '<p><label>Artist:</label>  <span class="radios"><input type="radio" name="opt[display][artist]" value="1" ';
                    if ($opt['display']['artist']==1){ echo ' checked ';}
                    echo '> Show &nbsp;<input type="radio" name="opt[display][artist]" value="0" ';
                    if ($opt['display']['artist']==0){ echo ' checked ';}
                    echo '> Hide</span><br style="clear: both;" /></p>';
            echo '<p><label>Track/Album:</label>  <span class="radios"><input type="radio" name="opt[display][track]" value="1" ';
                    if ($opt['display']['track']==1){ echo ' checked ';}
                    echo '> Show &nbsp;<input type="radio" name="opt[display][track]" value="0" ';
                    if ($opt['display']['track']==0){ echo ' checked ';}
                    echo '> Hide</span><br style="clear: both;" /></p>';
            echo '<p><label>Label:</label>  <span class="radios"><input type="radio" name="opt[display][label]" value="1" ';
                    if ($opt['display']['label']==1){ echo ' checked ';}
                    echo '> Show &nbsp;<input type="radio" name="opt[display][label]" value="0" ';
                    if ($opt['display']['label']==0){ echo ' checked ';}
                    echo '> Hide</span><br style="clear: both;" /></p>';
            echo '<p><label>Change:</label>  <span class="radios"><input type="radio" name="opt[display][change]" value="1" ';
                    if ($opt['display']['change']==1){ echo ' checked ';}
                    echo '> Show &nbsp;<input type="radio" name="opt[display][change]" value="0" ';
                    if ($opt['display']['change']==0){ echo ' checked ';}
                    echo '> Hide</span><br style="clear: both;" /></p>';
            echo '<p><label>Weeks in Chart:</label>  <span class="radios"><input type="radio" name="opt[display][incharts]" value="1" ';
                    if ($opt['display']['incharts']==1){ echo ' checked ';}
                    echo '> Show &nbsp;<input type="radio" name="opt[display][incharts]" value="0" ';
                    if ($opt['display']['incharts']==0){ echo ' checked ';}
                    echo '> Hide</span><br style="clear: both;" /></p>';
                    
        echo '</fieldset>';
       
        echo '<fieldset>';
        echo '<h3>Table Header</h3>';
        
        echo '<p><label>&nbsp;</label><span class="radios">&nbsp;&nbsp;&nbsp;&nbsp;Single Charts</span><span class="radios">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Album Charts</span></p><br style="clear: both;" />';
        echo '<p><label>Position:</label>  <span class="radios"><input type="text" name="opt[option][single][position]" value="'.$opt[option][single][position].'" /></span><span class="radios"><input type="text" name="opt[option][album][position]" value="'.$opt[option][album][position].'" /></span></p><br style="clear: both;" />';
        echo '<p><label>Artist:</label>  <span class="radios"><input type="text" name="opt[option][single][artist]" value="'.$opt[option][single][artist].'" /></span><span class="radios"><input type="text" name="opt[option][album][artist]" value="'.$opt[option][album][artist].'" /></span></p><br style="clear: both;" />';
        echo '<p><label>Track:</label>  <span class="radios"><input type="text" name="opt[option][single][track]" value="'.$opt[option][single][track].'" /></span><span class="radios"><input type="text" name="opt[option][album][track]" value="'.$opt[option][album][track].'" /></span></p><br style="clear: both;" />';
        echo '<p><label>Label:</label>  <span class="radios"><input type="text" name="opt[option][single][label]" value="'.$opt[option][single][label].'" /></span><span class="radios"><input type="text" name="opt[option][album][label]" value="'.$opt[option][album][label].'" /></span></p><br style="clear: both;" />';
        echo '<p><label>Change:</label>  <span class="radios"><input type="text" name="opt[option][single][change]" value="'.$opt[option][single][change].'" /></span><span class="radios"><input type="text" name="opt[option][album][change]" value="'.$opt[option][album][change].'" /></span></p><br style="clear: both;" />';
        echo '<p><label>Weeks in Charts:</label>  <span class="radios"><input type="text" name="opt[option][single][incharts]" value="'.$opt[option][single][incharts].'" /></span><span class="radios"><input type="text" name="opt[option][album][incharts]" value="'.$opt[option][album][incharts].'" /></span></p><br style="clear: both;" />';
        
        
        
        echo '</fieldset>';
       
        echo '<fieldset>';
        echo '<h3>Cache Details</h3>';
        echo '<p><label>Cache for days:</label>  <span class="radios"><select name="opt[option][cache]">';
            for($i=1; $i<=7; $i++) {
                echo '<option value="'.$i.'"';
                if ( $opt['option']['cache'] == $i) { echo ' selected ';}                
                echo '>'.$i.'</option>';
            }
        echo '</select></span></p><br style="clear: both;" />';              
        echo '<p><label>Singles last chached:</label>  <span class="radios">';
        if ($opt['option']['last-cached']['single']=='0000-00-00 00:00:00') {
            echo 'Never';
        }
        else {
            echo $opt['option']['last-cached']['single'];
        }
        echo '<input type="hidden" name="opt[option][last-cached][single]" value="'.$opt['option']['last-cached']['single'].'" /></span></p><br style="clear: both;" />';
        
        echo '<p><label>Albums last chached:</label>  <span class="radios">';
        if ($opt['option']['last-cached']['album']=='0000-00-00 00:00:00') {
            echo 'Never';
        }
        else {
            echo $opt['option']['last-cached']['album'];
        }
        echo '<input type="hidden" name="opt[option][last-cached][album]" value="'.$opt['option']['last-cached']['album'].'" /></span></p><br style="clear: both;" />';
        
        echo '</fieldset>';
        echo '<fieldset>';
        echo '<h3>CSS Style</h3>';
        echo '<p><textarea style="width: 400px; height: 150px;" name="opt[option][style]">'.$opt['option']['style'].'</textarea></p>';
        echo '<p>Class names for custom CSS styling:<br />';
        echo 'Table: csmusiccharts_uk_table<br />';
        echo 'Table head row: csmusiccharts_uk_table_head<br />';
        
        echo 'Table head row position: csmusiccharts_uk_table_head_position<br />';
        echo 'Table head row change: csmusiccharts_uk_table_head_change<br />';
        echo 'Table head row artist: csmusiccharts_uk_table_head_artist<br />';
        echo 'Table head row track/album: csmusiccharts_uk_table_head_track<br />';
        echo 'Table head row label: csmusiccharts_uk_table_head_label<br />';
        echo 'Table head row in chart: csmusiccharts_uk_table_head_inchart<br />';
        
        echo 'Table alternative row odd: csmusiccharts_uk_table_bg1<br />';
        echo 'Table alternative row even: csmusiccharts_uk_table_bg2<br />';
        
        echo 'Table data row position: csmusiccharts_uk_table_position<br />';
        echo 'Table data row change: csmusiccharts_uk_table_change<br />';
        echo 'Table data row artist: csmusiccharts_uk_table_artist<br />';
        echo 'Table data row track/album: csmusiccharts_uk_table_track<br />';
        echo 'Table data row label: csmusiccharts_uk_table_label<br />';
        echo 'Table data row in chart: csmusiccharts_uk_table_inchart<br />';
        
        echo '</p>';
        
        echo '</fieldset>';
        echo '<input type="submit" value="Save" name="" />'; 
        echo '</form>';
    }
    
    add_shortcode( 'csmusiccharts_uk_charts', 'csmusiccharts_uk_charts' );
    function csmusiccharts_uk_charts($atts) {
        
        extract( shortcode_atts( array(
		  'chart' => 'single'
        ), $atts ) );
        
        $opt = get_option('csmusiccharts_uk_options');
        
        if (!$opt) { return false; }
        
        $last_cached = $opt['option']['last-cached'][$chart];
        
        if ($last_cached < date('Y-m-d H:i:s',strtotime('-'.$opt['option']['cache'].' days'))) {
            
                
            $p = file_get_contents('http://www.bbc.co.uk/radio1/chart/'.$chart.'s');
            $p = str_replace("\n",' ',$p);
            
            preg_match_all('|<span class="position">(.*?)</span>|',$p,$position);
            preg_match_all('|<span class="artist">(.*?)</span>|',$p,$artist);
            preg_match_all('|<span class="track">(.*?)</span>|',$p,$track);
            preg_match_all('|<span class="label">(.*?)</span>|',$p,$label);
            preg_match_all('|<span class="change">(.*?)</span>|',$p,$change);
            preg_match_all('|<span class="weeks-in-chart">(.*?)</span>|',$p,$inchart);
            
            $dat['position'] = $position[1];
            $dat['artist'] = $artist[1];
            $dat['track'] = $track[1];
            $dat['label'] = $label[1];
            $dat['change'] = $change[1];
            $dat['inchart'] = $inchart[1];
            
            $opt['option']['last-cached'][$chart] = date('Y-m-d H:i:s');
            update_option('csmusiccharts_uk_options',$opt);
            
            update_option('csmusiccharts_uk_data',$dat);
            
        }
        
        
        $data = get_option('csmusiccharts_uk_data');
        
        if (trim($opt['option']['style'])!='') {
            echo '<style>'.$opt['option']['style'].'</style>';
        }
        
        $table .= '<table class="csmusiccharts_uk_table">';
        
        $table .= '<tr class="csmusiccharts_uk_table_head">';
            if ($opt['display']['position']==1) {
                $table .= '<th class="csmusiccharts_uk_table_head_position">'.$opt['option'][$chart]['position'].'</th>';
            }
            if ($opt['display']['change']==1) {
                $table .= '<th class="csmusiccharts_uk_table_head_change">'.$opt['option'][$chart]['change'].'</th>';
            }
            if ($opt['display']['artist']==1) {
                $table .= '<th class="csmusiccharts_uk_table_head_artist">'.$opt['option'][$chart]['artist'].'</th>';
            }
            if ($opt['display']['track']==1) {
                $table .= '<th class="csmusiccharts_uk_table_head_track">'.$opt['option'][$chart]['track'].'</th>';
            }
            if ($opt['display']['label']==1) {
                $table .= '<th class="csmusiccharts_uk_table_head_label">'.$opt['option'][$chart]['label'].'</th>';
            }
            if ($opt['display']['inchart']==1) {
                $table .= '<th class="csmusiccharts_uk_table_head_inchart">'.$opt['option'][$chart]['inchart'].'</th>';
            }
        $table .= '</tr>';
        
        foreach ($data['position'] as $k=>$v) {
            
            $table .= '<tr class="csmusiccharts_uk_table_bg';
            
            if ($k%2==0) { $table .= '2';}
            else { $table .= '1';}
            
            $table .= '">';
                if ($opt['display']['position']==1) {
                    $table .= '<td class="csmusiccharts_uk_table_position">'.$data['position'][$k].'</td>';
                }
                if ($opt['display']['change']==1) {
                    $table .= '<td class="csmusiccharts_uk_table_change">'.$data['change'][$k].'</td>';
                }
                if ($opt['display']['artist']==1) {
                    $table .= '<td class="csmusiccharts_uk_table_artist">'.$data['artist'][$k].'</td>';
                }
                if ($opt['display']['track']==1) {
                    $table .= '<td class="csmusiccharts_uk_table_track">'.$data['track'][$k].'</td>';
                }
                if ($opt['display']['label']==1) {
                    $table .= '<td class="csmusiccharts_uk_table_label">'.$data['label'][$k].'</td>';
                }
                if ($opt['display']['inchart']==1) {
                    $table .= '<td class="csmusiccharts_uk_table_inchart">'.$data['inchart'][$k].'</td>';
                }
            $table .= '</tr>';
        }
        
        $table .= '</table>';
        
        return $table;
    }
    
?>